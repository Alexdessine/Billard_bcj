<x-layout>
    {{-- Calque blanc transparent --}}
    <div class="overlay"></div>
    <section class="body-content">
        <x-sous-menu discipline="americain"></x-sous-menu>
    </section>
    <section>
        <x-title>Classement national {{ $startYear }} / {{ $endYear }}</x-title>
        <div class="classement">
            <x-cadre>
                @if(!empty($americainClassement->url))
                @foreach ($americainData as $categorie => $participants)
                    @if(!empty($participants))
                        <div class="classement_table">
                            <div class="classement_titre_table">
                                <h6>Classement {{ ucfirst($categorie) }}</h6>
                            </div>
                            <div class="classement_table_tableau">
                                <table class="table-format">
                                    @foreach ($participants as $player)
                                        <tr>
                                            <td class="text-sm md:text-lg">{{ $player['rank'] }}{{ $player['rank'] == 1 ? 'er' : 'ème' }}</td>
                                            <td class="text-sm md:text-lg">{{ $player['name'] }}</td>
                                            <td class="text-sm md:text-lg" style="text-align:right;">{{ intval($player['points']) }} points</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    @endif
                @endforeach
                <div class="classement-complet">
                        <a class="btn btn-success" href="{{ $americainClassement->url }}{{ $americainClassement->mixte }}" target="_blank">Voir les classements complets</a>
                    </div>
                    <p class="donnees-source">Données sources : CueScore</p>
                @else
                <p>Il n'y a pas de classement pour cette année.</p>
                @endif
            </x-cadre>
        </div>
    </section>
</x-layout>