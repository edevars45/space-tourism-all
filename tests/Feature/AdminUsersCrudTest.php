<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class AdminUsersCrudTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Migrations + rôles/permissions
        $this->artisan('migrate');
        $this->seed(\Database\Seeders\RolesAndPermissionsSeeder::class);
    }

    private function makeAdmin(): User
    {
        $admin = User::factory()->create([
            'email_verified_at' => now(),
            'password' => bcrypt('Admin1234'),
        ]);
        $admin->assignRole('Administrateur');
        return $admin;
    }

    #[Test]
    public function admin_can_create_user_with_role(): void
    {
        $admin = $this->makeAdmin();

        $payload = [
            'name' => 'New User',
            'email' => 'new.user@example.test',
            'password' => 'Secret1234',
            'password_confirmation' => 'Secret1234',
            // je poste les rôles par leur nom (Spatie)
            'roles' => ['Gestionnaire Technologies'],
        ];

        $this->actingAs($admin)
            ->post(route('admin.users.store'), $payload)
            ->assertRedirect(route('admin.users.index'));

        $created = User::whereEmail('new.user@example.test')->first();
        $this->assertNotNull($created);
        $this->assertTrue($created->hasRole('Gestionnaire Technologies'));
    }

    #[Test]
    public function admin_can_update_user_and_sync_roles(): void
    {
        $admin = $this->makeAdmin();

        $user = User::factory()->create([
            'name' => 'Before',
            'email' => 'before@example.test',
        ]);
        $user->assignRole('Gestionnaire Technologies');

        $payload = [
            'name' => 'After',
            'email' => 'after@example.test',
            'roles' => ['Gestionnaire Équipage'], // je remplace le rôle
            'password' => '', // pas de changement de mdp
            'password_confirmation' => '',
        ];

        $this->actingAs($admin)
            ->put(route('admin.users.update', $user), $payload)
            ->assertRedirect(route('admin.users.index'));

        $user->refresh();
        $this->assertEquals('After', $user->name);
        $this->assertEquals('after@example.test', $user->email);
        $this->assertTrue($user->hasRole('Gestionnaire Équipage'));
        $this->assertFalse($user->hasRole('Gestionnaire Technologies')); // bien “sync”
    }

    #[Test]
    public function admin_cannot_delete_self(): void
    {
        $admin = $this->makeAdmin();

        $this->actingAs($admin)
            ->delete(route('admin.users.destroy', $admin))
            ->assertRedirect(); // back with error

        $this->assertDatabaseHas('users', ['id' => $admin->id]);
    }

    #[Test]
    public function admin_cannot_delete_last_admin(): void
    {
        $admin = $this->makeAdmin(); // il n’y a qu’un seul admin

        $this->actingAs($admin)
            ->delete(route('admin.users.destroy', $admin))
            ->assertRedirect();

        // le seul admin doit toujours exister
        $this->assertDatabaseHas('users', ['id' => $admin->id]);
    }

    #[Test]
    public function admin_can_delete_user_when_another_admin_exists(): void
    {
        $adminA = $this->makeAdmin();
        $adminB = $this->makeAdmin(); // il y a maintenant 2 admins

        $this->actingAs($adminA)
            ->delete(route('admin.users.destroy', $adminB))
            ->assertRedirect(route('admin.users.index'));

        $this->assertDatabaseMissing('users', ['id' => $adminB->id]);
    }
}
