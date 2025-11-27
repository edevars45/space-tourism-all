@extends('layouts.admin')

@section('title', 'Modifier une technologie')

@section('content')
<div class="max-w-4xl">
    <h1 class="text-3xl font-bold mb-6">Modifier : {{ $technology->name }}</h1>

    <form method="POST" action="{{ route('admin.technologies.update', $technology) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Nom FR --}}
        <div>
            <label for="name" class="block text-sm font-medium mb-2">Nom (FR) *</label>
            <input type="text" name="name" id="name" value="{{ old('name', $technology->name) }}"
                   class="w-full px-4 py-2 rounded border @error('name') border-red-500 @enderror" required>
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Nom EN --}}
        <div>
            <label for="name_en" class="block text-sm font-medium mb-2">Nom (EN)</label>
            <input type="text" name="name_en" id="name_en" value="{{ old('name_en', $technology->name_en) }}"
                   class="w-full px-4 py-2 rounded border">
            @error('name_en')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Description FR --}}
        <div>
            <label for="description" class="block text-sm font-medium mb-2">Description (FR)</label>
            <textarea name="description" id="description" rows="5"
                      class="w-full px-4 py-2 rounded border">{{ old('description', $technology->description) }}</textarea>
        </div>

        {{-- Description EN --}}
        <div>
            <label for="description_en" class="block text-sm font-medium mb-2">Description (EN)</label>
            <textarea name="description_en" id="description_en" rows="5"
                      class="w-full px-4 py-2 rounded border">{{ old('description_en', $technology->description_en) }}</textarea>
        </div>

        {{-- URL du site --}}
        <div>
            <label for="website_url" class="block text-sm font-medium mb-2">URL du site</label>
            <input type="url" name="website_url" id="website_url" value="{{ old('website_url', $technology->website_url) }}"
                   class="w-full px-4 py-2 rounded border">
        </div>

        {{-- Ordre --}}
        <div>
            <label for="order" class="block text-sm font-medium mb-2">Ordre</label>
            <input type="number" name="order" id="order" value="{{ old('order', $technology->order) }}"
                   class="w-full px-4 py-2 rounded border" min="0">
        </div>

        {{-- Image --}}
        <div>
            <label for="image" class="block text-sm font-medium mb-2">Image</label>
            <input type="file" name="image" id="image" class="w-full px-4 py-2 rounded border" accept="image/*">
        </div>

        {{-- Publié --}}
        <div class="flex items-center gap-3">
            <input type="hidden" name="is_published" value="0">
            <input type="checkbox" name="is_published" id="is_published" value="1"
                   {{ old('is_published', $technology->is_published) ? 'checked' : '' }}
                   class="w-5 h-5">
            <label for="is_published">Publié</label>
        </div>

        {{-- Boutons --}}
        <div class="flex gap-4">
            <button type="submit" class="btn-primary">Enregistrer</button>
            <a href="{{ route('admin.technologies.index') }}" class="btn-outline">Annuler</a>
        </div>
    </form>
</div>
@endsection
