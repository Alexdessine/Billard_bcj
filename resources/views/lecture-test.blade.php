<x-layout>
  <div class="overlay"></div>

  <section>
    <x-title>Lecture test</x-title>
    <x-cadre>
      <h2 class="text-xl font-semibold mb-4">{{ $test->title ?? 'Sans titre' }}</h2>
      <div class="prose max-w-none ck-content">
        {!! $test->content !!} {{-- on affiche le HTML sauvegardé --}}
      </div>

      <div class="mt-6">
        <a class="px-4 py-2 bg-gray-200 rounded" href="{{ route('test.create') }}">Retour à l’éditeur</a>
      </div>
    </x-cadre>
  </section>
</x-layout>
