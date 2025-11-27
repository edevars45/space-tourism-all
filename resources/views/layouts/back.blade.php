<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Back-office')</title>

    {{-- CSS / JS de ton projet (Vite) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-black text-white min-h-screen">

    {{-- BARRE DU BACK-OFFICE --}}
    <header class="border-b border-white/10 bg-black/90">
        <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">

            <div class="flex items-center gap-4">
                <a href="{{ url('/') }}" class="font-semibold tracking-wide">
                    🌌 Space Tourism
                </a>
                <span class="text-xs uppercase text-white/60">
                    Back-office
                </span>
            </div>

            <nav class="flex items-center gap-4 text-sm">
                <a href="{{ route('admin.crew_members.index') }}"
                   class="hover:text-[#D0D6F9]">
                    Équipage
                </a>
                <a href="{{ route('admin.planets.index') }}"
                   class="hover:text-[#D0D6F9]">
                    Planètes
                </a>
                <a href="{{ route('admin.technologies.index') }}"
                   class="hover:text-[#D0D6F9]">
                    Technologies
                </a>

                {{-- Déconnexion si l’utilisateur est connecté --}}
                @auth
                    <form action="{{ route('logout') }}"
                          method="POST"
                          class="inline">
                        @csrf
                        <button class="ml-4 text-xs px-3 py-1 rounded border border-white/30 hover:bg-white/10">
                            Déconnexion
                        </button>
                    </form>
                @endauth
            </nav>
        </div>
    </header>

    {{-- CONTENU DES PAGES BACK-OFFICE --}}
    <main class="max-w-6xl mx-auto px-6 py-8">
        @yield('content')
    </main>

</body>
</html>
