<x-layout>
    {{-- Calque blanc transparent --}}
    <div class="overlay"></div>
    <section class="body-content">
        <x-sous-menu discipline="americain"></x-sous-menu>
    </section>
    <section>
            @if($americain_international->isNotEmpty() && $americain_national->isNotEmpty() && $americain_regional->isNotEmpty() && $americain_departemental->isNotEmpty())
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
            @else
            <section>
                <x-title>
                    Calendriers officiels
                </x-title>
                <x-cadre>
                    <p>Aucun calendrier disponible.</p>
                </x-cadre>
            </section>
            @endif
    </section>
</x-layout>