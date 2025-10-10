cat > resources/views/admin/users/_form.blade.php <<'BLADE'
@csrf

{{-- Nom --}}
<div class="mb-3">
    <label class="form-label">Nom</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name ?? '') }}" required>
    @error('name')<div class="text-danger small">{{ $message }}</div>@enderror
</div>

{{-- Email --}}
<div class="mb-3">
    <label class="form-label">Email</label>
    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email ?? '') }}" required>
    @error('email')<div class="text-danger small">{{ $message }}</div>@enderror
</div>

{{-- Mot de passe --}}
<div class="mb-3">
    <label class="form-label">Mot de passe @isset($user)<small>(laisser vide pour ne pas changer)</small>@endisset</label>
    <input type="password" name="password" class="form-control" @empty($user) required @endempty>
    @error('password')<div class="text-danger small">{{ $message }}</div>@enderror
</div>

{{-- Confirmation --}}
<div class="mb-3">
    <label class="form-label">Confirmation mot de passe</label>
    <input type="password" name="password_confirmation" class="form-control" @empty($user) required @endempty>
</div>

{{-- Rôles --}}
<div class="mb-3">
    <label class="form-label">Rôles</label>
    <div class="d-flex gap-3 flex-wrap">
        @foreach($roles as $roleName => $label)
            <label class="form-check">
                <input type="checkbox" class="form-check-input"
                       name="roles[]"
                       value="{{ $roleName }}"
                       @checked(in_array($roleName, old('roles', $userRoles ?? [])))>
                <span class="form-check-label">{{ $roleName }}</span>
            </label>
        @endforeach
    </div>
    @error('roles')<div class="text-danger small">{{ $message }}</div>@enderror
</div>

<div class="mt-3">
    <button class="btn btn-primary">Enregistrer</button>
    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">Annuler</a>
</div>
BLADE
