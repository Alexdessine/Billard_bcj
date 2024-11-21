<?php

namespace App\Http\Controllers;

use App\Models\Calendrier_national;
use App\Models\Calendrier_regional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlackballController extends Controller
{
    //
    public function index()
    {
        // Obtenir le mois et l'année actuels
        $currentMonth = date('n');
        $currentYear = date('Y');

        // Déterminer les années de début et de fin de la saison
        $startYear = $currentMonth >= 9 ? $currentYear : $currentYear - 1;
        $endYear = $startYear + 1;

        // Déterminer les classements nationaux et régionaux
        $nationalClasses = [
            'master' => 'Master', 
            'national_mixte' => 'Mixte', 
            'national_feminin' => 'Féminin', 
            'national_handi' => 'Handi', 
            'national_espoir' => 'Espoir', 
            'national_junior' => 'Junior', 
            'national_veteran' => 'Vétéran'
        ];

        $regionalClasses = [
            'top_ligue' => 'Top ligue',
            'regional_mixte' => 'Mixte', 
            'regional_feminin' => 'Féminin', 
            'regional_junior' => 'Junior', 
            'regional_benjamin' => 'Benjamin', 
            'regional_espoir' => 'Espoir', 
            'regional_handi' => 'Handi', 
            'regional_handi_fauteuil' => 'Handi fauteuil', 
            'regional_veteran' => 'Vétéran' 
        ];

        $nationalClassements = [];
        $regionalClassements = [];

        foreach ($nationalClasses as $table => $displayName) {
            $nationalClassements[$displayName] = DB::table($table)->limit(5)->get();
        }

        foreach ($regionalClasses as $table => $displayName) {
            $regionalClassements[$displayName] = DB::table($table)->limit(5)->get();
        }

        // Récupérer le calendrier national et regional
        $calendrier_national = Calendrier_national::all();
        $calendrier_regional = Calendrier_regional::all();

        // Transmettre les données à la vue
        return view('blackball', compact(
            'nationalClassements', 
            'regionalClassements', 
            'calendrier_national', 
            'calendrier_regional', 
            'startYear', 
            'endYear'
        ));
    }
}
