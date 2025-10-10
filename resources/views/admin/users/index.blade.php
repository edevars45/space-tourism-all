{{-- J'étends mon layout admin global (si tu en as un) --}}
@extends('layouts.admin')

{{-- Je définis le contenu de la page --}}
@section('content')
    {{-- Je mets un titre clair --}}
    <h1 class="mb-4">Utilisateurs</h1>

    {{-- Je place un bandeau avec filtre et bouton de création --}}
    <div class="d-flex justify-content-between mb-3">
        {{-- Je crée un petit formulaire GET pour la recherche --}}
        <form method="GET" class="d-flex gap-2">
            {{-- Je réinjecte la valeur tapée pour le confort --}}
            <input type="text" name="q" value="{{ $q ?? '' }}" placeholder="Rechercher nom/email" class="form-control" />
            <button class="btn btn-primary">Filtrer</button>
        </form>

        {{-- Je mets un raccourci vers la création --}}
        <a href="{{ route('admin.users.create') }}" class="btn btn-success">Nouvel utilisateur</a>
    </div>

    {{-- J'affiche la table des utilisateurs --}}
    <table class="table table-striped align-middle">
        <thead>
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Rôles</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse($users as $u)
            <tr>
                {{-- J'affiche l'id --}}
                <td>{{ $u->id }}</td>

                {{-- J'affiche le nom --}}
                <td>{{ $u->name }}</td>

                {{-- J'affiche l'email --}}
                <td>{{ $u->email }}</td>

                {{-- J'affiche les rôles sous forme de liste séparée par des virgules --}}
                <td>{{ $u->roles->pluck('name')->join(', ') }}</td>

                {{-- J'affiche les actions alignées à droite --}}
                <td class="text-end">
                    {{-- Je crée un lien vers l'édition --}}
                    <a href="{{ route('admin.users.edit',$u) }}" class="btn btn-sm btn-primary">Éditer</a>

                    {{-- Je crée un formulaire inline pour la suppression --}}
                    <form action="{{ route('admin.users.destroy',$u) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        {{-- Je demande une confirmation basique côté client --}}
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Supprimer {{ $u->name }} ?')">
                            Suppr.
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            {{-- J'affiche une ligne vide si aucun utilisateur --}}
            <tr><td colspan="5">Aucun utilisateur.</td></tr>
        @endforelse
        </tbody>
    </table>

    {{-- Je place la pagination --}}
    {{ $users->links() }}
@endsection
