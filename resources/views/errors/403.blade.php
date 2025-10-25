{{-- resources/views/errors/403.blade.php --}}
<x-layout>
    <div class="overlay"></div>

    <section>
        <x-title>Accès interdit</x-title>

        <x-cadre>
            <div class="text-center py-12 space-y-6 error">
                <i class="fa-solid fa-ban text-6xl text-blue-600" aria-hidden="true"></i>

                <p class="text-gray-600">
                    Vous n’avez pas l’autorisation d’accéder à cette page.
                </p>

                <div class="flex items-center justify-center gap-3">
                    <a href="{{ url()->previous() }}" class="inline-flex items-center gap-2 px-4 py-2 rounded bg-gray-200 hover:bg-gray-300 transition">
                        <i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
                        Revenir en arrière
                    </a>
                    <a href="{{ url('/') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded bg-blue-600 hover:bg-blue-700 transition">
                        <i class="fa-solid fa-house" aria-hidden="true"></i>
                        Retour à l’accueil
                    </a>
                </div>
            </div>
        </x-cadre>
    </section>
</x-layout>

<style>
    .error{ margin:auto; }
    i.fa-ban{ display:inline-block; font-size:30px; color:rgb(37,99,235); margin:20px 0; }
</style>
