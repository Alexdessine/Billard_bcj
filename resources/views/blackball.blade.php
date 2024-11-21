<x-layout></x-layout>
<section class="blackball_section">
    <div class="classement_section">
        <div class="classement_titre">
            <h5>National {{ $startYear }}/{{ $endYear }}</h5>
        </div>
        <div class="classement_content">
            @foreach($nationalClassements as $type => $classement)
                @if($classement->isNotEmpty())
                    <div class="classement_table">
                        <div class="classement_titre_table">
                            <h6>Classement {{ ucfirst($type) }}</h6>
                        </div>
                        <div class="classement_table_tableau">
                            <table class="table-format">
                                {!! App\Helpers\ClassementHelper::afficher($classement) !!}
                            </table>
                        </div>
                    </div>
                @endif
            @endforeach
            <div class="text-xs w-100">
                <p class="text-xs text-right pr-2 w-100" style="text-align:right;">Données sources : CueScore</p>
            </div>
        </div>
    </div>
    
    <div class="classement_section">
        <div class="classement_titre">
            <h5>Régional {{ $startYear }}/{{ $endYear }}</h5>
        </div>
        <div class="classement_content">
            @foreach($regionalClassements as $type => $classement)
                @if($classement->isNotEmpty())
                    <div class="classement_table">
                        <div class="classement_titre_table">
                            <h6>Classement {{ ucfirst($type) }}</h6>
                        </div>
                        <div class="classement_table_tableau">
                            <table class="table-format">
                                {!! App\Helpers\ClassementHelper::afficher($classement) !!}
                            </table>
                        </div>
                    </div>
                @endif
            @endforeach
            <div class="text-xs w-100">
                <p class="text-xs text-right pr-2 w-100" style="text-align:right;">Données sources : CueScore</p>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="calendrier_national_section">
        <div class="calendrier_national_titre">
            <h5>Calendrier compétition nationale</h5>
        </div>
        <div class="calendrier_national_content">
            <table class="table-format">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Compétition</th>
                        <th>Lieu</th>
                        <th>Club organisateur</th>
                        <th>Détail</th>
                    </tr>
                </thead>
                {!! App\Helpers\CalendrierHelper::afficher($calendrier_national) !!}
            </table>
        </div>
    </div>

    <div class="calendrier_national_section">
        <div class="calendrier_national_titre">
            <h5>Calendrier compétition régionale</h5>
        </div>
        <div class="calendrier_national_content">
            <table class="table-format">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Compétition</th>
                        <th>Lieu</th>
                        <th>Club organisateur</th>
                        <th>Détail</th>
                    </tr>
                </thead>
                {!! App\Helpers\CalendrierHelper::afficher($calendrier_regional) !!}
            </table>
        </div>
    </div>
</section>

<x-footer></x-footer>
</html>
