<?php

namespace App\Http\Controllers;

use App\Models\Evenements;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
    public function index()
    {
        // récupérer les évènements en ordre décroissant, limité à 1
        $evenements = Evenements::orderBy('id', 'desc')->take(1)->get();

        // Retourner la vue avec les évènements
        return view('index', [
            'evenements' => $evenements
        ]);
    }
}
