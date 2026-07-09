<?php

namespace Tests\Feature\Study;

use App\Models\Study\Page;
use App\Models\Study\Topic;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PagePublishTest extends TestCase
{
    use RefreshDatabase;

    protected function admin(): User
    {
        return User::create([
            'name' => 'A', 'email' => 'a@a.test',
            'password' => 'x', 'is_admin' => true,
        ]);
    }

    public function test_publish_sets_status_and_published_at(): void
    {
        $topic = Topic::factory()->create();
        $page  = Page::factory()->for($topic, 'topic')->create([
            'status' => 'draft', 'published_at' => null,
        ]);

        $this->actingAs($this->admin())
            ->post(route('admin.study.pages.publish', $page))
            ->assertRedirect();

        $page->refresh();
        $this->assertSame('published', $page->status);
        $this->assertNotNull($page->published_at);
    }

    public function test_unpublish_reverses(): void
    {
        $topic = Topic::factory()->create();
        $page  = Page::factory()->for($topic, 'topic')->create([
            'status' => 'published', 'published_at' => now(),
        ]);

        $this->actingAs($this->admin())
            ->post(route('admin.study.pages.unpublish', $page))
            ->assertRedirect();

        $page->refresh();
        $this->assertSame('draft', $page->status);
        $this->assertNull($page->published_at);
    }
}
