<?php

namespace Tests\Feature;

use Tests\TestCase;                                    // j’utilise la classe de base TestCase de Laravel
use App\Models\User;                                   // je vais créer des utilisateurs de test
use Illuminate\Foundation\Testing\RefreshDatabase;     // je réinitialise la base entre les tests
use PHPUnit\Framework\Attributes\Test;                 // j’utilise les attributs PHPUnit (remplace @test)

/**
 * Dans ce test, je vérifie que :
 *  - un Administrateur peut accéder à /admin/users (200)
 *  - un non-Administrateur est refusé (403)
 * Je m’assure aussi que les utilisateurs sont “vérifiés” (email_verified_at) car la route est sous le middleware 'verified'.
 */
class AdminUsersAccessTest extends TestCase
{
    use RefreshDatabase; // je force un schéma propre pour chaque test

    /**
     * Je prépare chaque test :
     * - j’exécute les migrations
     * - je seed les rôles/permissions Spatie (pour pouvoir assigner le rôle Administrateur)
     */
    protected function setUp(): void
    {
        parent::setUp();

        // je migre explicitement avant de seeder (utile en environnement de test)
        $this->artisan('migrate');

        // j’injecte les rôles/permissions (Administrateur, Gestionnaire..., *.manage)
        $this->seed(\Database\Seeders\RolesAndPermissionsSeeder::class);
    }

    #[Test] // je déclare le test avec l’attribut PHPUnit (au lieu de /** @test */)
    public function admin_can_access_users_index(): void
    {
        // je crée un utilisateur de test “vérifié” pour passer le middleware 'verified'
        $admin = User::factory()->create([
            'email_verified_at' => now(), // je marque l’email comme vérifié
        ]);

        // je lui assigne le rôle Administrateur (créé par le seeder)
        $admin->assignRole('Administrateur');

        // je simule une session authentifiée avec cet admin
        $this->actingAs($admin)

             // je vise la route nommée admin.users.index
             ->get(route('admin.users.index'))

             // je m’attends à un HTTP 200 (accès autorisé)
             ->assertStatus(200);
    }

    #[Test] // même chose : attribut PHPUnit
    public function non_admin_is_forbidden_on_users_index(): void
    {
        // je crée un utilisateur “vérifié” mais sans le rôle Administrateur
        $user = User::factory()->create([
            'email_verified_at' => now(), // je marque l’email comme vérifié
        ]);

        // (optionnel) je pourrais lui donner un autre rôle pour être explicite :
        // $user->assignRole('Gestionnaire Technologies');

        // je simule la session authentifiée avec cet utilisateur non admin
        $this->actingAs($user)

             // je demande l’index des utilisateurs
             ->get(route('admin.users.index'))

             // je m’attends à un HTTP 403 (interdit)
             ->assertStatus(403); // équivalent : ->assertForbidden()
    }
}
