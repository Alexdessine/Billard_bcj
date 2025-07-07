<?php

namespace App\Http\Controllers;

use Log;
use Illuminate\Http\Request;
use App\Models\Calendrier_national;
use App\Models\Calendrier_regional;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use App\Models\Calendrier_international;

class CuescoreController extends Controller
{
    public function show($id)
    {
        $apiUrl = "https://api.cuescore.com/ranking/?id=" . $id;
        $response = Http::get($apiUrl);

        if ($response->successful()) {
            $rankingData = $response->json();
            $participants = $rankingData['participants'] ?? []; // Récupérer uniquement les joueurs

            // Lire les noms du fichier licencies.txt
            $licenciesPath = public_path('script/licencies.txt');
            if (file_exists($licenciesPath)) {
                $licencies = file($licenciesPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                $licencies = array_map('trim', $licencies);
                $licencies = array_map([self::class, 'normalizeName'], $licencies); // Normalisation

                // Debugging - Affiche les licenciés après formatage
                Log::info('Licenciés normalisés : ', $licencies);

                // Normaliser les noms récupérés de l'API et filtrer les participants
                $participants = array_filter($participants, function ($player) use ($licencies) {
                    $playerName = self::normalizeName($player['name']);
                    return in_array($playerName, $licencies);
                });

                // Debugging - Affiche les participants après filtrage
                Log::info('Participants après filtrage : ', $participants);
            }
        } else {
            $participants = [];
        }

        return view('cuescore', compact('participants', 'rankingData'));
    }

     public function calendrier()
    {
        // Récupérer le calendrier national et regional
        $calendrier_national = Calendrier_national::orderBy('id', 'asc')->take(8)->get();
        $calendrier_regional = Calendrier_regional::orderBy('id', 'asc')->take(8)->get();
        $calendrier_international = Calendrier_international::orderBy('id', 'asc')->take(8)->get();

        return view('cuescore', compact(
            'calendrier_national',
            'calendrier_regional',
            'calendrier_international'
        ));
    }

    /**
     * Normalise un nom en supprimant les accents et en mettant en minuscule
     */
    private static function normalizeName($str)
    {
        // Remplacement manuel des accents (plus fiable qu'iconv seul)
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
        $str = strtolower(trim($str)); // Conversion en minuscule et suppression des espaces
        return $str;
    }
}
