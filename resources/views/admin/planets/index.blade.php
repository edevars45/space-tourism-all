@extends('layouts.admin')
@section('title', 'Planètes')

@section('content')
  <div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-semibold">Planètes</h1>
    <a href="{{ route('admin.planets.create') }}" class="bg-[#D0D6F9] text-black px-4 py-2 rounded">
      Nouvelle planète
    </a>
  </div>

  @if(session('success'))
      <div class="mb-4 rounded border border-green-500/40 bg-green-500/10 px-4 py-2 text-sm text-green-200">
          {{ session('success') }}
      </div>
  @endif

  @php
      $isEmpty =
          ($planets instanceof \Illuminate\Support\Collection && $planets->isEmpty())
          || (is_array($planets) && count($planets) === 0)
          || ($planets instanceof \Illuminate\Contracts\Pagination\Paginator && $planets->count() === 0);
  @endphp

  @if($isEmpty)
    <div class="border border-white/10 rounded p-6 text-white/70">
      Aucune planète pour le moment.
    </div>
  @else
    <div class="overflow-x-auto border border-white/10 rounded">
      <table class="min-w-full text-sm">
        <thead class="bg-white/5">
          <tr class="text-left">
            <th class="px-4 py-3">#</th>
            <th class="px-4 py-3">Nom</th>
            <th class="px-4 py-3">Slug</th>
            <th class="px-4 py-3">Ordre</th>
            <th class="px-4 py-3">Publié</th>
            <th class="px-4 py-3 text-right">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($planets as $p)
            @php
              $published = (bool)($p->is_published ?? $p->published ?? false);
            @endphp
            <tr class="border-t border-white/10">
              <td class="px-4 py-3">{{ $p->id }}</td>
              <td class="px-4 py-3">{{ $p->name }}</td>
              <td class="px-4 py-3">{{ $p->slug }}</td>
              <td class="px-4 py-3">{{ $p->order ?? '-' }}</td>
              <td class="px-4 py-3">
                @if($published)
                  <span class="px-2 py-1 text-xs rounded bg-green-500/20 text-green-300">Oui</span>
                @else
                  <span class="px-2 py-1 text-xs rounded bg-red-500/20 text-red-300">Non</span>
                @endif
              </td>
              <td class="px-4 py-3 text-right">
                <a href="{{ route('admin.planets.edit', $p) }}"
                   class="px-3 py-1 rounded border border-white/20 mr-2">
                  Éditer
                </a>

                <form action="{{ route('admin.planets.destroy', $p) }}"
                      method="POST"
                      class="inline"
                      onsubmit="return confirm('Supprimer cette planète ?')">
                  @csrf
                  @method('DELETE')
                  <button class="px-3 py-1 rounded bg-red-600/80 hover:bg-red-600">
                    Suppr.
                  </button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    @if($planets instanceof \Illuminate\Contracts\Pagination\Paginator)
      <div class="mt-4">
        {{ $planets->links() }}
      </div>
    @endif
  @endif
@endsection
