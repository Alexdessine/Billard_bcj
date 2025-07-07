<x-layout>
    {{-- Calque blanc transparent --}}
    <div class="overlay"></div>
    <section class="body-content">
        <x-sous-menu discipline="snooker"></x-sous-menu>
    </section>
    <section>
        <x-title>Calendrier compétition</x-title>
        <div class="accordion">
            <x-cadre>
                <div class="accordion" id="accordionSnooker">
                    {!!  App\Helpers\CalendrierHelper::afficher($calendrier_snooker, 'Calendrier_snooker') !!}
                </div>
            </x-cadre>
        </div>
    </section>
</x-layout>