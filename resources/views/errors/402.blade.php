{{-- resources/views/errors/402.blade.php --}}
<x-layout>
    <div class="overlay"></div>

    <section>
        <x-title>Paiement requis</x-title>

        <x-cadre>
            <div class="text-center py-12 space-y-6 error">
                <i class="fa-solid fa-credit-card text-6xl text-blue-600" aria-hidden="true"></i>

                <p class="text-gray-600">
                    Cette fonctionnalité nécessite un abonnement actif.
                </p>

                <div class="flex items-center justify-center gap-3">
                    <a href="{{ url('/') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded bg-blue-600 hover:bg-blue-700 transition">
                        <i class="fa-solid fa-house" aria-hidden="true"></i>
                        Retour à l’accueil
                    </a>
                    <a href="{{ url('/contact') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded bg-gray-200 hover:bg-gray-300 transition">
                        <i class="fa-solid fa-circle-info" aria-hidden="true"></i>
                        Contactez-nous
                    </a>
                </div>
            </div>
        </x-cadre>
    </section>
</x-layout>

<style>
    .error{ margin:auto; }
    i.fa-credit-card{ display:inline-block; font-size:30px; color:rgb(37,99,235); margin:20px 0; }
</style>
