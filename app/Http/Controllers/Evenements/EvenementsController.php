<?php

namespace App\Http\Controllers\Evenements;

use App\Models\Evenements;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class EvenementsController extends Controller
{
    //
    public function index()
    {
        // récupérer les évènements en ordre décroissant, limité à 1
        $evenements = Evenements::paginate(10);

        // Retourner la vue avec les évènements
        return view('evenements/index', [
            'evenements' => $evenements
        ]);
    }

    public function create()
    {
        return view('evenements/create');
    }

    public function show($id)
    {

        $evenement = Evenements::findOrFail($id);

        // Retourner la vue avec les évènements
        return view('evenements/show', [
            'evenement' => $evenement
        ]);
    }

    public function store(Request $request)
    {
        // Validation des champs
        $validateData = $request->validate([
            'url' => 'required|url',
            'file-upload' => 'required|file|mimes:png,jpg,jpeg,gif|max:10240',
        ], [
            'url.required' => 'Le lien Facebook est obligatoire.',
            'file-upload.required' => 'Une image est obligatoire.',
            'file-upload.mimes' => 'Seuls les formats JPG, PNG et GIF sont autorisés.',
            'file-upload.max' => 'La taille maximale de l\'image est de de 10Mo.',
        ]);

        // Gérer le téléchargment de l'image
        if($request->hasFile('file-upload')) {
            $imagePath = $request->file('file-upload')->store('evenements', 'public'); //Stocké dans storage/app/public/evenements
        }

        // Créer l'évènement
        Evenements::create([
            'facebook' => $validateData['url'],
            'image' => $imagePath,
        ]);

        // Redirection avec un message de succès
        return redirect()->route('evenements')->with('success', 'L\'évènement a bien été enregistré');
    }

    public function destroy($id)
    {
        $evenement = Evenements::findOrFail($id);
        $evenement->delete();

        return redirect()->route('evenements')->with('success', 'Evènement supprimé avec succès');
    }

}
