<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;

/**
 * Je crée (ou mets à jour) les comptes administrateurs.
 */
class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Je m'assure que le rôle Administrateur existe
        $adminRole = Role::firstOrCreate(['name' => 'Administrateur']);

        // ===== ADMIN DE TEST (ancien) =====
        $adminTest = User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // Je m'assure qu'il a le rôle Administrateur
        if (!$adminTest->hasRole('Administrateur')) {
            $adminTest->assignRole('Administrateur');
        }

        // ===== ADMIN 1 : Esther Devars =====
        $esther = User::updateOrCreate(
            ['email' => 'devarsesther@gmail.com'],
            [
                'name' => 'Esther Devars',
                'password' => Hash::make('123456789'),
                'email_verified_at' => now(),
            ]
        );

        // Je m'assure qu'elle a le rôle Administrateur
        if (!$esther->hasRole('Administrateur')) {
            $esther->assignRole('Administrateur');
        }

        // ===== ADMIN 2 : Sofiane Agoumellah =====
        $sofiane = User::updateOrCreate(
            ['email' => 'sofianeagoumellah1@gmail.com'],
            [
                'name' => 'Sofiane Agoumellah',
                'password' => Hash::make('123456789'),
                'email_verified_at' => now(),
            ]
        );

        // Je m'assure qu'il a le rôle Administrateur
        if (!$sofiane->hasRole('Administrateur')) {
            $sofiane->assignRole('Administrateur');
        }

        $this->command->info(' 3 administrateurs créés :');
        $this->command->info('   - Admin (admin@example.com)');
        $this->command->info('   - Esther Devars (devarsesther@gmail.com)');
        $this->command->info('   - Sofiane Agoumellah (sofianeagoumellah1@gmail.com)');
    }
}
