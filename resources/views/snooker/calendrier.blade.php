<x-layout>
    {{-- Calque blanc transparent --}}
    <div class="overlay"></div>
    <section class="body-content">
       <x-sous-menu discipline="snooker"></x-sous-menu>
    </section>
    {{-- Pour les tournois internationaux (ex: THD) --}}
    @if($snooker_calendrier->isNotEmpty())
            <section>
        <x-title>
            Calendriers PDF
        </x-title>
        <x-cadre>
            <x-calendrier-pdf discipline="snooker"/>
        </x-cadre>
    </section>
    @endif
    @if($snooker_international->isNotEmpty())
        <section>
        <x-title>Calendrier compétition Internationale</x-title>
        <div class="accordion">
            <x-cadre>
                <div class="accordion" id="accordionInternational">
                    {!!  App\Helpers\CalendrierHelper::afficher($snooker_international, 'International') !!}
                </div>
            </x-cadre>
        </div>
    </section>
    @endif
    @if($snooker_national->isNotEmpty())
    <section>
        <x-title>Calendrier compétition Nationale</x-title>
        <div class="accordion">
            <x-cadre>
                <div class="accordion" id="accordionNational">
                    {!!  App\Helpers\CalendrierHelper::afficher($snooker_national, 'National') !!}
                </div>
            </x-cadre>
        </div>
    </section>
    @endif
    @if($snooker_regional->isNotEmpty())
    <section>
        <x-title>Calendrier compétition Regionale</x-title>
        <div class="accordion">
            <x-cadre>
                <div class="accordion" id="accordionRegional">
                    {!!  App\Helpers\CalendrierHelper::afficher($snooker_regional, 'Regional') !!}
                </div>
            </x-cadre>
        </div>
    </section>
    @endif
    @if($snooker_departemental->isNotEmpty())
    <section>
        <x-title>Calendrier compétition Départementale</x-title>
        <div class="accordion">
            <x-cadre>
                <div class="accordion" id="accordionDepartemental">
                    {!!  App\Helpers\CalendrierHelper::afficher($snooker_departemental, 'Departemental') !!}
                </div>
            </x-cadre>
        </div>
    </section>
    @endif
</x-layout>

