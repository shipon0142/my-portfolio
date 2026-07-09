<?php

namespace Tests\Feature\Study;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_redirected_to_login(): void
    {
        $this->get('/admin/study')->assertRedirect('/admin/login');
    }

    public function test_non_admin_gets_403(): void
    {
        $user = User::create([
            'name' => 'x', 'email' => 'x@x.test',
            'password' => 'x', 'is_admin' => false,
        ]);
        $this->actingAs($user)->get('/admin/study')->assertForbidden();
    }

    public function test_admin_sees_dashboard(): void
    {
        $user = User::create([
            'name' => 'x', 'email' => 'x@x.test',
            'password' => 'x', 'is_admin' => true,
        ]);
        $this->actingAs($user)->get('/admin/study')
            ->assertOk()->assertSee('Dashboard');
    }
}
