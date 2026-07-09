<?php

namespace Tests\Feature\Study;

use App\Models\User;
use Database\Seeders\AdminUserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_creates_a_single_admin_from_env(): void
    {
        config([
            'app.admin_email'    => 'admin@example.test',
            'app.admin_password' => 'secret-pass',
            'app.admin_name'     => 'Test Admin',
        ]);

        $this->seed(AdminUserSeeder::class);

        $this->assertDatabaseCount('users', 1);
        $user = User::first();
        $this->assertSame('admin@example.test', $user->email);
        $this->assertSame('Test Admin', $user->name);
        $this->assertTrue($user->is_admin);
        $this->assertTrue(password_verify('secret-pass', $user->password));
    }

    public function test_reseeding_updates_the_existing_admin_row(): void
    {
        config([
            'app.admin_email'    => 'admin@example.test',
            'app.admin_password' => 'first-pass',
            'app.admin_name'     => 'First',
        ]);
        $this->seed(AdminUserSeeder::class);

        config([
            'app.admin_email'    => 'admin@example.test',
            'app.admin_password' => 'second-pass',
            'app.admin_name'     => 'Second',
        ]);
        $this->seed(AdminUserSeeder::class);

        $this->assertDatabaseCount('users', 1);
        $user = User::first();
        $this->assertSame('Second', $user->name);
        $this->assertTrue(password_verify('second-pass', $user->password));
    }
}
