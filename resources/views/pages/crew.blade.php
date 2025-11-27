{{-- =============================================================
Page Équipage — Partie 05
- Affiche les membres (BDD si dispo, sinon fallback i18n)
- A11y : aria-labels, focus sur le nom après changement
- Animations légères
=============================================================== --}}
@extends('layouts.app')

@section('title', $pageTitle ?? __('crew.title'))

@section('content')
  @php
      // On sécurise le tableau PHP pour le HTML et le JS
      $membersArray = is_iterable($members ?? null)
          ? array_values($members)
          : [];
  @endphp

  <section class="relative min-h-screen overflow-hidden text-white">
    <img
      src="{{ asset('images/background-crew.jpg') }}"
      alt=""
      class="absolute inset-0 w-full h-full object-cover -z-10"
    >
    <div class="absolute inset-0 bg-black/60 -z-10"></div>

    <div class="relative z-10 max-w-6xl mx-auto px-6 py-16 md:py-24">
      <h1 class="text-3xl md:text-5xl font-semibold tracking-wide mb-10">
        <span class="sr-only">ÉQUIPAGE</span>
        {{ $heading ?? __('crew.heading') }}
      </h1>

      @if(!count($membersArray))
        <p class="text-[#D0D6F9]">
          {{ __('Aucun membre d’équipage disponible pour le moment.') }}
        </p>
      @else
        @php
            $first = $membersArray[0];
        @endphp

        <div class="grid md:grid-cols-2 gap-10 items-center">
          {{-- COLONNE TEXTE --}}
          <div>
            <h2 id="role"
                class="text-xl md:text-2xl uppercase text-gray-300 tracking-[0.2em] mb-2 transition-all duration-300">
              {{ $first['role'] ?? '' }}
            </h2>

            <h3 id="name"
                class="text-3xl md:text-5xl font-serif mb-6 transition-all duration-300">
              {{ $first['name'] ?? '' }}
            </h3>

            <p id="bio"
               class="text-base md:text-lg text-gray-200 leading-relaxed max-w-prose transition-all duration-300">
              {{ $first['bio'] ?? '' }}
            </p>

            {{-- PETITS POINTS / BULLETS --}}
            <div class="mt-8 flex items-center gap-3"
                 role="tablist"
                 aria-label="{{ __('crew.goto_member') }}">
              @foreach($membersArray as $i => $m)
                <button
                  type="button"
                  class="h-3 w-3 rounded-full bg-white/40 hover:bg-white/70
                         focus:outline-none focus:ring-2 focus:ring-white transition"
                  data-index="{{ $i }}"
                  aria-label="{{ __('crew.goto_member') }} : {{ $m['name'] ?? '' }}"
                  aria-selected="{{ $i === 0 ? 'true' : 'false' }}"
                  role="tab">
                </button>
              @endforeach
            </div>
          </div>

          {{-- COLONNE IMAGE --}}
          <div class="flex justify-center">
            <img
              id="photo"
              src="{{ $first['image'] ?? '' }}"
              alt="{{ $first['alt'] ?? ($first['name'] ?? '') }}"
              class="max-h-[420px] object-contain transition-all duration-300"
            />
          </div>
        </div>
      @endif
    </div>
  </section>

  @if(count($membersArray))
    <script>
      document.addEventListener('DOMContentLoaded', () => {
        const members = @json($membersArray);

        if (!Array.isArray(members) || members.length === 0) {
          return;
        }

        const roleEl = document.getElementById('role');
        const nameEl = document.getElementById('name');
        const bioEl  = document.getElementById('bio');
        const imgEl  = document.getElementById('photo');
        const dots   = Array.from(document.querySelectorAll('[role="tab"]'));

        function animateSwap(update) {
          roleEl.classList.add('opacity-0', '-translate-y-1');
          nameEl.classList.add('opacity-0', '-translate-y-1');
          bioEl.classList.add('opacity-0', '-translate-y-1');
          imgEl.classList.add('opacity-0', 'translate-x-2');

          setTimeout(() => {
            update();

            roleEl.classList.remove('opacity-0', '-translate-y-1');
            nameEl.classList.remove('opacity-0', '-translate-y-1');
            bioEl.classList.remove('opacity-0', '-translate-y-1');
            imgEl.classList.remove('opacity-0', 'translate-x-2');

            nameEl.setAttribute('tabindex', '-1');
            nameEl.focus({ preventScroll: true });
            setTimeout(() => nameEl.removeAttribute('tabindex'), 0);
          }, 200);
        }

        function select(index) {
          const m = members[index];
          if (!m) return;

          dots.forEach((dot, i) => {
            dot.setAttribute('aria-selected', i === index ? 'true' : 'false');
          });

          animateSwap(() => {
            roleEl.textContent = m.role || '';
            nameEl.textContent = m.name || '';
            bioEl.textContent  = m.bio  || '';

            if (m.image) {
              imgEl.src = m.image;
            } else {
              imgEl.removeAttribute('src');
            }

            imgEl.alt = m.alt || m.name || '';
          });
        }

        dots.forEach((dot) => {
          dot.addEventListener('click', () => {
            const index = parseInt(dot.dataset.index, 10);
            select(index);
          });

          dot.addEventListener('keydown', (event) => {
            if (event.key === 'Enter' || event.key === ' ') {
              event.preventDefault();
              dot.click();
            }
          });
        });
      });
    </script>
  @endif
@endsection
