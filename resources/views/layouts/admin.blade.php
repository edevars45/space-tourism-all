{{-- resources/views/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title','Back-office') — {{ config('app.name','Space Tourism') }}</title>
  @vite(['resources/css/app.css','resources/js/app.js'])

  <style>
    /* Lisibilité des champs dans le thème sombre du BO */
    .admin-scope input,
    .admin-scope textarea,
    .admin-scope select {
      background:#fff !important;
      color:#111 !important;
      border-color:#37415133 !important;
      -webkit-text-fill-color:#111 !important;
      caret-color:#111 !important;
    }
    .admin-scope input::placeholder,
    .admin-scope textarea::placeholder { color:#6b7280 !important; opacity:1; }
    .admin-scope input:focus,
    .admin-scope textarea:focus,
    .admin-scope select:focus {
      outline: none !important;
      box-shadow: 0 0 0 2px #93c5fd33, 0 0 0 1px #60a5fa !important;
    }
    .admin-scope input:-webkit-autofill,
    .admin-scope textarea:-webkit-autofill,
    .admin-scope select:-webkit-autofill {
      box-shadow: 0 0 0 1000px #fff inset !important;
      -webkit-text-fill-color:#111 !important;
    }
  </style>
</head>

<body class="antialiased bg-black text-white admin-scope">
<a href="#admin-main" class="sr-only focus:not-sr-only focus:absolute focus:top-2 focus:left-2 focus:bg-white focus:text-black focus:p-2 focus:rounded">Aller au contenu</a>

@php
  $baseLink = 'text-white/80 hover:text-[#D0D6F9]';
  $active   = 'text-[#D0D6F9]';
  $isActive = fn(string $pat) => request()->routeIs($pat) ? $active : '';
@endphp

<div class="min-h-screen flex flex-col">
  <header class="sticky top-0 z-40 bg-black/90 backdrop-blur border-b border-white/10">
    <div class="max-w-7xl mx-auto w-full px-4 sm:px-6 md:px-10 py-3">
      <div class="flex items-center justify-between gap-4">
        <a href="{{ route('dashboard') }}" class="font-semibold tracking-wide">Back-office</a>

        <!-- Bouton burger (mobile) -->
        <button id="admin-menu-btn"
                class="inline-flex items-center justify-center rounded md:hidden p-2 text-white/80 hover:text-[#D0D6F9] focus:outline-none focus:ring"
                aria-controls="admin-menu" aria-expanded="false">
          <span class="sr-only">Ouvrir le menu</span>
          <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M4 6h16M4 12h16M4 18h16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
          </svg>
        </button>

        <!-- Nav desktop -->
        <nav id="admin-menu-desktop" class="hidden md:flex items-center gap-6 text-sm">
          @role('Administrateur')
            <a href="{{ route('admin.users.index') }}"
               class="{{ $baseLink }} {{ $isActive('admin.users.*') }}"
               @if(request()->routeIs('admin.users.*')) aria-current="page" @endif>
              Utilisateurs
            </a>
          @endrole

          @can('technologies.manage')
            <a href="{{ route('admin.technologies.index') }}"
               class="{{ $baseLink }} {{ $isActive('admin.technologies.*') }}"
               @if(request()->routeIs('admin.technologies.*')) aria-current="page" @endif>
              Technologies
            </a>
          @endcan

          @can('planets.manage')
            <a href="{{ route('admin.planets.index') }}"
               class="{{ $baseLink }} {{ $isActive('admin.planets.*') }}"
               @if(request()->routeIs('admin.planets.*')) aria-current="page" @endif>
              Planètes
            </a>
          @endcan

          @can('crew.manage')
            <a href="{{ route('admin.crew.index') }}"
               class="{{ $baseLink }} {{ $isActive('admin.crew.*') }}"
               @if(request()->routeIs('admin.crew.*')) aria-current="page" @endif>
              Équipage
            </a>
          @endcan

          <span class="text-white/40 select-none">|</span>
          <a class="{{ $baseLink }}" href="{{ route('lang.switch','fr') }}">FR</a>
          <span class="text-white/40 select-none">/</span>
          <a class="{{ $baseLink }}" href="{{ route('lang.switch','en') }}">EN</a>

          @auth
            <!-- Logout en POST (évite l'erreur 405) -->
            <form method="POST" action="{{ route('logout') }}" class="inline">
              @csrf
              <button type="submit" class="ml-2 hover:text-[#D0D6F9]">Déconnexion</button>
            </form>
          @endauth
        </nav>
      </div>

      <!-- Nav mobile (fermée par défaut : PAS de 'flex' au départ) -->
      <nav id="admin-menu"
           class="hidden md:hidden mt-3 flex-col gap-3 border-t border-white/10 pt-3 text-sm">
        @role('Administrateur')
          <a href="{{ route('admin.users.index') }}"
             class="{{ $baseLink }} {{ $isActive('admin.users.*') }}"
             @if(request()->routeIs('admin.users.*')) aria-current="page" @endif>
            Utilisateurs
          </a>
        @endrole

        @can('technologies.manage')
          <a href="{{ route('admin.technologies.index') }}"
             class="{{ $baseLink }} {{ $isActive('admin.technologies.*') }}"
             @if(request()->routeIs('admin.technologies.*')) aria-current="page" @endif>
            Technologies
          </a>
        @endcan

        @can('planets.manage')
          <a href="{{ route('admin.planets.index') }}"
             class="{{ $baseLink }} {{ $isActive('admin.planets.*') }}"
             @if(request()->routeIs('admin.planets.*')) aria-current="page" @endif>
            Planètes
          </a>
        @endcan

        @can('crew.manage')
          <a href="{{ route('admin.crew.index') }}"
             class="{{ $baseLink }} {{ $isActive('admin.crew.*') }}"
             @if(request()->routeIs('admin.crew.*')) aria-current="page" @endif>
            Équipage
          </a>
        @endcan

        <div class="items-center gap-2">
          <a class="{{ $baseLink }}" href="{{ route('lang.switch','fr') }}">FR</a>
          <span class="text-white/40 select-none">/</span>
          <a class="{{ $baseLink }}" href="{{ route('lang.switch','en') }}">EN</a>
        </div>

        @auth
          <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button type="submit" class="hover:text-[#D0D6F9]">Déconnexion</button>
          </form>
        @endauth
      </nav>
    </div>

    <script>
      // Toggle accessible du menu mobile : on bascule 'hidden' et 'flex'
      (function () {
        const btn  = document.getElementById('admin-menu-btn');
        const menu = document.getElementById('admin-menu');
        if (!btn || !menu) return;

        // État initial: fermé
        menu.classList.add('hidden');
        menu.classList.remove('flex');

        btn.addEventListener('click', () => {
          const isHidden = menu.classList.contains('hidden'); // fermé ?
          menu.classList.toggle('hidden', !isHidden); // ouvrir => enlever hidden
          menu.classList.toggle('flex',    isHidden); // ouvrir => ajouter flex
          btn.setAttribute('aria-expanded', String(isHidden));
        });
      })();
    </script>
  </header>

  <main id="admin-main" class="flex-1">
    <div class="max-w-7xl mx-auto w-full px-6 md:px-10 py-6">
      @if (session('success'))
        <div class="mb-4 rounded-lg bg-green-600/15 border border-green-600/30 text-green-200 px-4 py-3">
          {{ session('success') }}
        </div>
      @endif
      @if (session('error'))
        <div class="mb-4 rounded-lg bg-red-600/15 border border-red-600/30 text-red-200 px-4 py-3">
          {{ session('error') }}
        </div>
      @endif
      @if ($errors->any())
        <div class="mb-4 rounded-lg bg-yellow-600/15 border border-yellow-600/30 text-yellow-100 px-4 py-3">
          <p class="font-medium mb-2">Erreurs de validation :</p>
          <ul class="list-disc list-inside space-y-1">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      @yield('content')
      {{ $slot ?? '' }}
    </div>
  </main>

  <footer class="bg-gray-900 text-gray-400 text-center py-6 text-sm">
    © {{ date('Y') }} {{ config('app.name','Space Tourism') }} — Back-office
  </footer>
</div>

<script>
  // Ferme un éventuel menu mobile global d'un autre layout
  (function(){
    const overlay = document.getElementById('mobile-overlay');
    const menu = document.getElementById('mobile-menu');
    overlay && overlay.classList.add('hidden');
    menu && menu.classList.add('translate-x-full');
  })();
</script>
</body>
</html>
