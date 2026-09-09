<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class TrackController extends Controller
{
    private const ACCENT_COLOR = 561586;

    private const EVENT_LABELS = [
        'page_visit'              => '🟢 Page Visit',
        'cv_download'             => '🖱 Button — Download CV',
        'view_skills'             => '🖱 Button — View Skills',
        // Nav
        'nav_logo'                => '🔗 Nav — Logo / Home',
        'nav_skills'              => '🔗 Nav — Skills',
        'nav_projects'            => '🔗 Nav — Projects',
        'nav_journey'             => '🔗 Nav — Experience',
        'nav_credentials'         => '🔗 Nav — Credentials',
        'nav_contact'             => '🔗 Nav — Contact',
        // Social (hero)
        'social_linkedin'         => '🖱 Button — LinkedIn',
        'social_whatsapp'         => '🖱 Button — WhatsApp',
        'social_github'           => '🖱 Button — GitHub',
        'social_email'            => '🖱 Button — Email',
        // Contact section
        'contact_email'           => '🖱 Contact — Email',
        'contact_linkedin'        => '🖱 Contact — LinkedIn',
        'contact_whatsapp'        => '🖱 Contact — WhatsApp',
        'contact_github'          => '🖱 Contact — GitHub',
        'contact_email_icon'      => '🖱 Contact — Email (icon)',
        // Links
        'link_rovexlabs'          => '🔗 Link — RovexLabs',
        // Projects
        'project_photonex_ai'     => '🚀 Project — PhotoNex AI',
        'project_bear_sweet_puzzle' => '🚀 Project — Bear Sweet Puzzle',
        'project_clipano'         => '🚀 Project — Clipano',
        'project_sendme_bd'       => '🚀 Project — SendMe BD',
    ];

    public function __invoke(Request $request): Response
    {
        $data = $request->validate([
            'event'    => ['required', 'string', 'max:60', Rule::in(array_keys(self::EVENT_LABELS))],
            'referrer' => ['nullable', 'string', 'max:300'],
            'ua'       => ['nullable', 'string', 'max:500'],
            'lang'     => ['nullable', 'string', 'max:20'],
        ]);

        $webhook = config('services.discord.webhook');
        if (empty($webhook)) {
            Log::warning('TrackController: DISCORD_CONTACT_WEBHOOK not configured');
            return response()->noContent();
        }

        $title = self::EVENT_LABELS[$data['event']] ?? ('🖱 ' . $data['event']);
        ['country' => $country, 'city' => $city] = $this->resolveGeo($request->ip());
        $browser = $this->parseBrowser($data['ua'] ?? '');
        $os      = $this->parseOs($data['ua'] ?? '');
        $referrer = $this->parseReferrer($data['referrer'] ?? '');

        $location = $country === 'Unknown' ? 'Unknown' : "{$country}, {$city}";

        $payload = [
            'username' => 'Portfolio Tracker',
            'embeds'   => [[
                'title'  => $title,
                'color'  => self::ACCENT_COLOR,
                'fields' => [
                    ['name' => 'Event',    'value' => $data['event'], 'inline' => true],
                    ['name' => 'Location', 'value' => $location,      'inline' => true],
                    ['name' => 'Browser',  'value' => $browser,       'inline' => true],
                    ['name' => 'OS',       'value' => $os,            'inline' => true],
                    ['name' => 'Referrer', 'value' => $referrer],
                ],
                'timestamp' => now()->utc()->toIso8601String(),
                'footer'    => ['text' => 'shiponsarder.com'],
            ]],
        ];

        try {
            $response = Http::timeout(5)->post($webhook, $payload);
            if (!$response->successful()) {
                Log::warning('TrackController: Discord webhook non-2xx', ['status' => $response->status()]);
            }
        } catch (\Throwable $e) {
            Log::warning('TrackController: Discord webhook threw', ['error' => $e->getMessage()]);
        }

        return response()->noContent();
    }

    private function resolveGeo(string $ip): array
    {
        $fallback = ['country' => 'Unknown', 'city' => 'Unknown'];

        if (in_array($ip, ['127.0.0.1', '::1', ''], true)) {
            return ['country' => 'Local', 'city' => 'dev'];
        }

        try {
            $geo = Http::timeout(3)->get("http://ip-api.com/json/{$ip}?fields=country,city");
            if ($geo->successful()) {
                $body = $geo->json();
                return [
                    'country' => $body['country'] ?? 'Unknown',
                    'city'    => $body['city']    ?? 'Unknown',
                ];
            }
        } catch (\Throwable) {
            // fall through
        }

        return $fallback;
    }

    private function parseBrowser(string $ua): string
    {
        if (str_contains($ua, 'Edg/'))                              return 'Edge';
        if (str_contains($ua, 'OPR/') || str_contains($ua, 'Opera')) return 'Opera';
        if (str_contains($ua, 'Chrome/'))                           return 'Chrome';
        if (str_contains($ua, 'Firefox/'))                          return 'Firefox';
        if (str_contains($ua, 'Safari/'))                           return 'Safari';
        return 'Other';
    }

    private function parseOs(string $ua): string
    {
        if (str_contains($ua, 'Android'))                               return 'Android';
        if (str_contains($ua, 'iPhone') || str_contains($ua, 'iPad'))  return 'iOS';
        if (str_contains($ua, 'Windows'))                               return 'Windows';
        if (str_contains($ua, 'Mac OS X'))                              return 'macOS';
        if (str_contains($ua, 'Linux'))                                 return 'Linux';
        return 'Other';
    }

    private function parseReferrer(string $referrer): string
    {
        if ($referrer === '') return 'Direct';
        $host = parse_url($referrer, PHP_URL_HOST);
        return $host ?: $referrer;
    }
}
