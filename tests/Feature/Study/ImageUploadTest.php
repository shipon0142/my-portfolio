<?php

namespace Tests\Feature\Study;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ImageUploadTest extends TestCase
{
    use RefreshDatabase;

    protected function admin(): User
    {
        return User::create([
            'name' => 'A', 'email' => 'a@a.test',
            'password' => 'x', 'is_admin' => true,
        ]);
    }

    public function test_admin_can_upload_image(): void
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->image('photo.png', 200, 200);

        $response = $this->actingAs($this->admin())
            ->post('/admin/study/uploads', ['upload' => $file]);

        $response->assertOk()->assertJsonStructure(['url']);

        $files = Storage::disk('public')->files('study');
        $this->assertCount(1, $files);
    }

    public function test_non_image_rejected(): void
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->create('doc.pdf', 100, 'application/pdf');

        $this->actingAs($this->admin())
            ->post('/admin/study/uploads', ['upload' => $file])
            ->assertStatus(422);
    }

    public function test_guest_cannot_upload(): void
    {
        Storage::fake('public');
        $file = UploadedFile::fake()->image('photo.png');

        $this->post('/admin/study/uploads', ['upload' => $file])
            ->assertRedirect('/admin/login');
    }
}
