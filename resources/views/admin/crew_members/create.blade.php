@extends('layouts.admin')

@section('title','Créer un membre de l’équipage')

@section('content')
    <h1 class="text-xl font-semibold mb-4">Créer un membre</h1>

    <form
        method="POST"
        action="{{ route('admin.crew.store') }}"
        enctype="multipart/form-data"
    >
        {{-- On passe un nouveau modèle vide au form --}}
        @include('admin.crew_members._form', ['member' => $member])
    </form>
@endsection
