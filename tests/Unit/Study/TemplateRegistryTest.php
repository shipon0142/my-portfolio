<?php

namespace Tests\Unit\Study;

use Illuminate\Support\Facades\File;
use Tests\TestCase;

class TemplateRegistryTest extends TestCase
{
    public function test_config_lists_five_templates(): void
    {
        $templates = config('study.templates');
        $this->assertIsArray($templates);
        $this->assertCount(5, $templates);
        $this->assertSame(
            ['article', 'tutorial', 'cheatsheet', 'comparison', 'qna'],
            array_keys($templates)
        );
    }

    public function test_each_template_has_a_readable_file(): void
    {
        foreach (config('study.templates') as $key => $meta) {
            $path = resource_path('views/study/templates/'.$key.'.blade.php');
            $this->assertFileExists($path, "Missing template file: $key");
            $contents = File::get($path);
            $this->assertNotEmpty($contents);
            $this->assertStringNotContainsString('<?php', $contents);
            $this->assertStringNotContainsString('{{', $contents);
        }
    }
}
