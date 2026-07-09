<?php

namespace Tests\Unit\Study;

use App\Services\Study\HtmlSanitizer;
use Tests\TestCase;

class HtmlSanitizerTest extends TestCase
{
    protected HtmlSanitizer $sanitizer;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sanitizer = app(HtmlSanitizer::class);
    }

    public function test_strips_script_tags(): void
    {
        $out = $this->sanitizer->clean('<p>ok</p><script>alert(1)</script>');
        $this->assertStringNotContainsString('<script', $out);
        $this->assertStringContainsString('<p>ok</p>', $out);
    }

    public function test_strips_event_handlers(): void
    {
        $out = $this->sanitizer->clean('<div onclick="alert(1)">x</div>');
        $this->assertStringNotContainsString('onclick', $out);
    }

    public function test_strips_javascript_urls(): void
    {
        $out = $this->sanitizer->clean('<a href="javascript:alert(1)">x</a>');
        $this->assertStringNotContainsString('javascript:', $out);
    }

    public function test_strips_php_open_tags(): void
    {
        $out = $this->sanitizer->clean('<p><?php echo "x"; ?></p>');
        $this->assertStringNotContainsString('<?php', $out);
        $this->assertStringNotContainsString('<?=', $out);
    }

    public function test_escapes_blade_delimiters(): void
    {
        $out = $this->sanitizer->clean('<p>{{ $user->password }}</p>');
        $this->assertStringNotContainsString('{{', $out);
        $this->assertStringNotContainsString('}}', $out);
    }

    public function test_preserves_class_style_data_attrs(): void
    {
        $html = '<div class="grid" style="color:red" data-key="v">x</div>';
        $out  = $this->sanitizer->clean($html);
        $this->assertStringContainsString('class="grid"', $out);
        // HTMLPurifier normalizes color:red → color:#FF0000; — verify a color style survives.
        $this->assertMatchesRegularExpression('/style="[^"]*color\s*:\s*(?:red|#ff0000)/i', $out);
        $this->assertStringContainsString('data-key="v"', $out);
    }

    public function test_preserves_tables_and_images(): void
    {
        $html = '<table><tr><td>a</td></tr></table><img src="/x.png" alt="a">';
        $out  = $this->sanitizer->clean($html);
        $this->assertStringContainsString('<table', $out);
        $this->assertStringContainsString('<img', $out);
    }

    public function test_empty_input_returns_empty(): void
    {
        $this->assertSame('', $this->sanitizer->clean(''));
    }
}
