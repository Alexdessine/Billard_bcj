<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\AmericainClassement;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\AmericainCalendrierNational;
use App\Models\AmericainCalendrierRegional;
use App\Models\AmericainCalendrierDepartemental;
use App\Models\AmericainCalendrierInternational;

class AmericainController extends Controller
{
    //
    public function index()
    {
        return view('americain.index', [
            'posts' => Post::paginate(5),
        ]);
    }

        public function show(Post $post): View
    {
        return view('americain.show', [
            'post' => $post, 
        ]);
    }

    public function calendrier()
    {
        // Récupérer le calendrier national et regional
        $americain_national = AmericainCalendrierNational::orderBy('id', 'asc')->take(8)->get();
        $americain_regional = AmericainCalendrierRegional::orderBy('id', 'asc')->take(8)->get();
        $americain_international = AmericainCalendrierInternational::orderBy('id', 'asc')->take(8)->get();
        $americain_departemental = AmericainCalendrierDepartemental::orderBy('id', 'asc')->take(8)->get();
        // $americain_calendrier = AmericainCalendrier::orderBy('id', 'desc')->take(8)->get();

        return view('americain.calendrier', compact(
            'americain_national',
            'americain_regional',
            'americain_international',
            'americain_departemental'
            // 'americain_calendrier'
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
        $americainClassement = AmericainClassement::first(); 

        // Définition des chemins vers les fichiers de cache server
        $americainDataFile = storage_path('app/cache_americain.json');
        $timestampFile = storage_path('app/cache_timestamp.txt');

        $americainData = [];
        $limit = 5; // Nombre maximum de joueurs à afficher par classement
        $licencies = $this->chargerLicencies(); // Liste des joueurs licenciés à Joué-lès-Tours

        $cacheDuration = 604800; // Durée de validité du cache : 1 semaine en secondes
        $timestamp = file_exists($timestampFile) ? (int)file_get_contents($timestampFile) : 0;

        // Si le cache est valide et les fichiers existent, on les utilise
        if (time() - $timestamp < $cacheDuration && file_exists($americainDataFile)) {
            $americainData = json_decode(file_get_contents($americainDataFile), true);
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
            $fetchClassement($americainClassement, $americainData);

            // Sauvegarde des données dans le cache
            file_put_contents($americainDataFile, json_encode($americainData));
            file_put_contents($timestampFile, time());

            Log::info('Données mises à jour et stockées sur le serveur.');

        }

        // On passe toutes les données à la vue
        return view('americain.classement', compact(
            'americainData',  
            'americainClassement',
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
