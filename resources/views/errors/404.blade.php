{{-- resources/views/errors/404.blade.php --}}
<x-layout>
    {{-- Calque blanc transparent --}}
    <div class="overlay"></div>

    <section>
        <x-title>Oups… page introuvable</x-title>

        <x-cadre>
            <div class="text-center py-12 space-y-6 error">
                {{-- Icône Font Awesome (assure-toi que FA est chargé dans ton layout) --}}
                {{-- <i class="fas-solid fas-compass text-6xl text-blue-600" aria-hidden="true"></i> --}}
                <i class="fa-solid fa-compass text-6xl text-blue-600" aria-hidden="true"></i>

                <p class="text-gray-600">
                    La page que vous cherchez n’existe pas ou a été déplacée.
                </p>

                <div class="flex items-center justify-center gap-3">
                    <a href="{{ url()->previous() }}"
                       class="inline-flex items-center gap-2 px-4 py-2 rounded bg-gray-200 hover:bg-gray-300 transition">
                        <i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
                        Revenir en arrière
                    </a>

                    <a href="{{ url('/') }}"
                       class="inline-flex items-center gap-2 px-4 py-2 rounded bg-blue-600 hover:bg-blue-700 transition">
                        <i class="fa-solid fa-house" aria-hidden="true"></i>
                        Retour à l’accueil
                    </a>
                </div>
            </div>
        </x-cadre>
    </section>
</x-layout>


<style>

    .error{
        margin: auto;
    }
    i.fa-compass {
        display: inline-block;
        font-size: 30px;
        color: rgb(37,99,235);
        margin: 20px 0;
    }
</style>