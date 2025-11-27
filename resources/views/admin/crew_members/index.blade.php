{{-- resources/views/admin/crew_members/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Équipage')

@section('content')

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold">Équipage</h1>

        <a href="{{ route('admin.crew.create') }}"
           class="bg-[#D0D6F9] text-black px-4 py-2 rounded">
            Nouveau membre
        </a>
    </div>

    {{-- Message de succès éventuel --}}
    @if(session('success'))
        <div class="mb-4 rounded border border-green-500/40 bg-green-500/10 px-4 py-2 text-sm text-green-200">
            {{ session('success') }}
        </div>
    @endif

    @php
        // Détection "liste vide" compatible collection / array / pagination
        $isEmpty =
            ($members instanceof \Illuminate\Support\Collection && $members->isEmpty())
            || (is_array($members) && count($members) === 0)
            || ($members instanceof \Illuminate\Contracts\Pagination\Paginator && $members->count() === 0);
    @endphp

    @if($isEmpty)
        <div class="border border-white/10 rounded p-6 text-white/70">
            Aucun membre pour le moment.
        </div>
    @else
        <div class="overflow-x-auto border border-white/10 rounded">
            <table class="min-w-full text-sm">
                <thead class="bg-white/5">
                    <tr class="text-left">
                        <th class="px-4 py-3">#</th>
                        <th class="px-4 py-3">Nom</th>
                        <th class="px-4 py-3">Rôle</th>
                        <th class="px-4 py-3">Ordre</th>
                        <th class="px-4 py-3">Publié</th>
                        <th class="px-4 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($members as $m)
                        @php
                            // on regarde d'abord is_published, puis published si jamais ça change un jour
                            $published = (bool) ($m->is_published ?? $m->published ?? false);
                        @endphp

                        <tr class="border-t border-white/10">
                            <td class="px-4 py-3">{{ $m->id }}</td>
                            <td class="px-4 py-3">{{ $m->name }}</td>
                            <td class="px-4 py-3">{{ $m->role }}</td>
                            <td class="px-4 py-3">{{ $m->order ?? '-' }}</td>

                            <td class="px-4 py-3">
                                @if($published)
                                    <span class="px-2 py-1 text-xs rounded bg-green-500/20 text-green-300">
                                        Oui
                                    </span>
                                @else
                                    <span class="px-2 py-1 text-xs rounded bg-red-500/20 text-red-300">
                                        Non
                                    </span>
                                @endif
                            </td>

                            <td class="px-4 py-3 text-right">
                                <a href="{{ route('admin.crew.edit', $m) }}"
                                   class="px-3 py-1 rounded border border-white/20 mr-2">
                                    Éditer
                                </a>

                                <form action="{{ route('admin.crew.destroy', $m) }}"
                                      method="POST"
                                      class="inline"
                                      onsubmit="return confirm('Supprimer ce membre ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="px-3 py-1 rounded bg-red-600/80 hover:bg-red-600">
                                        Suppr.
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($members instanceof \Illuminate\Contracts\Pagination\Paginator)
            <div class="mt-4">
                {{ $members->links() }}
            </div>
        @endif
    @endif

@endsection
