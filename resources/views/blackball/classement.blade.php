<x-layout>
    {{-- Calque blanc transparent --}}
    <div class="overlay"></div>
    <section class="body-content">
        <x-sous-menu discipline="blackball"></x-sous-menu>
    </section>
    <section>
        <x-title>Classement national {{ $startYear }} / {{ $endYear }}</x-title>
        <div class="classement">
            <x-cadre>
        @foreach ($nationalData as $categorie => $participants)
            @if(!empty($participants))
                <div class="classement_table">
                    <div class="classement_titre_table">
                        <h6>Classement {{ $labelNational[$categorie] ?? ucfirst($categorie) }}</h6>
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
                    <a class="btn btn-success" href="https://cuescore.com/ffb/rankings" target="_blank">Voir les classements complets</a>
                </div>
                <p class="donnees-source">Données sources : CueScore</p>
            </x-cadre>
        </div>
    </section>
    <section>
        <x-title>Classement régional {{ $startYear }} / {{ $endYear }}</x-title>
        <x-cadre>
            @php 
                $ignoredKeys = ['top_ligue', 'handi_fauteuil', 'handi_debout', 'benjamin_u15', 'espoirs_u23'];
            @endphp
        @foreach ($regionalData as $categorie => $participants)
            @continue(in_array($categorie, $ignoredKeys, true))
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
                <a class="btn btn-success"href="https://cuescore.com/centre-valdeloire/rankings" target="_blank">Voir les classements complets</a>
            </div>
            <p class="donnees-source text-slate-500 ">Données sources : CueScore</p>
        </x-cadre>
    </section>
    <section>
    <x-title>Classement équipe nationale {{ $startYear }} / {{ $endYear }}</x-title>

    {{-- Cadre pour DN1 et DN2 --}}
    <x-cadre>
        @foreach ($classement as $division => $infos)
            @if(in_array($division, ['DN1', 'DN2']))
                <div class="classement_table">
                    <div class="classement_titre_table">
                        <h6>Classement {{ $division }}</h6>
                    </div>
                    <div class="classement_table_tableau">
                        <table class="table-format">
                            @foreach ($infos['equipes'] as $equipe)
                                <tr>
                                    <td class="text-sm md:text-lg">{{ $equipe['classement'] ?? ''}}{{ ($equipe['classement'] ?? '') == 1 ? 'er' : 'ème' }}</td>
                                    <td class="text-sm md:text-lg">{{ $equipe['nom'] ?? ''}}</td>
                                    <td class="text-sm md:text-lg" style="text-align:right;">{{ $equipe['points'] ?? '0'}} pts</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                @if (!empty($infos['url']))
                    <div class="classement-complet mt-2 mb-4">
                        <a class="btn btn-success" href="{{ $infos['url'] }}" target="_blank">
                            Voir les classements complets
                        </a>
                    </div>
                @endif
            @endif
        @endforeach
        <p class="donnees-source text-slate-500 mt-4">Données sources : CueScore</p>
    </x-cadre>

    {{-- Cadre pour DR1 à DR4 --}}
    <x-title>Classement équipe régionale {{ $startYear }} / {{ $endYear }}</x-title>
    <x-cadre>
        @foreach ($classement as $division => $equipes)
            @if(Str::startsWith($division, 'DR'))
                <div class="classement_table">
                    <div class="classement_titre_table">
                        <h6>Classement {{ $division }}</h6>
                    </div>
                    <div class="classement_table_tableau">
                        <table class="table-format">
                            @foreach ($equipes['equipes'] as $equipe)
                                <tr>
                                    <td class="text-sm md:text-lg">{{ $equipe['classement'] }}{{ $equipe['classement'] == 1 ? 'er' : 'ème' }}</td>
                                    <td class="text-sm md:text-lg">{{ $equipe['nom'] }}</td>
                                    <td class="text-sm md:text-lg" style="text-align:right;">{{ $equipe['points'] }} pts</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                @if (!empty($equipes['url']))
                    <div class="classement-complet mt-2 mb-4">
                        <a class="btn btn-success" href="{{ $equipes['url'] }}" target="_blank">
                            Voir les classements complets
                        </a>
                    </div>
                @endif
            @endif
        @endforeach
        <p class="donnees-source text-slate-500 mt-4">Données sources : CueScore</p>
    </x-cadre>
</section>

</x-layout>