<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\RateLimiter;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config()->set('services.discord.webhook', 'https://discord.example/webhooks/test');

        // Rate limits persist across tests via the cache — clear per test.
        RateLimiter::clear('contact:127.0.0.1');

        Http::preventStrayRequests();
    }

    private function fakeDiscordSuccess(): void
    {
        Http::fake([
            'discord.example/*' => Http::response('', 204),
        ]);
    }

    private function payload(array $overrides = []): array
    {
        return array_merge([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'message' => 'Hi Shipon — loved your Flutter work.',
            'website' => '', // honeypot must stay empty
        ], $overrides);
    }

    public function test_valid_submission_posts_embed_to_discord(): void
    {
        $this->fakeDiscordSuccess();

        $response = $this->postJson('/contact', $this->payload());

        $response->assertOk()->assertJson(['ok' => true]);

        Http::assertSent(function ($request) {
            $body = $request->data();
            return $request->url() === 'https://discord.example/webhooks/test'
                && ($body['username'] ?? null) === 'Portfolio Contact'
                && isset($body['embeds'][0])
                && $body['embeds'][0]['title'] === 'New contact message'
                && $body['embeds'][0]['color'] === 561586
                && collect($body['embeds'][0]['fields'])->contains(
                    fn ($f) => $f['name'] === 'Name' && $f['value'] === 'Jane Doe'
                )
                && collect($body['embeds'][0]['fields'])->contains(
                    fn ($f) => $f['name'] === 'Email' && $f['value'] === 'jane@example.com'
                )
                && collect($body['embeds'][0]['fields'])->contains(
                    fn ($f) => $f['name'] === 'Message' && str_contains($f['value'], 'Flutter')
                );
        });
    }

    public function test_missing_fields_return_validation_errors(): void
    {
        $response = $this->postJson('/contact', ['website' => '']);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'email', 'message']);

        Http::assertNothingSent();
    }

    public function test_invalid_email_returns_validation_error(): void
    {
        $response = $this->postJson('/contact', $this->payload(['email' => 'not-an-email']));

        $response->assertStatus(422)->assertJsonValidationErrors(['email']);
        Http::assertNothingSent();
    }

    public function test_honeypot_silently_succeeds_without_calling_discord(): void
    {
        $response = $this->postJson('/contact', $this->payload(['website' => 'http://spam.example']));

        $response->assertOk()->assertJson(['ok' => true]);
        Http::assertNothingSent();
    }

    public function test_rate_limit_blocks_fourth_request(): void
    {
        $this->fakeDiscordSuccess();

        for ($i = 0; $i < 3; $i++) {
            $this->postJson('/contact', $this->payload())->assertOk();
        }

        $this->postJson('/contact', $this->payload())
            ->assertStatus(429)
            ->assertJson(['ok' => false]);

        Http::assertSentCount(3);
    }

    public function test_discord_failure_returns_502_with_fallback_message(): void
    {
        Http::fake([
            'discord.example/*' => Http::response('boom', 500),
        ]);

        $response = $this->postJson('/contact', $this->payload());

        $response->assertStatus(502)->assertJson(['ok' => false]);
    }

    public function test_missing_webhook_config_returns_503(): void
    {
        config()->set('services.discord.webhook', null);

        $response = $this->postJson('/contact', $this->payload());

        $response->assertStatus(503)->assertJson(['ok' => false]);
        Http::assertNothingSent();
    }

    public function test_long_message_is_truncated_to_discord_field_limit(): void
    {
        $this->fakeDiscordSuccess();

        $long = str_repeat('a', 2000);

        $this->postJson('/contact', $this->payload(['message' => $long]))->assertOk();

        Http::assertSent(function ($request) {
            $value = $request->data()['embeds'][0]['fields'][2]['value'] ?? '';
            return mb_strlen($value) <= 1024 && str_ends_with($value, '…');
        });
    }
}
