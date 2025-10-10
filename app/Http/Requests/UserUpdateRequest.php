<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        // route-model binding -> je récupère l'id proprement
        $userId = $this->route('user')?->id ?? $this->route('user');

        return [
            'name'     => ['required','string','max:255'],
            'email'    => ['required','string','email','max:255', Rule::unique('users','email')->ignore($userId)],
            // mot de passe optionnel en édition, même politique si fourni
            'password' => ['nullable', Password::min(8)->letters()->numbers(), 'confirmed'],
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
            'password.*'         => 'Le mot de passe doit contenir au moins 8 caractères, des lettres et au moins un chiffre.',
            'roles.required'     => 'Je dois sélectionner au moins un rôle.',
            'roles.*.exists'     => 'Le rôle sélectionné est invalide.',
        ];
    }
}
