<?php

namespace App\Http\Controllers;

use App\Models\Comite;
use Illuminate\Http\Request;

class ComiteController extends Controller
{
    public function index()
    {
        // Récupérer tous les membres du comité
        $comites = Comite::all();

        // Calcul du nombre de fonctions pour chaque membre
        foreach ($comites as &$comite) {
            $fonctions = explode(',', $comite['fonction']);
            $comite['fonction_count'] = count($fonctions);
        }

        // Retourner la vue avec les comités
        return view('comite', [
            'comites' => $comites
        ]);
    }

    private function membreFonction($value)
    {
    // Séparer les valeurs à partir des virgules
    $values = explode(', ', $value);

    // Concatène chaque valeur avec un saut de ligne
    return !empty($values) ? implode('<br>', $values) : '';
    }

}