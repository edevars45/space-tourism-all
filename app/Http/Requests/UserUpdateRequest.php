<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest; // Je pars d'une FormRequest
use Illuminate\Validation\Rules\Password;   // J'utilise la règle Password fluide
use Illuminate\Validation\Rule;             // Je vais ignorer l'email courant

class UserUpdateRequest extends FormRequest
{
    // J'autorise la requête (je gère l'accès via middleware de route)
    public function authorize(): bool { return true; }

    // Je définis mes règles de validation pour la mise à jour
    public function rules(): array
    {
        // Je récupère l'identifiant lié au paramètre de route {user}
        $id = $this->route('user');

        return [
            'name' => ['required','string','max:255'],                                         // Je demande un nom
            'email' => ['required','string','email','max:255', Rule::unique('users','email')->ignore($id)], // Je garde l'unicité, en ignorant l'utilisateur courant
            'password' => ['nullable', Password::min(8)->letters()->numbers(), 'confirmed'],   // Je rends le mot de passe optionnel
            'roles' => ['required','array','min:1'],                                           // Je demande au moins un rôle
            'roles.*' => ['string','exists:roles,name'],                                       // Je valide chaque rôle
        ];
    }
}
