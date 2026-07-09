<?php

namespace Tests\Unit\Study;

use App\Models\Study\Topic;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TopicModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_topic_can_be_created(): void
    {
        $topic = Topic::create([
            'title'       => 'Flutter',
            'slug'        => 'flutter',
            'description' => 'Mobile UI toolkit',
            'sort_order'  => 1,
        ]);

        $this->assertDatabaseHas('study_topics', ['slug' => 'flutter']);
        $this->assertSame(1, $topic->sort_order);
    }

    public function test_slug_must_be_unique(): void
    {
        Topic::create(['title' => 'Flutter', 'slug' => 'flutter']);
        $this->expectException(\Illuminate\Database\QueryException::class);
        Topic::create(['title' => 'Flutter Two', 'slug' => 'flutter']);
    }

    public function test_route_key_is_slug(): void
    {
        $this->assertSame('slug', (new Topic())->getRouteKeyName());
    }
}
