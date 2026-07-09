<?php

namespace Tests\Feature\Study;

use App\Models\Study\Page;
use App\Models\Study\Topic;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicRenderingTest extends TestCase
{
    use RefreshDatabase;

    protected function admin(): User
    {
        return User::create([
            'name' => 'A', 'email' => 'a@a.test',
            'password' => 'x', 'is_admin' => true,
        ]);
    }

    public function test_index_lists_topics_that_have_published_pages(): void
    {
        $withPub = Topic::factory()->create(['title' => 'Flutter']);
        Page::factory()->for($withPub, 'topic')->create([
            'status' => 'published', 'published_at' => now()->subMinute(),
        ]);
        Topic::factory()->create(['title' => 'Hidden']);

        $this->actingAs($this->admin())
            ->get('/study')
            ->assertOk()
            ->assertSee('Flutter')
            ->assertDontSee('Hidden');
    }

    public function test_topic_shows_published_pages_only(): void
    {
        $topic = Topic::factory()->create(['slug' => 'laravel']);
        Page::factory()->for($topic, 'topic')->create([
            'title' => 'Public', 'slug' => 'public',
            'status' => 'published', 'published_at' => now()->subMinute(),
        ]);
        Page::factory()->for($topic, 'topic')->create([
            'title' => 'Secret', 'slug' => 'secret',
            'status' => 'draft', 'published_at' => null,
        ]);

        $this->actingAs($this->admin())
            ->get('/study/laravel')
            ->assertOk()
            ->assertSee('Public')
            ->assertDontSee('Secret');
    }

    public function test_published_page_renders_exact_html(): void
    {
        $topic = Topic::factory()->create(['slug' => 'flutter']);
        $page  = Page::factory()->for($topic, 'topic')->create([
            'slug' => 'intro',
            'html_content' => '<div class="grid"><p>Hello</p></div>',
            'status' => 'published', 'published_at' => now()->subMinute(),
        ]);

        $this->actingAs($this->admin())
            ->get('/study/flutter/intro')
            ->assertOk()
            ->assertSee('<div class="grid"><p>Hello</p></div>', false);
    }

    public function test_draft_page_returns_404(): void
    {
        $topic = Topic::factory()->create(['slug' => 'flutter']);
        Page::factory()->for($topic, 'topic')->create([
            'slug' => 'draft', 'status' => 'draft', 'published_at' => null,
        ]);

        $this->actingAs($this->admin())
            ->get('/study/flutter/draft')->assertNotFound();
    }

    public function test_page_scoped_to_correct_topic(): void
    {
        $a = Topic::factory()->create(['slug' => 'aaa']);
        $b = Topic::factory()->create(['slug' => 'bbb']);
        Page::factory()->for($a, 'topic')->create([
            'slug' => 'shared', 'status' => 'published', 'published_at' => now()->subMinute(),
        ]);

        $this->actingAs($this->admin())
            ->get('/study/bbb/shared')->assertNotFound();
    }

    public function test_guest_cannot_access_study_index(): void
    {
        $this->get('/study')->assertRedirect('/admin/login');
    }

    public function test_guest_cannot_access_topic(): void
    {
        $topic = Topic::factory()->create(['slug' => 'flutter']);
        Page::factory()->for($topic, 'topic')->create([
            'status' => 'published', 'published_at' => now()->subMinute(),
        ]);

        $this->get('/study/flutter')->assertRedirect('/admin/login');
    }

    public function test_guest_cannot_access_page(): void
    {
        $topic = Topic::factory()->create(['slug' => 'flutter']);
        Page::factory()->for($topic, 'topic')->create([
            'slug' => 'intro', 'status' => 'published', 'published_at' => now()->subMinute(),
        ]);

        $this->get('/study/flutter/intro')->assertRedirect('/admin/login');
    }
}
