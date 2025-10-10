<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserStoreRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name'     => ['required','string','max:255'],
            'email'    => ['required','string','email','max:255','unique:users,email'],
            // mot de passe requis en création, 8+ et au moins un chiffre
            'password' => ['required', Password::min(8)->letters()->numbers(), 'confirmed'],
            'roles'    => ['required','array','min:1'],
            'roles.*'  => ['string','exists:roles,name'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name'     => 'nom',
            'email'    => 'email',
            'password' => 'mot de passe',
            'roles'    => 'rôles',
        ];
    }

    public function messages(): array
    {
        return [
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
            'password.min'       => 'Le mot de passe doit contenir au moins :min caractères.',
            // Message générique si la règle Password échoue (ex: aucun chiffre)
            'password.*'         => 'Le mot de passe doit contenir au moins 8 caractères, des lettres et au moins un chiffre.',
            'roles.required'     => 'Je dois sélectionner au moins un rôle.',
            'roles.*.exists'     => 'Le rôle sélectionné est invalide.',
        ];
    }
}
