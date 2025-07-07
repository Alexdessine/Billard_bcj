<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\CuescoreNational;
use App\Models\CuescoreRegional;
use Illuminate\Support\Facades\DB;
use App\Models\Calendrier_national;
use App\Models\Calendrier_regional;
use App\View\Components\Calendrier;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\Calendrier_international;
use App\Models\Calendrier_departemental;
use App\Models\CuescoreEquipesNationale;
use App\Models\CuescoreEquipesRegionale;

class BlackballController extends Controller
{
    //

    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(8);
        return view('blackball.index', [
            'posts' => $posts,
        ]);
    }

    public function show(Post $post): View
    {
        return view('blackball.show', [
            'post' => $post, 
        ]);
    }

    public function calendrier()
    {
        // Récupérer le calendrier national et regional
        $calendrier_national = Calendrier_national::orderBy('id', 'desc')->take(9)->get()->reverse();
        $calendrier_regional = Calendrier_regional::orderBy('id', 'desc')->take(8)->get()->reverse();
        $calendrier_international = Calendrier_international::orderBy('id', 'desc')->take(8)->get()->reverse();
        $calendrier_departemental = Calendrier_departemental::orderBy('id', 'desc')->take(8)->get()->reverse();

        return view('blackball.calendrier', compact(
            'calendrier_national',
            'calendrier_regional',
            'calendrier_international',
            'calendrier_departemental'
        ));
    }


    public function classement()
    {
        // Récupère le mois et l'année actuels
        $currentMonth = date('n');
        $currentYear = date('Y');
        // Calcul l'année de début de saison (Septembre à Aout)
        $startYear = $currentMonth >= 9 ? $currentYear : $currentYear - 1;
        $endYear = $startYear + 1;

        // Récupère les classement (IDs CueScore) pour les équipes nationales et régionales Via les models correspondants
        $nationalClassements = CuescoreNational::first(); 
        $regionalClassements = CuescoreRegional::first();

        // Définition des chemins vers les fichiers de cache server
        $nationalDataFile = storage_path('app/cache_national.json');
        $regionalDataFile = storage_path('app/cache_regional.json');
        $timestampFile = storage_path('app/cache_timestamp.txt');

        $nationalData = [];
        $regionalData = [];
        $limit = 5; // Nombre maximum de joueurs à afficher par classement
        $licencies = $this->chargerLicencies(); // Liste des joueurs licenciés à Joué-lès-Tours

        $cacheDuration = 604800; // Durée de validité du cache : 1 semaine en secondes
        $timestamp = file_exists($timestampFile) ? (int)file_get_contents($timestampFile) : 0;

        // Si le cache est valide et les fichiers existent, on les utilise
        if (time() - $timestamp < $cacheDuration && file_exists($nationalDataFile) && file_exists($regionalDataFile)) {
            $nationalData = json_decode(file_get_contents($nationalDataFile), true);
            $regionalData = json_decode(file_get_contents($regionalDataFile), true);
            Log::info('Données chargées depuis les fichiers de cache.');
        } else {
            // Sinon, on va chercher les données depuis l'API CueScore

            // Fonction anonyme pour récupérer et filtrer les classements
            $fetchClassement = function ($classements, &$data) use ($limit, $licencies) {
                if ($classements) {
                    foreach ($classements->toArray() as $categorie => $cuescoreId) {
                        if ($cuescoreId) { 
                            $apiUrl = "https://api.cuescore.com/ranking/?id=" . $cuescoreId;
                            $response = Http::get($apiUrl);

                            if ($response->successful()) {
                                $rankingData = $response->json();
                                $participants = $rankingData['participants'] ?? [];

                                // Ne garde que les joueurs licenciés à Joué-Lès-Tours
                                $filteredParticipants = array_filter($participants, function ($player) use ($licencies) {
                                    $normalizedPlayerName = self::normalizeName($player['name']);
                                    return in_array($normalizedPlayerName, $licencies);
                                });

                                // Tri par rang croissant
                                usort($filteredParticipants, function ($a, $b) {
                                    return $a['rank'] <=> $b['rank'];
                                });

                                // Limite à $limit joueurs
                                $data[$categorie] = array_slice($filteredParticipants, 0, $limit);
                            }
                        }
                    }
                }
            };

            // Récupération des données pour les classements nationaux et régionaux
            $fetchClassement($nationalClassements, $nationalData);
            $fetchClassement($regionalClassements, $regionalData);

            // Sauvegarde des données dans le cache
            file_put_contents($nationalDataFile, json_encode($nationalData));
            file_put_contents($regionalDataFile, json_encode($regionalData));
            file_put_contents($timestampFile, time());

            Log::info('Données mises à jour et stockées sur le serveur.');
        }

        $divisionDataFile = storage_path('app/cache_divisions.json');

        // Initialisation du tableau contenant les classements par division
        $classement = [];

        // Si le cache existe et est à jour, on l'affiche
        if (time() - $timestamp < $cacheDuration && file_exists($divisionDataFile)) {
            $classement = json_decode(file_get_contents($divisionDataFile), true);
            Log::info('Classements des divisions chargés depuis le cache.');
        } else {
            // SInon, on les récupère depuis l'API Cuescore

            // Instanciation des modèles pour les équipes nationales et régionales
            $nationalTournois = new CuescoreEquipesNationale; 
            $regionalTournois = new CuescoreEquipesRegionale;

            $nationalResults = [];
            $regionalResults = [];

            // Fonction pour récupérer les résultats des tournois via l'API CueScore
            $fetchResults = function ($model, &$resultsArray) {
                $tournois = $model->all();                
                foreach ($tournois as $tournoi) {
                    $apiUrl = "https://api.cuescore.com/tournament/?id={$tournoi->id}";
                    $response = Http::get($apiUrl);

                    if ($response->successful()) {
                        $resultsArray[$tournoi->nom] = $response->json();
                    }
                }
            };

            // Récupération des résultats nationaux et régionaux
            $fetchResults($nationalTournois, $nationalResults);
            $fetchResults($regionalTournois, $regionalResults);

            // Tableaux des divisions à afficher
            $divisions = [
                'DN1' => $nationalResults['DN1'] ?? [],
                'DN2' => $nationalResults['DN2'] ?? [],
                'DR1' => $regionalResults['DR1'] ?? [],
                'DR2' => $regionalResults['DR2'] ?? [],
                'DR3' => $regionalResults['DR3'] ?? [],
                'DR4' => $regionalResults['DR4'] ?? [],
            ];

            // Pour chaque division, on extrait les données nécessaires
            foreach ($divisions as $division => $data) {
                if (isset($data['standings'][1])) {
                    $equipeData = [];

                    // Construction du tableau des équipes
                    foreach ($data['standings'][1] as $equipe) {
                        $equipeData[] = [
                            'nom' => $equipe['player']['name'],
                            'points' => $equipe['points'],
                            'classement' => $equipe['position'],
                        ];
                    }

                    // On cherche "Joué-lès-Tours" dans le nom des équipes (ortographe selon type de division)
                    $searchTerm = in_array($division, ['DN1', 'DN2']) ? 'JOUÉ LÈS TOURS' : 'JOUE LES TOURS';

                    $joueLesToursPresent = collect($equipeData)->contains(function ($equipe) use ($searchTerm) {
                        return stripos($equipe['nom'], $searchTerm) !== false;
                    });

                    // Si joué-lès-Tours est présent dans cette division, on ajoute le classement
                    if ($joueLesToursPresent) {
                        if(in_array($division, ['DN1', 'DN2'])){
                            $url = CuescoreEquipesNationale::where('nom', $division)->value('url');
                        }else{
                            $url = CuescoreEquipesRegionale::where('nom', $division)->value('url');
                        }
                        $classement[$division] = [
                            'equipes' =>$equipeData,
                            'url' => $url,
                        ];
                    }
                }
            }

            // On enregistre les classements par division en cache
            file_put_contents($divisionDataFile, json_encode($classement));
            Log::info('Classements des divisions mis en cache.');

            // Copie en public pour consultation éventuelle externe
            Storage::disk('public')->put('classement_equipes.json', json_encode($classement));

        }

        // On passe toutes les données à la vue
        return view('blackball.classement', compact(
            'nationalData', 
            'regionalData', 
            'classement',
            'startYear', 
            'endYear'
        ));
    }


    /**
     * Charger les licenciés valides depuis licencies.txt et normaliser les noms
     */
    private function chargerLicencies()
    {
        $licencies = [];
        $filePath = public_path('script/licencies.txt');

        if (File::exists($filePath)) {
            $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            $licencies = array_map('trim', $lines);
            $licencies = array_map([self::class, 'normalizeName'], $licencies);
        }

        return $licencies;
    }

    /**
     * Normalise un nom en supprimant les accents et en mettant en minuscule
     */
    private static function normalizeName($str)
    {
        $accents = ['À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'à', 'á', 'â', 'ã', 'ä', 'å',
                    'È', 'É', 'Ê', 'Ë', 'è', 'é', 'ê', 'ë',
                    'Ì', 'Í', 'Î', 'Ï', 'ì', 'í', 'î', 'ï',
                    'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø',
                    'Ù', 'Ú', 'Û', 'Ü', 'ù', 'ú', 'û', 'ü',
                    'Ý', 'ý', 'ÿ', 'Ç', 'ç', 'Ñ', 'ñ'];
        $sans_accents = ['A', 'A', 'A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a', 'a',
                        'E', 'E', 'E', 'E', 'e', 'e', 'e', 'e',
                        'I', 'I', 'I', 'I', 'i', 'i', 'i', 'i',
                        'O', 'O', 'O', 'O', 'O', 'O', 'o', 'o', 'o', 'o', 'o', 'o',
                        'U', 'U', 'U', 'U', 'u', 'u', 'u', 'u',
                        'Y', 'y', 'y', 'C', 'c', 'N', 'n'];

        $str = str_replace($accents, $sans_accents, $str);
        return strtolower(trim($str));
    }
}