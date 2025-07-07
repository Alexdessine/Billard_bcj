<x-layout>
    {{-- Calque blanc transparent --}}
    <div class="overlay"></div>
    <section class="body-content">
       <x-sous-menu discipline="blackball"></x-sous-menu>
    </section>
    {{-- Pour les tournois internationaux (ex: THD) --}}
        <section>
        <x-title>Calendrier compétition Internationale</x-title>
        <div class="accordion">
            <x-cadre>
                <div class="accordion" id="accordionInternational">
                    {!!  App\Helpers\CalendrierHelper::afficher($calendrier_international, 'International') !!}
                </div>
            </x-cadre>
        </div>
    </section>
    <section>
        <x-title>Calendrier compétition Nationale</x-title>
        <div class="accordion">
            <x-cadre>
                <div class="accordion" id="accordionNational">
                    {!!  App\Helpers\CalendrierHelper::afficher($calendrier_national, 'National') !!}
                </div>
            </x-cadre>
        </div>
    </section>
    <section>
        <x-title>Calendrier compétition Regionale</x-title>
        <div class="accordion">
            <x-cadre>
                <div class="accordion" id="accordionRegional">
                    {!!  App\Helpers\CalendrierHelper::afficher($calendrier_regional, 'Regional') !!}
                </div>
            </x-cadre>
        </div>
    </section>
    <section>
        <x-title>Calendrier compétition Départementale</x-title>
        <div class="accordion">
            <x-cadre>
                <div class="accordion" id="accordionDepartemental">
                    {!!  App\Helpers\CalendrierHelper::afficher($calendrier_departemental, 'Departemental') !!}
                </div>
            </x-cadre>
        </div>
    </section>
</x-layout>

