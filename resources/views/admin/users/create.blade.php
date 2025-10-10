# create.blade.php
cat > resources/views/admin/users/create.blade.php <<'BLADE'
@extends('layouts.admin')

@section('content')
    <h1 class="mb-4">Nouvel utilisateur</h1>
    <form method="POST" action="{{ route('admin.users.store') }}">
        @include('admin.users._form')
    </form>
@endsection
BLADE
