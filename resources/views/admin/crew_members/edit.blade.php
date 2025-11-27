@extends('layouts.admin')

@section('title', 'Modifier un membre')

@section('content')
<div class="max-w-4xl">
    <h1 class="text-3xl font-bold mb-6">Modifier : {{ $member->name }}</h1>

    <form method="POST" action="{{ route('admin.crew.update', $member) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Nom --}}
        <div>
            <label for="name" class="block text-sm font-medium mb-2">Nom *</label>
            <input type="text" name="name" id="name" value="{{ old('name', $member->name) }}"
                   class="w-full px-4 py-2 rounded border @error('name') border-red-500 @enderror" required>
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Slug --}}
        <div>
            <label for="slug" class="block text-sm font-medium mb-2">Slug</label>
            <input type="text" name="slug" id="slug" value="{{ old('slug', $member->slug) }}"
                   class="w-full px-4 py-2 rounded border">
            @error('slug')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Rôle FR --}}
        <div>
            <label for="role" class="block text-sm font-medium mb-2">Rôle (FR) *</label>
            <input type="text" name="role" id="role" value="{{ old('role', $member->role) }}"
                   class="w-full px-4 py-2 rounded border @error('role') border-red-500 @enderror" required>
            @error('role')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Rôle EN --}}
        <div>
            <label for="role_en" class="block text-sm font-medium mb-2">Rôle (EN)</label>
            <input type="text" name="role_en" id="role_en" value="{{ old('role_en', $member->role_en) }}"
                   class="w-full px-4 py-2 rounded border">
            @error('role_en')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Bio FR --}}
        <div>
            <label for="bio" class="block text-sm font-medium mb-2">Biographie (FR)</label>
            <textarea name="bio" id="bio" rows="5"
                      class="w-full px-4 py-2 rounded border">{{ old('bio', $member->bio) }}</textarea>
            @error('bio')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Bio EN --}}
        <div>
            <label for="bio_en" class="block text-sm font-medium mb-2">Biographie (EN)</label>
            <textarea name="bio_en" id="bio_en" rows="5"
                      class="w-full px-4 py-2 rounded border">{{ old('bio_en', $member->bio_en) }}</textarea>
            @error('bio_en')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Ordre --}}
        <div>
            <label for="order" class="block text-sm font-medium mb-2">Ordre d'affichage</label>
            <input type="number" name="order" id="order" value="{{ old('order', $member->order) }}"
                   class="w-full px-4 py-2 rounded border" min="0">
            @error('order')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Image --}}
        <div>
            <label for="image" class="block text-sm font-medium mb-2">Image</label>
            @if($member->image_path)
                <img src="{{ asset('storage/' . $member->image_path) }}" alt="{{ $member->name }}" class="w-32 h-32 object-cover rounded mb-2">
            @endif
            <input type="file" name="image" id="image" class="w-full px-4 py-2 rounded border" accept="image/*">
            @error('image')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Publié --}}
        <div class="flex items-center gap-3">
            <input type="hidden" name="published" value="0">
            <input type="checkbox" name="published" id="published" value="1"
                   {{ old('published', $member->is_published) ? 'checked' : '' }}
                   class="w-5 h-5">
            <label for="published" class="text-sm font-medium">Publié</label>
        </div>

        {{-- Boutons --}}
        <div class="flex gap-4">
            <button type="submit" class="btn-primary">
                Enregistrer
            </button>
            <a href="{{ route('admin.crew.index') }}" class="btn-outline">
                Annuler
            </a>
        </div>
    </form>
</div>
@endsection
