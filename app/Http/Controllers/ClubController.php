<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClubController extends Controller
{
    //
    public function index(Request $request)
    {
        $yearFilter = $request->query('year', date('Y'));

        // Définition des décennies
        $decades = [
            'Depuis_2020' => [2020, 2030],
            '2019_2010' => [2010, 2019],
            '2009_2000' => [2000, 2009],
            'Avant_2000' => [0, 1999],
        ];

        // Vérifie si le filtre correspond à une décennie
        if(isset($decades[$yearFilter])) {
            [$startYear, $endYear] = $decades[$yearFilter];
            $posts = Post::whereNull('discipline')
            ->whereBetween('year', [$startYear, $endYear])
            ->orderBy('created_at', 'desc')
            ->paginate(8);
        } else {
            // SI aucun filtre ou filtre invalide, récupérer tout les posts
            $posts = Post::whereNull('discipline')
                ->orderBy('created_at', 'desc')
                ->paginate(8);
        }
        return view('club.index', ['posts' => $posts]);
    }

    public function show(Post $post): View
    {
        return view('club.show', [
            'post' => $post, 
            'title' => $post->title,
            'description' => $post->excerpt,
            'image' => secure_asset('uploads/' . $post->thumbnail),
            'url' => url()->current(),
        ]);
    }

    public function clubByTag(string $year): View
    {
        // Récupère les posts correspondant à l'année demandée
        $posts = Post::where('year', $year)->latest()->paginate(8);

        return view('club.byTag', compact('year', 'posts'));
    }

    public function clubByDecade($decadeSlug): View
    {
        // Récupère l'année actuelle
        $currentYear = date('Y');
        $currentDecadeStart = floor($currentYear / 10) * 10; // Ex: 2032 → 2030

        // Générer dynamiquement les décennies
        $decades = [
            'depuis_' . $currentDecadeStart => [
                'label' => 'Depuis ' . $currentDecadeStart,
                'start' => $currentYear,
                'end'   => $currentDecadeStart
            ]
        ];

        for ($i = $currentDecadeStart - 10; $i >= 2000; $i -= 10) {
            $decades[$i . '_' . ($i + 9)] = [
                'label' => "$i - " . ($i + 9),
                'start' => $i + 9,
                'end'   => $i
            ];
        }

        // Ajouter la catégorie "Avant 2000"
        $decades['avant_2000'] = [
            'label' => 'Avant 2000',
            'start' => 1999,
            'end'   => 0
        ];

        // Vérification du slug
        if (!array_key_exists($decadeSlug, $decades)) {
            abort(404); // Décennie non trouvée
        }

        $selectedDecade = $decades[$decadeSlug];

        // Filtrer les posts selon la décennie
        $posts = Post::whereNull('discipline')
                    ->whereBetween('year', [$selectedDecade['end'], $selectedDecade['start']])
                    ->orderBy('created_at', 'desc')
                    ->paginate(8);

        return view('club.byDecade', compact('selectedDecade', 'posts'));
    }


}
