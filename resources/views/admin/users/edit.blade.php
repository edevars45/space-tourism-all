# edit.blade.php
cat > resources/views/admin/users/edit.blade.php <<'BLADE'
@extends('layouts.admin')

@section('content')
    <h1 class="mb-4">Éditer utilisateur</h1>
    <form method="POST" action="{{ route('admin.users.update', $user) }}">
        @method('PUT')
        @include('admin.users._form', ['user' => $user])
    </form>
@endsection
BLADE
