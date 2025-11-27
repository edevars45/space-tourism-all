@extends('layouts.admin')

@section('title', 'Ajouter une planète')

@section('content')
    <h1 class="text-2xl font-semibold text-white mb-6">
        Ajouter une planète
    </h1>

    <form
        method="POST"
        action="{{ route('admin.planets.store') }}"
        class="space-y-6"
    >
        @include('admin.planets._form')
    </form>
@endsection
