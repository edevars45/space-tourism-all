<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CrewMemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $memberId = $this->route('crew')?->id;

        return [
            'name'       => ['required', 'string', 'max:255'],
            'slug'       => [
                'nullable', 'string', 'max:255', 'alpha_dash',
                Rule::unique('crew_members', 'slug')->ignore($memberId),
            ],
            'role'       => ['required', 'string', 'max:255'],
            'role_en'    => ['nullable', 'string', 'max:255'],
            'order'      => ['nullable', 'integer', 'min:0'],
            'bio'        => ['nullable', 'string'],
            'bio_en'     => ['nullable', 'string'],
            'published'  => ['sometimes', 'boolean'],
            'image'      => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge(['published' => (bool) $this->boolean('published')]);
    }
}
