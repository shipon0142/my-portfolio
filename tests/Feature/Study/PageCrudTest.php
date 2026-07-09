<?php

namespace Tests\Feature\Study;

use App\Models\Study\Page;
use App\Models\Study\Topic;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PageCrudTest extends TestCase
{
    use RefreshDatabase;

    protected function admin(): User
    {
        return User::create([
            'name' => 'A', 'email' => 'a@a.test',
            'password' => 'x', 'is_admin' => true,
        ]);
    }

    public function test_index_lists_pages_scoped_to_topic(): void
    {
        $topic = Topic::factory()->create();
        Page::factory()->for($topic, 'topic')->create(['title' => 'Intro']);

        $this->actingAs($this->admin())
            ->get(route('admin.study.topics.pages.index', $topic))
            ->assertOk()->assertSee('Intro');
    }

    public function test_store_sanitizes_html_and_saves_page(): void
    {
        $topic = Topic::factory()->create();

        $this->actingAs($this->admin())
            ->post(route('admin.study.topics.pages.store', $topic), [
                'title'        => 'Hello',
                'slug'         => 'hello',
                'template'     => 'article',
                'html_content' => '<p>ok</p><script>alert(1)</script>',
                'status'       => 'draft',
            ])
            ->assertRedirect();

        $page = Page::firstWhere('slug', 'hello');
        $this->assertNotNull($page);
        $this->assertStringNotContainsString('<script', $page->html_content);
        $this->assertStringContainsString('<p>ok</p>', $page->html_content);
        $this->assertSame('draft', $page->status);
    }

    public function test_store_rejects_unknown_template(): void
    {
        $topic = Topic::factory()->create();

        $this->actingAs($this->admin())
            ->post(route('admin.study.topics.pages.store', $topic), [
                'title'        => 'Hello',
                'slug'         => 'hello',
                'template'     => 'not-a-template',
                'html_content' => '<p>ok</p>',
                'status'       => 'draft',
            ])
            ->assertSessionHasErrors('template');
    }

    public function test_slug_is_unique_within_topic(): void
    {
        $topic = Topic::factory()->create();
        Page::factory()->for($topic, 'topic')->create(['slug' => 'intro']);

        $this->actingAs($this->admin())
            ->post(route('admin.study.topics.pages.store', $topic), [
                'title'        => 'Intro Two',
                'slug'         => 'intro',
                'template'     => 'article',
                'html_content' => '<p>ok</p>',
                'status'       => 'draft',
            ])
            ->assertSessionHasErrors('slug');
    }

    public function test_same_slug_allowed_across_topics(): void
    {
        $a = Topic::factory()->create();
        $b = Topic::factory()->create();
        Page::factory()->for($a, 'topic')->create(['slug' => 'intro']);

        $this->actingAs($this->admin())
            ->post(route('admin.study.topics.pages.store', $b), [
                'title'        => 'Intro',
                'slug'         => 'intro',
                'template'     => 'article',
                'html_content' => '<p>ok</p>',
                'status'       => 'draft',
            ])
            ->assertRedirect();
    }

    public function test_update_changes_page(): void
    {
        $topic = Topic::factory()->create();
        $page  = Page::factory()->for($topic, 'topic')->create();

        $this->actingAs($this->admin())
            ->put(route('admin.study.topics.pages.update', [$topic, $page]), [
                'title'        => 'Updated',
                'slug'         => $page->slug,
                'template'     => 'article',
                'html_content' => '<p>new</p>',
                'status'       => 'draft',
            ])
            ->assertRedirect();

        $this->assertSame('Updated', $page->fresh()->title);
    }

    public function test_destroy_deletes_page(): void
    {
        $topic = Topic::factory()->create();
        $page  = Page::factory()->for($topic, 'topic')->create();

        $this->actingAs($this->admin())
            ->delete(route('admin.study.topics.pages.destroy', [$topic, $page]))
            ->assertRedirect();

        $this->assertDatabaseMissing('study_pages', ['id' => $page->id]);
    }
}
