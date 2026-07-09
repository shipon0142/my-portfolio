<?php

namespace Tests\Feature\Study;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    protected function makeAdmin(string $password = 'secret1234'): User
    {
        return User::create([
            'name' => 'Admin',
            'email' => 'admin@site.test',
            'password' => Hash::make($password),
            'is_admin' => true,
        ]);
    }

    public function test_login_page_renders(): void
    {
        $this->get('/admin/login')->assertOk()->assertSee('Sign in');
    }

    public function test_valid_credentials_authenticate_admin(): void
    {
        $this->makeAdmin();

        $this->post('/admin/login', [
            'email' => 'admin@site.test',
            'password' => 'secret1234',
        ])->assertRedirect('/admin/study');

        $this->assertAuthenticated();
    }

    public function test_invalid_password_rejected(): void
    {
        $this->makeAdmin();

        $this->post('/admin/login', [
            'email' => 'admin@site.test',
            'password' => 'wrong',
        ])->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    public function test_logout_ends_session(): void
    {
        $admin = $this->makeAdmin();
        $this->actingAs($admin)->post('/admin/logout')->assertRedirect('/admin/login');
        $this->assertGuest();
    }
}
