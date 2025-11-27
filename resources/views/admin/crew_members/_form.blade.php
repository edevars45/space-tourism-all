@php
    /** @var \App\Models\CrewMember $member */

    // Est-ce qu’on est en édition (en base) ou en création ?
    $isEdit = $member->exists ?? false;

    // Valeur brute de is_published :
    //  - old('is_published') si validation échouée
    //  - sinon la valeur de la BDD si on édite
    //  - sinon 1 (coché par défaut en création)
    $rawIsPublished = old(
        'is_published',
        $isEdit ? (int) $member->is_published : 1
    );

    // On transforme en bool strict
    $isPublished = (int) $rawIsPublished === 1;
@endphp

{{-- Protection CSRF --}}
@csrf

<div class="space-y-6">

    {{-- IDENTITÉ --}}
    <div class="grid md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm mb-1">Nom *</label>
            <input
                type="text"
                name="name"
                value="{{ old('name', $member->name) }}"
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
                value="{{ old('slug', $member->slug) }}"
                class="w-full rounded border border-white/40 bg-transparent text-white px-3 py-2"
                placeholder="douglas-hurley"
            >
            <p class="text-xs text-white/60 mt-1">
                Tu peux laisser vide pour générer automatiquement à partir du nom.
            </p>
            @error('slug')
                <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

    {{-- VERSION FR --}}
    <h2 class="text-lg font-semibold mt-4">Version française</h2>

    <div class="grid md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm mb-1">Rôle *</label>
            <input
                type="text"
                name="role"
                value="{{ old('role', $member->role) }}"
                class="w-full rounded border border-white/40 bg-transparent text-white px-3 py-2"
                required
            >
            @error('role')
                <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm mb-1">Ordre</label>
            <input
                type="number"
                name="order"
                min="0"
                step="1"
                value="{{ old('order', $member->order ?? 0) }}"
                class="w-full rounded border border-white/40 bg-transparent text-white px-3 py-2"
            >
            @error('order')
                <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div>
        <label class="block text-sm mb-1">Biographie</label>
        <textarea
            name="bio"
            rows="5"
            class="w-full rounded border border-white/40 bg-transparent text-white px-3 py-2"
        >{{ old('bio', $member->bio) }}</textarea>
        @error('bio')
            <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- VERSION EN --}}
    <hr class="border-white/20 my-6">

    <h2 class="text-lg font-semibold">Version anglaise</h2>

    <div class="grid md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm mb-1">Rôle (EN)</label>
            <input
                type="text"
                name="role_en"
                value="{{ old('role_en', $member->role_en ?? '') }}"
                class="w-full rounded border border-white/40 bg-transparent text-white px-3 py-2"
                placeholder="Commander"
            >
            @error('role_en')
                <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div>
        <label class="block text-sm mb-1">Biographie (EN)</label>
        <textarea
            name="bio_en"
            rows="5"
            class="w-full rounded border border-white/40 bg-transparent text-white px-3 py-2"
        >{{ old('bio_en', $member->bio_en ?? '') }}</textarea>
        @error('bio_en')
            <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- IMAGE + PUBLIÉ --}}
    <div class="grid md:grid-cols-2 gap-4 items-start">
        <div>
            <label class="block text-sm mb-1">Image (upload)</label>
            <input
                type="file"
                name="image"
                class="w-full rounded border border-white/40 bg-transparent text-white px-3 py-2"
            >
            @error('image')
                <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
            @enderror

            @if($member->image_path)
                <p class="text-xs text-white/60 mt-1">
                    Actuelle :
                    <a href="{{ asset($member->image_path) }}" target="_blank" class="underline">
                        {{ $member->image_path }}
                    </a>
                </p>
                <div class="mt-2">
                    <img
                        src="{{ asset($member->image_path) }}"
                        alt="{{ $member->name }}"
                        class="h-20 object-contain"
                    >
                </div>
            @endif
        </div>

        <div class="flex items-center gap-2 mt-6">
            <input
                type="checkbox"
                id="is_published"
                name="is_published"
                value="1"
                class="h-4 w-4 rounded border border-white/60 bg-black accent-[#D0D6F9]"
                {{ $isPublished ? 'checked' : '' }}
            >
            <label for="is_published" class="text-sm">
                Publié
            </label>
            @error('is_published')
                <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

    {{-- BOUTONS --}}
    <div class="mt-6 flex gap-3">
        <button class="bg-[#D0D6F9] text-black px-4 py-2 rounded" type="submit">
            {{ $isEdit ? 'Mettre à jour' : 'Créer' }}
        </button>

        <a
            href="{{ route('admin.crew.index') }}"
            class="px-4 py-2 rounded border border-white/20"
        >
            Annuler
        </a>
    </div>
</div>
