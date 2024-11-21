<?php

namespace App\Http\Controllers\Licencies;

use App\Http\Controllers\Controller;
use App\Models\Licencies;
use Illuminate\Http\Request;

class LicenciesController extends Controller
{
    //
        public function index()
    {
        $licencies = Licencies::paginate(25);
        $totalLicencies  = Licencies::count();
        
        return view('licencies.index', compact('licencies', 'totalLicencies'));
    }

    public function update()
    {
        // Chemin absolu vers le script python
        $scriptPath = base_path('resources/script/licencies.py');

        // Exécution du script Python
        $output = shell_exec("python {$scriptPath} 2>&1");
        // dd($output); // Affiche les sorties du script pour déboguer

        // retourner une vue ou rediriger avec un message de succès
        return redirect()->route('licencies')->with('success', "Liste des licenciés bien mise à jour");
    }
}
