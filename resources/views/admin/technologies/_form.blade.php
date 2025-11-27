@php
    /** @var \App\Models\Technology $technology */

    // Je vérifie si je suis en mode édition (en base) ou en création
    $isEdit = $technology->exists ?? false;

    // Je récupère la valeur brute de "is_published"
    //  - d’abord dans old('is_published') après un échec de validation
    //  - sinon dans la BDD si je suis en édition
    //  - sinon 1 par défaut pour une nouvelle techno (case cochée)
    $rawIsPublished = old(
        'is_published',
        $isEdit ? (int) $technology->is_published : 1
    );

    // Je transforme cette valeur en entier strict, puis en booléen
    // => si la valeur vaut 1, la case est cochée, sinon elle est décochée
    $isPublished = (int) $rawIsPublished === 1;
@endphp

{{-- Je protège mon formulaire contre les attaques CSRF --}}
@csrf

<div class="space-y-6">

    {{-- IDENTITÉ (FR) --}}
    <div class="grid md:grid-cols-2 gap-4">

        <div>
            {{-- Je crée le champ Nom français, obligatoire --}}
            <label class="block text-sm mb-1">Nom *</label>
            <input
                type="text"                                     {{-- Je précise que c’est un champ texte --}}
                name="name"                                     {{-- Je donne le nom du champ --}}
                value="{{ old('name', $technology->name) }}"   {{-- Je pré-remplis avec old() ou la BDD --}}
                class="w-full rounded border border-white/40 bg-transparent text-white px-3 py-2"
                required                                        {{-- Je rends ce champ obligatoire --}}
            >
            @error('name')
                {{-- J’affiche un éventuel message d’erreur pour le nom --}}
                <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            {{-- Je crée le champ Slug, optionnel --}}
            <label class="block text-sm mb-1">Slug</label>
            <input
                type="text"                                     {{-- Je précise que c’est un champ texte --}}
                name="slug"                                     {{-- Je donne le nom du champ --}}
                value="{{ old('slug', $technology->slug) }}"   {{-- Je pré-remplis avec old() ou la BDD --}}
                class="w-full rounded border border-white/40 bg-transparent text-white px-3 py-2"
                placeholder="launch-vehicle"                    {{-- Je donne un exemple de slug --}}
            >
            <p class="text-xs text-white/60 mt-1">
                Je peux laisser vide pour générer automatiquement le slug à partir du nom.
            </p>
            @error('slug')
                {{-- J’affiche un éventuel message d’erreur pour le slug --}}
                <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
            @enderror
        </div>

    </div>

    <div class="grid md:grid-cols-2 gap-4">

        <div>
            {{-- Je crée le champ Ordre, numérique --}}
            <label class="block text-sm mb-1">Ordre</label>
            <input
                type="number"                                   {{-- Je précise que c’est un nombre --}}
                name="order"                                    {{-- Je donne le nom du champ --}}
                min="0"                                         {{-- Je n’autorise pas de valeur négative --}}
                step="1"                                        {{-- Je fais augmenter par pas de 1 --}}
                value="{{ old('order', $technology->order ?? 0) }}" {{-- Je mets 0 par défaut --}}
                class="w-full rounded border border-white/40 bg-transparent text-white px-3 py-2"
            >
            @error('order')
                {{-- J’affiche un éventuel message d’erreur pour l’ordre --}}
                <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-2 mt-7">
            {{-- Je crée la case à cocher "Publié" pour la technologie --}}
            <input
                type="checkbox"                                 {{-- Je précise que c’est une checkbox --}}
                id="is_published"                               {{-- Je donne un id pour le label --}}
                name="is_published"                             {{-- Je donne le nom du champ --}}
                value="1"                                       {{-- Je renvoie "1" si la case est cochée --}}
                class="h-4 w-4 cursor-pointer"                  {{-- Je garde le style natif pour bien voir la coche --}}
                {{ $isPublished ? 'checked' : '' }}             {{-- Je coche la case si la techno est publiée --}}
            >
            <label for="is_published" class="text-sm cursor-pointer">
                Publié
            </label>
            @error('is_published')
                {{-- J’affiche un éventuel message d’erreur pour is_published --}}
                <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
            @enderror
        </div>

    </div>

    {{-- DESCRIPTION FR --}}
    <div>
        {{-- Je crée la description française de la technologie --}}
        <label class="block text-sm mb-1">Description</label>
        <textarea
            name="description"                                 {{-- Je donne le nom du champ --}}
            rows="5"                                           {{-- Je fixe une hauteur par défaut --}}
            class="w-full rounded border border-white/40 bg-transparent text-white px-3 py-2"
        >{{ old('description', $technology->description) }}</textarea>
        @error('description')
            {{-- J’affiche un éventuel message d’erreur pour la description FR --}}
            <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- SITE OFFICIEL --}}
    <div>
        {{-- Je crée le champ URL du site officiel --}}
        <label class="block text-sm mb-1">Site officiel (URL)</label>
        <input
            type="url"                                         {{-- Je précise que c’est une URL --}}
            name="website_url"                                 {{-- Je donne le nom du champ --}}
            value="{{ old('website_url', $technology->website_url) }}" {{-- Je pré-remplis avec old() ou la BDD --}}
            class="w-full rounded border border-white/40 bg-transparent text-white px-3 py-2"
            placeholder="https://example.com"
        >
        @error('website_url')
            {{-- J’affiche un éventuel message d’erreur pour l’URL --}}
            <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- IMAGE (UPLOAD) --}}
    <div>
        {{-- Je crée le champ d’upload de logo pour la technologie --}}
        <label class="block text-sm mb-1">Image (logo)</label>
        <input
            type="file"                                       {{-- Je précise que c’est un champ fichier --}}
            name="image"                                      {{-- Je donne le nom du champ --}}
            class="w-full rounded border border-white/40 bg-transparent text-white px-3 py-2"
        >
        @error('image')
            {{-- J’affiche un éventuel message d’erreur pour l’image --}}
            <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
        @enderror

        @if($technology->image_path)
            {{-- Je montre un texte indiquant l’image actuelle --}}
            <p class="text-xs text-white/60 mt-1">
                Image actuelle :
                {{ $technology->image_path }}
            </p>

            {{-- Je peux aussi afficher un aperçu si je le souhaite --}}
            <div class="mt-2">
                <img
                    src="{{ asset($technology->image_path) }}"  {{-- Je charge l’image depuis public/ --}}
                    alt="{{ $technology->name }}"                {{-- Je mets le nom dans l’attribut alt --}}
                    class="h-20 object-contain"
                >
            </div>
        @endif
    </div>

    {{-- VERSION ANGLAISE --}}
    <hr class="border-white/20 my-6">

    <h2 class="text-lg font-semibold">Version anglaise</h2>

    <div class="grid md:grid-cols-2 gap-4">
        <div>
            {{-- Je crée le nom anglais de la technologie --}}
            <label class="block text-sm mb-1">Nom (EN)</label>
            <input
                type="text"                                     {{-- Je précise que c’est un champ texte --}}
                name="name_en"                                  {{-- Je donne le nom du champ --}}
                value="{{ old('name_en', $technology->name_en ?? '') }}" {{-- Je pré-remplis avec old() ou BDD --}}
                class="w-full rounded border border-white/40 bg-transparent text-white px-3 py-2"
                placeholder="Launch vehicle"
            >
            @error('name_en')
                {{-- J’affiche un éventuel message d’erreur pour le nom EN --}}
                <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div>
        {{-- Je crée la description anglaise --}}
        <label class="block text-sm mb-1">Description (EN)</label>
        <textarea
            name="description_en"                               {{-- Je donne le nom du champ --}}
            rows="5"                                            {{-- Je fixe une hauteur par défaut --}}
            class="w-full rounded border border-white/40 bg-transparent text-white px-3 py-2"
        >{{ old('description_en', $technology->description_en ?? '') }}</textarea>
        @error('description_en')
            {{-- J’affiche un éventuel message d’erreur pour la description EN --}}
            <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- BOUTONS --}}
    <div class="mt-6 flex gap-3">
        {{-- Je crée le bouton de validation du formulaire --}}
        <button class="bg-[#D0D6F9] text-black px-4 py-2 rounded" type="submit">
            {{ $isEdit ? 'Mettre à jour' : 'Créer' }}
        </button>

        {{-- Je crée le lien pour revenir à la liste des technologies --}}
        <a
            href="{{ route('admin.technologies.index') }}"      {{-- Je redirige vers l’index --}}
            class="px-4 py-2 rounded border border-white/20"
        >
            Annuler
        </a>
    </div>

</div>
