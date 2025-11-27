@extends('layouts.admin')

@section('title', 'Modifier une planète')

@section('content')
<div class="max-w-4xl">
    <h1 class="text-3xl font-bold mb-6">Modifier : {{ $planet->name }}</h1>

    <form method="POST" action="{{ route('admin.planets.update', $planet) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Nom FR --}}
        <div>
            <label for="name" class="block text-sm font-medium mb-2">Nom (FR) *</label>
            <input type="text" name="name" id="name" value="{{ old('name', $planet->name) }}"
                   class="w-full px-4 py-2 rounded border @error('name') border-red-500 @enderror" required>
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Nom EN --}}
        <div>
            <label for="name_en" class="block text-sm font-medium mb-2">Nom (EN)</label>
            <input type="text" name="name_en" id="name_en" value="{{ old('name_en', $planet->name_en) }}"
                   class="w-full px-4 py-2 rounded border">
            @error('name_en')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Slug --}}
        <div>
            <label for="slug" class="block text-sm font-medium mb-2">Slug</label>
            <input type="text" name="slug" id="slug" value="{{ old('slug', $planet->slug) }}"
                   class="w-full px-4 py-2 rounded border">
            @error('slug')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Description FR --}}
        <div>
            <label for="description" class="block text-sm font-medium mb-2">Description (FR)</label>
            <textarea name="description" id="description" rows="5"
                      class="w-full px-4 py-2 rounded border">{{ old('description', $planet->description) }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Description EN --}}
        <div>
            <label for="description_en" class="block text-sm font-medium mb-2">Description (EN)</label>
            <textarea name="description_en" id="description_en" rows="5"
                      class="w-full px-4 py-2 rounded border">{{ old('description_en', $planet->description_en) }}</textarea>
            @error('description_en')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Distance --}}
        <div>
            <label for="distance" class="block text-sm font-medium mb-2">Distance</label>
            <input type="text" name="distance" id="distance" value="{{ old('distance', $planet->distance) }}"
                   class="w-full px-4 py-2 rounded border" placeholder="384 400 KM">
            @error('distance')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Temps de trajet --}}
        <div>
            <label for="travel_time" class="block text-sm font-medium mb-2">Temps de trajet</label>
            <input type="text" name="travel_time" id="travel_time" value="{{ old('travel_time', $planet->travel_time) }}"
                   class="w-full px-4 py-2 rounded border" placeholder="3 JOURS">
            @error('travel_time')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Ordre --}}
        <div>
            <label for="order" class="block text-sm font-medium mb-2">Ordre d'affichage</label>
            <input type="number" name="order" id="order" value="{{ old('order', $planet->order) }}"
                   class="w-full px-4 py-2 rounded border" min="0">
            @error('order')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Image --}}
        <div>
            <label for="image_upload" class="block text-sm font-medium mb-2">Image</label>
            <input type="file" name="image_upload" id="image_upload" class="w-full px-4 py-2 rounded border" accept="image/*">
            @error('image_upload')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Publié --}}
        <div class="flex items-center gap-3">
            <input type="hidden" name="published" value="0">
            <input type="checkbox" name="published" id="published" value="1"
                   {{ old('published', $planet->is_published) ? 'checked' : '' }}
                   class="w-5 h-5">
            <label for="published" class="text-sm font-medium">Publié</label>
        </div>

        {{-- Boutons --}}
        <div class="flex gap-4">
            <button type="submit" class="btn-primary">Enregistrer</button>
            <a href="{{ route('admin.planets.index') }}" class="btn-outline">Annuler</a>
        </div>
    </form>
</div>
@endsection
