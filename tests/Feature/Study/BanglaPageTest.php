<?php

namespace Tests\Feature\Study;

use App\Models\Study\Page;
use App\Models\Study\Topic;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BanglaPageTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        static $n = 0;
        $n++;

        return User::create([
            'name'     => "Admin {$n}",
            'email'    => "admin{$n}@a.test",
            'password' => 'x',
            'is_admin' => true,
        ]);
    }

    private function makePublishedPage(array $overrides = []): array
    {
        $topic = Topic::factory()->create(['slug' => 'mobile-architecture']);
        $page  = Page::factory()->create(array_merge([
            'topic_id'     => $topic->id,
            'slug'         => 'sample',
            'status'       => 'published',
            'published_at' => now()->subMinute(),
            'title'        => 'English Title',
            'html_content' => '<p>English body</p>',
        ], $overrides));

        return [$topic, $page];
    }

    public function test_renders_english_by_default(): void
    {
        $this->actingAs($this->admin());

        [$topic, $page] = $this->makePublishedPage();

        $this->get("/study/{$topic->slug}/{$page->slug}")
            ->assertOk()
            ->assertSee('English Title')
            ->assertSee('English body', false)
            ->assertSee('<html lang="en"', false);
    }

    public function test_renders_bangla_when_lang_bn_and_content_present(): void
    {
        $this->actingAs($this->admin());

        [$topic, $page] = $this->makePublishedPage([
            'title_bn'        => 'বাংলা শিরোনাম',
            'html_content_bn' => '<p>বাংলা লেখা</p>',
        ]);

        $this->get("/study/{$topic->slug}/{$page->slug}?lang=bn")
            ->assertOk()
            ->assertSee('বাংলা শিরোনাম')
            ->assertSee('বাংলা লেখা', false)
            ->assertSee('<html lang="bn"', false)
            ->assertDontSee('English Title');
    }

    public function test_falls_back_to_english_when_bangla_body_missing(): void
    {
        $this->actingAs($this->admin());

        [$topic, $page] = $this->makePublishedPage([
            'title_bn'        => 'শুধু শিরোনাম',
            'html_content_bn' => null,
        ]);

        $this->get("/study/{$topic->slug}/{$page->slug}?lang=bn")
            ->assertOk()
            ->assertSee('English Title')
            ->assertSee('<html lang="en"', false)
            ->assertDontSee('শুধু শিরোনাম');
    }

    public function test_invalid_lang_value_treated_as_english(): void
    {
        $this->actingAs($this->admin());

        [$topic, $page] = $this->makePublishedPage([
            'html_content_bn' => '<p>বাংলা</p>',
            'title_bn'        => 'বাংলা',
        ]);

        foreach (['fr', 'BN', '', 'xx'] as $val) {
            $this->get("/study/{$topic->slug}/{$page->slug}?lang={$val}")
                ->assertOk()
                ->assertSee('English Title')
                ->assertSee('<html lang="en"', false);
        }
    }

    public function test_toggle_hidden_when_no_bangla(): void
    {
        $admin = $this->admin();
        $this->actingAs($admin);

        [$topic, $page] = $this->makePublishedPage();

        $this->get("/study/{$topic->slug}/{$page->slug}")
            ->assertOk()
            ->assertDontSee('বাংলা');
    }

    public function test_toggle_visible_and_correct_href_when_bangla_exists(): void
    {
        $admin = $this->admin();
        $this->actingAs($admin);

        [$topic, $page] = $this->makePublishedPage([
            'html_content_bn' => '<p>বাংলা</p>',
            'title_bn'        => 'বাংলা',
        ]);

        $enUrl = "/study/{$topic->slug}/{$page->slug}";
        $bnUrl = $enUrl . '?lang=bn';

        $this->get($enUrl)
            ->assertSee('href="' . url($bnUrl) . '"', false)
            ->assertSee('>বাংলা<', false);

        $this->get($bnUrl)
            ->assertSee('href="' . url($enUrl) . '"', false)
            ->assertSee('>English<', false);
    }

    public function test_bangla_page_loads_noto_bengali_font(): void
    {
        $admin = $this->admin();
        $this->actingAs($admin);

        [$topic, $page] = $this->makePublishedPage([
            'html_content_bn' => '<p>বাংলা</p>',
            'title_bn'        => 'বাংলা',
        ]);

        $bn = $this->get("/study/{$topic->slug}/{$page->slug}?lang=bn");
        $bn->assertSee('Noto+Sans+Bengali', false);
        $bn->assertSee('html[lang="bn"]', false);

        $en = $this->get("/study/{$topic->slug}/{$page->slug}");
        $en->assertDontSee('Noto+Sans+Bengali', false);
    }

    public function test_meta_description_falls_back_per_field_in_bangla(): void
    {
        $admin = $this->admin();
        $this->actingAs($admin);

        [$topic, $page] = $this->makePublishedPage([
            'html_content_bn'      => '<p>বাংলা</p>',
            'title_bn'             => 'বাংলা',
            'meta_description'     => 'English meta',
            'meta_description_bn'  => null,
        ]);

        $this->get("/study/{$topic->slug}/{$page->slug}?lang=bn")
            ->assertOk()
            ->assertSee('name="description" content="English meta"', false);
    }
}
