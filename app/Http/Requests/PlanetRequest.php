<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PlanetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $planetId = $this->route('planet')?->id;

        return [
            'name'           => ['required', 'string', 'max:255'],
            'name_en'        => ['nullable', 'string', 'max:255'],
            'slug'           => [
                'nullable',
                'string',
                'max:255',
                'alpha_dash',
                Rule::unique('planets', 'slug')->ignore($planetId),
            ],
            'order'          => ['nullable', 'integer', 'min:0'],
            'description'    => ['nullable', 'string'],
            'description_en' => ['nullable', 'string'],
            'distance'       => ['nullable', 'string', 'max:255'],
            'travel_time'    => ['nullable', 'string', 'max:255'],
            'image'          => ['nullable', 'string', 'max:255'],
            'image_upload'   => ['nullable', 'image', 'max:1024'],
            'published'      => ['sometimes', 'boolean'],
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'published' => $this->boolean('published'),
        ]);
    }

    public function messages(): array
    {
        return [
            'name.required'      => 'Le nom est obligatoire.',
            'slug.alpha_dash'    => 'Le slug ne doit contenir que des lettres, chiffres, tirets et underscores.',
            'slug.unique'        => 'Ce slug est déjà utilisé pour une autre planète.',
            'image_upload.image' => 'Le fichier envoyé doit être une image (jpeg, png, etc.).',
            'image_upload.max'   => 'L\'image ne doit pas dépasser 1 Mo.',
        ];
    }
}
