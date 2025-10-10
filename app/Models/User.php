<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;     // J'utilise la factory pour seeds/tests
use Illuminate\Foundation\Auth\User as Authenticatable;    // Je base mon modèle sur Authenticatable
use Illuminate\Notifications\Notifiable;                   // J'active les notifications
use Spatie\Permission\Traits\HasRoles;                     // J'ajoute le trait Spatie pour RBAC

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;                  // J'active HasRoles ici

    // J'autorise l'assignation de masse sur ces colonnes
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // Je masque ces colonnes à la sérialisation
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Je définis les conversions automatiques
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',             // Je cast la date
            'password' => 'hashed',                        // Je hash automatiquement le mot de passe
        ];
    }
}
