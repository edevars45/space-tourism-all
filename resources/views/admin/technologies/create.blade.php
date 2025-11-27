@extends('layouts.admin')
@section('title', 'Créer une technologie')

@section('content')
    <h1 class="text-xl font-semibold mb-4">Créer une technologie</h1>

    <form method="POST"
          action="{{ route('admin.technologies.store') }}"
          enctype="multipart/form-data">
        @include('admin.technologies._form', ['technology' => $technology])
    </form>
@endsection
