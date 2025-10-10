<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest; // Je pars d'une FormRequest
use Illuminate\Validation\Rules\Password;   // J'utilise la règle Password fluide

class UserStoreRequest extends FormRequest
{
    // J'autorise la requête (je gère l'accès via middleware de route)
    public function authorize(): bool { return true; }

    // Je définis mes règles de validation pour la création
    public function rules(): array
    {
        return [
            'name' => ['required','string','max:255'],                               // Je demande un nom non vide
            'email' => ['required','string','email','max:255','unique:users,email'], // J'impose un email unique
            'password' => ['required', Password::min(8)->letters()->numbers(), 'confirmed'], // Je sécurise le mot de passe
            'roles' => ['required','array','min:1'],                                  // Je demande au moins un rôle
            'roles.*' => ['string','exists:roles,name'],                              // Je vérifie que chaque rôle existe
        ];
    }

    // Je personnalise les libellés affichés dans les messages d'erreur
    public function attributes(): array
    {
        return [
            'name' => 'nom',
            'email' => 'email',
            'password' => 'mot de passe',
            'roles' => 'rôles',
        ];
    }
}
