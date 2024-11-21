<?php

namespace App\Http\Controllers\Tournois;

use App\Http\Controllers\Controller;
use App\Models\Scraping_url;
use Illuminate\Http\Request;

class TournoisController extends Controller
{
    //
    public function index()
    {
        return view('tournois.index');
    }
    
    public function update()
    {
        // Chemin absolu vers le script python
        $scriptPath = base_path('resources/script/classement.py');

        // Exécution du script Python
        $output = shell_exec("python {$scriptPath} 2>&1");
        // dd($output); // Affiche les sorties du script pour déboguer

        // retourner une vue ou rediriger avec un message de succès
        return redirect()->route('tournois')->with('success', "Les classements ont bien été mis à jour");
    }

    public function show()
    {
        $liens = Scraping_url::all();

        return view('tournois.show', compact('liens'));
    }

    public function updateLiens(Request $request)
    {

        // Validation des liens envoyés
        $validatedData = $request->validate([
            'liens.*.id' => 'required|integer|exists:scraping_urls,id',
            'liens.*.url' => 'required|url',
        ]);

        // Mise à jour des liens
        foreach ($validatedData['liens'] as $lienData) {
            $liens = Scraping_url::findOrFail($lienData['id']);
            $liens->update([
                'url' => $lienData['url'],
            ]);
        }

        // Redirection avec un message de succès
        return redirect()->route('tournois')->with('success', 'Les liens ont bien été mis à jour.');
    }
}
