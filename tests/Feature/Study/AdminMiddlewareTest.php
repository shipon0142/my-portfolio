<?php

namespace Tests\Feature\Study;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class AdminMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Route::get('/login', fn () => 'login')->name('login');
        Route::get('/__test_admin', fn () => 'ok')->middleware(['auth', 'admin']);
        // Ensure the URL generator's named-route cache reflects newly registered routes
        $this->app['router']->getRoutes()->refreshNameLookups();
        $this->app['url']->setRoutes($this->app['router']->getRoutes());
    }

    public function test_guest_is_redirected(): void
    {
        $this->get('/__test_admin')->assertRedirect();
    }

    public function test_non_admin_gets_forbidden(): void
    {
        $user = User::create([
            'name' => 'Jane', 'email' => 'jane@test.com',
            'password' => 'x', 'is_admin' => false,
        ]);
        $this->actingAs($user)->get('/__test_admin')->assertForbidden();
    }

    public function test_admin_passes(): void
    {
        $user = User::create([
            'name' => 'Ada', 'email' => 'ada@test.com',
            'password' => 'x', 'is_admin' => true,
        ]);
        $this->actingAs($user)->get('/__test_admin')->assertOk();
    }
}
