cat > resources/views/layouts/admin.blade.php <<'BLADE'
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title','Back-office')</title>
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/dashboard') }}">Back-office</a>
        <ul class="navbar-nav ms-auto">
            @role('Administrateur')
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.users.index') }}">Utilisateurs</a></li>
            @endrole
            @can('technologies.manage')
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.technologies.index') }}">Technologies</a></li>
            @endcan
        </ul>
    </div>
</nav>

<main class="container">
    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    @if(session('error'))   <div class="alert alert-danger">{{ session('error') }}</div> @endif

    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
