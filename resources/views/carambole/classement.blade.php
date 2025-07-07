<x-layout>
    {{-- Calque blanc transparent --}}
    <div class="overlay"></div>
    <section class="body-content">
        <x-sous-menu discipline="carambole"></x-sous-menu>
    </section>
    <section>
        <x-title>
            Classement
        </x-title>
        <x-cadre>
            <iframe src="{{ asset('storage/pdf/carambole/excel/Une bande 23 joueurs.pdf') }}" width="100%" height="800px" style="border: none;"></iframe>
        </x-cadre>
    </section>
</x-layout>