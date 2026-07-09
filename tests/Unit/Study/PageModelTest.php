<?php

namespace Tests\Unit\Study;

use App\Models\Study\Page;
use App\Models\Study\Topic;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PageModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_page_belongs_to_topic(): void
    {
        $topic = Topic::factory()->create();
        $page  = Page::factory()->for($topic, 'topic')->create();

        $this->assertTrue($page->topic->is($topic));
    }

    public function test_slug_is_unique_per_topic_but_reusable_across_topics(): void
    {
        $a = Topic::factory()->create();
        $b = Topic::factory()->create();

        Page::factory()->for($a, 'topic')->create(['slug' => 'intro']);
        Page::factory()->for($b, 'topic')->create(['slug' => 'intro']);

        $this->expectException(\Illuminate\Database\QueryException::class);
        Page::factory()->for($a, 'topic')->create(['slug' => 'intro']);
    }

    public function test_published_scope_filters_by_status_and_published_at(): void
    {
        $topic = Topic::factory()->create();
        Page::factory()->for($topic, 'topic')->create([
            'status' => 'draft', 'published_at' => null,
        ]);
        Page::factory()->for($topic, 'topic')->create([
            'status' => 'published', 'published_at' => now()->subMinute(),
        ]);
        Page::factory()->for($topic, 'topic')->create([
            'status' => 'published', 'published_at' => now()->addDay(),
        ]);

        $this->assertSame(1, Page::published()->count());
    }

    public function test_route_key_is_slug(): void
    {
        $this->assertSame('slug', (new Page())->getRouteKeyName());
    }
}
