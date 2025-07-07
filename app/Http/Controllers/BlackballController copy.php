<?php

namespace App\Http\Controllers;

use App\Models\Calendrier_national;
use App\Models\Calendrier_regional;
use App\Models\Post;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlackballController extends Controller
{
    //

    public function index()
    {
        return view('blackball.index', [
            'posts' => Post::paginate(5),
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
        $calendrier_national = Calendrier_national::orderBy('id', 'asc')->take(8)->get();
        $calendrier_regional = Calendrier_regional::orderBy('id', 'asc')->take(8)->get();

        return view('blackball.calendrier', compact(
            'calendrier_national',
            'calendrier_regional'
        ));
    }


    public function classement()
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

        return view('blackball.classement', compact(
            'nationalClassements',
            'regionalClassements',
            'startYear',
            'endYear'
        ));
    }
}
