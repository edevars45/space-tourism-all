<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TechnologyRequest extends FormRequest
{
    // J’autorise cette requête pour tous les utilisateurs authentifiés.
    public function authorize(): bool
    {
        return true;
    }

    // Je définis ici les règles de validation pour le formulaire.
    public function rules(): array
    {
        return [
            'name'           => ['required', 'string', 'max:255'],
            'slug'           => ['nullable', 'string', 'max:255'],
            'order'          => ['nullable', 'integer', 'min:0'],
            'description'    => ['nullable', 'string'],
            'website_url'    => ['nullable', 'url', 'max:255'],
            'image'          => ['nullable', 'image', 'max:2048'],
            // Je laisse `image_path` nullable car il peut être rempli automatiquement.
            'image_path'     => ['nullable', 'string', 'max:255'],
            'name_en'        => ['nullable', 'string', 'max:255'],
            'description_en' => ['nullable', 'string'],
            // Je valide la case publié comme booléen.
            'is_published'   => ['nullable', 'boolean'],
        ];
    }
}
