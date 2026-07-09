<?php

namespace Tests\Feature\Study;

use App\Models\Study\Topic;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TopicCrudTest extends TestCase
{
    use RefreshDatabase;

    protected function admin(): User
    {
        return User::create([
            'name' => 'A', 'email' => 'a@a.test',
            'password' => 'x', 'is_admin' => true,
        ]);
    }

    public function test_index_lists_topics(): void
    {
        Topic::factory()->create(['title' => 'Laravel']);
        $this->actingAs($this->admin())
            ->get(route('admin.study.topics.index'))
            ->assertOk()->assertSee('Laravel');
    }

    public function test_create_form_renders(): void
    {
        $this->actingAs($this->admin())
            ->get(route('admin.study.topics.create'))
            ->assertOk()->assertSee('Create topic');
    }

    public function test_store_creates_topic_with_auto_slug(): void
    {
        $this->actingAs($this->admin())
            ->post(route('admin.study.topics.store'), [
                'title'       => 'Docker Basics',
                'slug'        => '',
                'description' => null,
                'sort_order'  => 0,
            ])
            ->assertRedirect(route('admin.study.topics.index'));

        $this->assertDatabaseHas('study_topics', [
            'title' => 'Docker Basics',
            'slug'  => 'docker-basics',
        ]);
    }

    public function test_store_rejects_duplicate_slug(): void
    {
        Topic::factory()->create(['slug' => 'flutter']);

        $this->actingAs($this->admin())
            ->post(route('admin.study.topics.store'), [
                'title' => 'Flutter Again',
                'slug'  => 'flutter',
            ])
            ->assertSessionHasErrors('slug');
    }

    public function test_update_changes_topic(): void
    {
        $topic = Topic::factory()->create(['title' => 'Old']);

        $this->actingAs($this->admin())
            ->put(route('admin.study.topics.update', $topic), [
                'title' => 'New', 'slug' => $topic->slug, 'sort_order' => 0,
            ])
            ->assertRedirect();

        $this->assertSame('New', $topic->fresh()->title);
    }

    public function test_destroy_removes_topic(): void
    {
        $topic = Topic::factory()->create();

        $this->actingAs($this->admin())
            ->delete(route('admin.study.topics.destroy', $topic))
            ->assertRedirect();

        $this->assertDatabaseMissing('study_topics', ['id' => $topic->id]);
    }

    public function test_guest_cannot_access_topics(): void
    {
        $this->get(route('admin.study.topics.index'))->assertRedirect('/admin/login');
    }
}
