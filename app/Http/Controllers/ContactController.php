<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class ContactController extends Controller
{
    private const DISCORD_FIELD_LIMIT = 1024;
    private const ACCENT_COLOR = 561586; // #0891B2
    private const FALLBACK_MESSAGE = 'Something went wrong. Please email shipon0142@gmail.com directly.';

    public function __invoke(Request $request): JsonResponse|RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email:rfc', 'max:150'],
            'message' => ['required', 'string', 'max:2000'],
            'website' => ['nullable', 'string'],
        ]);

        // Honeypot: silently succeed without calling Discord.
        if (!empty($data['website'])) {
            return $this->success($request);
        }

        $limiterKey = 'contact:' . $request->ip();
        if (RateLimiter::tooManyAttempts($limiterKey, 3)) {
            return $this->error(
                $request,
                429,
                "You've sent a few messages recently. Please try again in a few minutes."
            );
        }
        RateLimiter::hit($limiterKey, 600); // 10 minutes

        $webhook = config('services.discord.webhook');
        if (empty($webhook)) {
            $requestId = (string) Str::uuid();
            Log::error('Contact form: DISCORD_CONTACT_WEBHOOK is not configured', [
                'request_id' => $requestId,
            ]);
            return $this->error($request, 503, self::FALLBACK_MESSAGE);
        }

        $messageValue = $data['message'];
        if (mb_strlen($messageValue) > self::DISCORD_FIELD_LIMIT) {
            $messageValue = mb_substr($messageValue, 0, self::DISCORD_FIELD_LIMIT - 1) . '…';
        }

        $payload = [
            'username' => 'Portfolio Contact',
            'embeds' => [[
                'title' => 'New contact message',
                'color' => self::ACCENT_COLOR,
                'fields' => [
                    ['name' => 'Name', 'value' => $data['name'], 'inline' => true],
                    ['name' => 'Email', 'value' => $data['email'], 'inline' => true],
                    ['name' => 'Message', 'value' => $messageValue],
                ],
                'timestamp' => now()->utc()->toIso8601String(),
                'footer' => ['text' => 'shiponsarder.com'],
            ]],
        ];

        try {
            $response = Http::timeout(5)->post($webhook, $payload);
        } catch (\Throwable $e) {
            $requestId = (string) Str::uuid();
            Log::error('Contact form: Discord webhook request threw', [
                'request_id' => $requestId,
                'exception' => $e->getMessage(),
            ]);
            return $this->error($request, 502, self::FALLBACK_MESSAGE);
        }

        if (!$response->successful()) {
            $requestId = (string) Str::uuid();
            Log::error('Contact form: Discord webhook returned non-2xx', [
                'request_id' => $requestId,
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
            return $this->error($request, 502, self::FALLBACK_MESSAGE);
        }

        return $this->success($request);
    }

    private function success(Request $request): JsonResponse|RedirectResponse
    {
        if ($request->expectsJson()) {
            return response()->json(['ok' => true]);
        }
        return redirect('/#contact')->with('contact.success', true);
    }

    private function error(Request $request, int $status, string $message): JsonResponse|RedirectResponse
    {
        if ($request->expectsJson()) {
            return response()->json(['ok' => false, 'message' => $message], $status);
        }
        return redirect('/#contact')->with('contact.error', $message);
    }
}
