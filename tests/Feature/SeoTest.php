<?php

namespace Tests\Feature;

use Tests\TestCase;

class SeoTest extends TestCase
{
    private function homeHtml(): string
    {
        $response = $this->get('/');
        $response->assertOk();
        return $response->getContent();
    }

    public function test_canonical_link_present(): void
    {
        $html = $this->homeHtml();
        $this->assertStringContainsString(
            '<link rel="canonical" href="https://shiponsarder.com/">',
            $html
        );
    }

    public function test_basic_seo_meta_present(): void
    {
        $html = $this->homeHtml();
        $this->assertStringContainsString('<meta name="author" content="Shipon Sarder">', $html);
        $this->assertStringContainsString('<meta name="robots" content="index, follow, max-image-preview:large">', $html);
        $this->assertStringContainsString('<meta name="theme-color" content="#0891B2">', $html);
        $this->assertStringContainsString('name="keywords"', $html);
    }

    public function test_open_graph_meta_present(): void
    {
        $html = $this->homeHtml();
        $expected = [
            '<meta property="og:type" content="profile">',
            '<meta property="og:site_name" content="Shipon Sarder">',
            '<meta property="og:title" content="Shipon Sarder — Senior Software Engineer">',
            '<meta property="og:url" content="https://shiponsarder.com/">',
            '<meta property="og:image" content="https://shiponsarder.com/og-image.png">',
            '<meta property="og:image:width" content="1200">',
            '<meta property="og:image:height" content="630">',
            '<meta property="profile:first_name" content="Shipon">',
            '<meta property="profile:last_name" content="Sarder">',
        ];
        foreach ($expected as $needle) {
            $this->assertStringContainsString($needle, $html, "Missing: $needle");
        }
    }

    public function test_twitter_card_meta_present(): void
    {
        $html = $this->homeHtml();
        $expected = [
            '<meta name="twitter:card" content="summary_large_image">',
            '<meta name="twitter:title" content="Shipon Sarder — Senior Software Engineer">',
            '<meta name="twitter:image" content="https://shiponsarder.com/og-image.png">',
        ];
        foreach ($expected as $needle) {
            $this->assertStringContainsString($needle, $html, "Missing: $needle");
        }
    }

    public function test_person_jsonld_present_and_valid(): void
    {
        $html = $this->homeHtml();

        $count = preg_match_all(
            '#<script type="application/ld\+json">(.*?)</script>#s',
            $html,
            $matches
        );
        $this->assertGreaterThanOrEqual(2, $count, 'Expected at least two JSON-LD blocks');

        $person = null;
        $website = null;
        foreach ($matches[1] as $raw) {
            $parsed = json_decode(trim($raw), true);
            $this->assertIsArray($parsed, 'JSON-LD block did not parse');
            if (($parsed['@type'] ?? null) === 'Person') {
                $person = $parsed;
            }
            if (($parsed['@type'] ?? null) === 'WebSite') {
                $website = $parsed;
            }
        }

        $this->assertNotNull($person, 'Missing Person JSON-LD');
        $this->assertSame('Shipon Sarder', $person['name']);
        $this->assertSame('Senior Software Engineer', $person['jobTitle']);
        $this->assertSame('Envobyte', $person['worksFor']['name']);
        $this->assertSame('Dhaka', $person['address']['addressLocality']);
        $this->assertSame('BD', $person['address']['addressCountry']);
        $this->assertContains('https://github.com/shipon0142', $person['sameAs']);
        $this->assertContains('https://linkedin.com/in/shipon-sarder-900727102', $person['sameAs']);
        $this->assertSame('https://shiponsarder.com/#person', $person['@id']);

        $this->assertNotNull($website, 'Missing WebSite JSON-LD');
        $this->assertSame('https://shiponsarder.com/', $website['url']);
        $this->assertSame('https://shiponsarder.com/#person', $website['author']['@id']);
    }

    public function test_sitemap_xml_exists_and_is_valid(): void
    {
        $path = public_path('sitemap.xml');
        $this->assertFileExists($path, 'public/sitemap.xml is missing');

        $body = file_get_contents($path);
        $this->assertStringStartsWith('<?xml', $body);

        libxml_use_internal_errors(true);
        $xml = simplexml_load_string($body);
        $this->assertNotFalse($xml, 'sitemap.xml is not valid XML');

        $xml->registerXPathNamespace('s', 'http://www.sitemaps.org/schemas/sitemap/0.9');
        $locs = $xml->xpath('//s:url/s:loc');
        $this->assertNotEmpty($locs);
        $this->assertSame('https://shiponsarder.com/', (string) $locs[0]);
    }

    public function test_robots_txt_references_sitemap(): void
    {
        $path = public_path('robots.txt');
        $this->assertFileExists($path);

        $body = file_get_contents($path);
        $this->assertStringContainsString('User-agent: *', $body);
        $this->assertStringContainsString('Sitemap: https://shiponsarder.com/sitemap.xml', $body);
    }

    public function test_og_image_exists_and_is_1200x630_png(): void
    {
        $path = public_path('og-image.png');
        $this->assertFileExists($path, 'public/og-image.png is missing');

        $bytes = file_get_contents($path);
        $this->assertGreaterThan(1024, strlen($bytes), 'og-image.png is suspiciously small');

        // PNG magic: 89 50 4E 47 0D 0A 1A 0A
        $this->assertSame("\x89PNG\r\n\x1a\n", substr($bytes, 0, 8), 'og-image.png does not start with PNG magic bytes');

        // IHDR: bytes 16-19 = width, 20-23 = height (big-endian uint32)
        $width  = unpack('N', substr($bytes, 16, 4))[1];
        $height = unpack('N', substr($bytes, 20, 4))[1];
        $this->assertSame(1200, $width,  'og-image.png width should be 1200');
        $this->assertSame(630,  $height, 'og-image.png height should be 630');
    }
}
