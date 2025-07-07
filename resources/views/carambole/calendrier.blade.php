{{-- <x-layout> --}}
    {{-- Calque blanc transparent --}}
    {{-- <div class="overlay"></div> --}}
    {{-- <section class="body-content"> --}}
        {{-- <x-sous-menu discipline="carambole"></x-sous-menu> --}}
    {{-- </section> --}}
    {{-- <section> --}}
        {{-- <x-title> --}}
            {{-- Calendriers officiels --}}
        {{-- </x-title> --}}
        {{-- <x-cadre> --}}
            {{-- <x-carambole_calendrier discipline="2"/> --}}
        {{-- </x-cadre> --}}
    {{-- </section> --}}
{{-- </x-layout> --}}
<x-layout>
    {{-- Calque blanc transparent --}}
    <div class="overlay"></div>
    <section class="body-content">
       <x-sous-menu discipline="blackball"></x-sous-menu>
    </section>
    {{-- Pour les tournois internationaux (ex: THD) --}}
    @if($carambole_calendrier->isNotEmpty())
            <section>
        <x-title>
            Calendriers officiels
        </x-title>
        <x-cadre>
            <x-carambole_calendrier discipline="2"/>
        </x-cadre>
    </section>
    @endif
    @if($carambole_international->isNotEmpty())
        <section>
        <x-title>Calendrier compétition Internationale</x-title>
        <div class="accordion">
            <x-cadre>
                <div class="accordion" id="accordionInternational">
                    {!!  App\Helpers\CalendrierHelper::afficher($carambole_international, 'International') !!}
                </div>
            </x-cadre>
        </div>
    </section>
    @endif
    @if($carambole_national->isNotEmpty())
    <section>
        <x-title>Calendrier compétition Nationale</x-title>
        <div class="accordion">
            <x-cadre>
                <div class="accordion" id="accordionNational">
                    {!!  App\Helpers\CalendrierHelper::afficher($carambole_national, 'National') !!}
                </div>
            </x-cadre>
        </div>
    </section>
    @endif
    @if($carambole_regional->isNotEmpty())
    <section>
        <x-title>Calendrier compétition Regionale</x-title>
        <div class="accordion">
            <x-cadre>
                <div class="accordion" id="accordionRegional">
                    {!!  App\Helpers\CalendrierHelper::afficher($carambole_regional, 'Regional') !!}
                </div>
            </x-cadre>
        </div>
    </section>
    @endif
    @if($carambole_departemental->isNotEmpty())
    <section>
        <x-title>Calendrier compétition Départementale</x-title>
        <div class="accordion">
            <x-cadre>
                <div class="accordion" id="accordionDepartemental">
                    {!!  App\Helpers\CalendrierHelper::afficher($carambole_departemental, 'Departemental') !!}
                </div>
            </x-cadre>
        </div>
    </section>
    @endif
</x-layout>

