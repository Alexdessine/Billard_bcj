<x-layout>
    {{-- Calque blanc transparent --}}
    <div class="overlay"></div>
    <section class="body-content">
       <x-sous-menu discipline="americain"></x-sous-menu>
    </section>
    {{-- Pour les tournois internationaux (ex: THD) --}}
    @if($americain_calendrier->isNotEmpty())
            <section>
        <x-title>
            Calendriers PDF
        </x-title>
        <x-cadre>
            <x-calendrier-pdf discipline="americain"/>
        </x-cadre>
    </section>
    @endif
    @if($americain_international->isNotEmpty())
        <section>
        <x-title>Calendrier compétition Internationale</x-title>
        <div class="accordion">
            <x-cadre>
                <div class="accordion" id="accordionInternational">
                    {!!  App\Helpers\CalendrierHelper::afficher($americain_international, 'International') !!}
                </div>
            </x-cadre>
        </div>
    </section>
    @endif
    @if($americain_national->isNotEmpty())
    <section>
        <x-title>Calendrier compétition Nationale</x-title>
        <div class="accordion">
            <x-cadre>
                <div class="accordion" id="accordionNational">
                    {!!  App\Helpers\CalendrierHelper::afficher($americain_national, 'National') !!}
                </div>
            </x-cadre>
        </div>
    </section>
    @endif
    @if($americain_regional->isNotEmpty())
    <section>
        <x-title>Calendrier compétition Regionale</x-title>
        <div class="accordion">
            <x-cadre>
                <div class="accordion" id="accordionRegional">
                    {!!  App\Helpers\CalendrierHelper::afficher($americain_regional, 'Regional') !!}
                </div>
            </x-cadre>
        </div>
    </section>
    @endif
    @if($americain_departemental->isNotEmpty())
    <section>
        <x-title>Calendrier compétition Départementale</x-title>
        <div class="accordion">
            <x-cadre>
                <div class="accordion" id="accordionDepartemental">
                    {!!  App\Helpers\CalendrierHelper::afficher($americain_departemental, 'Departemental') !!}
                </div>
            </x-cadre>
        </div>
    </section>
    @endif
</x-layout>

