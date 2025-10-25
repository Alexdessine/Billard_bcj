{{-- resources/views/errors/419.blade.php --}}
<x-layout>
    <div class="overlay"></div>

    <section>
        <x-title>Session expirée</x-title>

        <x-cadre>
            <div class="text-center py-12 space-y-6 error">
                <i class="fa-solid fa-hourglass-end text-6xl text-blue-600" aria-hidden="true"></i>

                <p class="text-gray-600">
                    Votre session a expiré. Rafraîchissez la page ou reconnectez-vous.
                </p>

                <div class="flex items-center justify-center gap-3">
                    <a href="javascript:location.reload()" class="inline-flex items-center gap-2 px-4 py-2 rounded bg-blue-600 hover:bg-blue-700 transition">
                        <i class="fa-solid fa-rotate-right" aria-hidden="true"></i>
                        Recharger la page
                    </a>
                    <a href="/admin/auth/login" class="inline-flex items-center gap-2 px-4 py-2 rounded bg-gray-200 hover:bg-gray-300 transition">
                        <i class="fa-solid fa-right-to-bracket" aria-hidden="true"></i>
                        Se connecter
                    </a>
                </div>
            </div>
        </x-cadre>
    </section>
</x-layout>

<style>
    .error{ margin:auto; }
    i.fa-hourglass-end{ display:inline-block; font-size:30px; color:rgb(37,99,235); margin:20px 0; }
</style>
