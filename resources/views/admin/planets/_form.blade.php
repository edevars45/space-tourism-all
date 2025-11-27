@php
    /** @var \App\Models\Planet|null $planet */

    $isEdit = isset($planet) && $planet->exists;

    $rawIsPublished = old(
        'is_published',
        $isEdit ? (int) ($planet->is_published ?? $planet->published ?? 0) : 1
    );
    $isPublished = (int) $rawIsPublished === 1;
@endphp

@csrf

@if($isEdit)
    @method('PUT')
@endif

<div class="space-y-6">

    {{-- Nom + Slug --}}
    <div class="grid md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm mb-1">Nom *</label>
            <input
                type="text"
                name="name"
                value="{{ old('name', $planet->name ?? '') }}"
                class="w-full rounded border border-white/40 bg-transparent text-white px-3 py-2"
                required
            >
            @error('name')
                <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm mb-1">Slug</label>
            <input
                type="text"
                name="slug"
                value="{{ old('slug', $planet->slug ?? '') }}"
                class="w-full rounded border border-white/40 bg-transparent text-white px-3 py-2"
                placeholder="moon"
            >
            <p class="text-xs text-white/60 mt-1">
                Tu peux laisser vide pour générer automatiquement le slug.
            </p>
            @error('slug')
                <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

    {{-- Ordre + Publié --}}
    <div class="grid md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm mb-1">Ordre</label>
            <input
                type="number"
                name="order"
                min="0"
                step="1"
                value="{{ old('order', $planet->order ?? 0) }}"
                class="w-full rounded border border-white/40 bg-transparent text-white px-3 py-2"
            >
            @error('order')
                <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-2 mt-7">
            <input
                type="checkbox"
                id="is_published"
                name="is_published"
                value="1"
                class="h-4 w-4 cursor-pointer"
                {{ $isPublished ? 'checked' : '' }}
            >
            <label for="is_published" class="text-sm cursor-pointer">
                Publié
            </label>
            @error('is_published')
                <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

    {{-- Distance + Temps de trajet --}}
    <div class="grid md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm mb-1">Distance</label>
            <input
                type="text"
                name="distance"
                value="{{ old('distance', $planet->distance ?? '') }}"
                class="w-full rounded border border-white/40 bg-transparent text-white px-3 py-2"
                placeholder="384 400 km"
            >
            @error('distance')
                <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm mb-1">Temps de trajet</label>
            <input
                type="text"
                name="travel_time"
                value="{{ old('travel_time', $planet->travel_time ?? '') }}"
                class="w-full rounded border border-white/40 bg-transparent text-white px-3 py-2"
                placeholder="3 jours"
            >
            @error('travel_time')
                <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

    {{-- Description FR --}}
    <div>
        <label class="block text-sm mb-1">Description</label>
        <textarea
            name="description"
            rows="5"
            class="w-full rounded border border-white/40 bg-transparent text-white px-3 py-2"
        >{{ old('description', $planet->description ?? '') }}</textarea>
        @error('description')
            <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Image (chemin) --}}
    <div>
        <label class="block text-sm mb-1">Image (chemin dans storage)</label>
        <input
            type="text"
            name="image"
            value="{{ old('image', $planet->image ?? '') }}"
            class="w-full rounded border border-white/40 bg-transparent text-white px-3 py-2"
            placeholder="planets/moon.png"
        >
        <p class="text-xs text-white/60 mt-1">
            Exemple : <code>planets/moon.png</code> (dans <code>storage/app/public/planets</code>).
        </p>
        @error('image')
            <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
        @enderror

        @if(!empty($planet?->image))
            <p class="text-xs text-white/60 mt-1">
                Image actuelle : {{ $planet->image }}
            </p>
            <div class="mt-2">
                <img
                    src="{{ asset('storage/'.$planet->image) }}"
                    alt="{{ $planet->name ?? '' }}"
                    class="h-24 object-contain"
                >
            </div>
        @endif
    </div>

    {{-- Boutons --}}
    <div class="mt-6 flex gap-3">
        <button class="bg-[#D0D6F9] text-black px-4 py-2 rounded" type="submit">
            {{ $isEdit ? 'Mettre à jour' : 'Créer' }}
        </button>

        <a href="{{ route('admin.planets.index') }}"
           class="px-4 py-2 rounded border border-white/20">
            Annuler
        </a>
    </div>
</div>
