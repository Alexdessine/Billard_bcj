<?php

namespace App\Http\Controllers\Comite;

use App\Http\Controllers\Controller;
use App\Models\Comite;
use Illuminate\Http\Request;

class ComiteAdminController extends Controller
{
    public function index()
    {
        $comites = Comite::paginate(10);
        return view('comites.index', compact('comites'));
    }

    public function create()
    {
        return view('comites.create');
    }

    public function store(Request $request)
    {
        // Validation des champs
        $validateData = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'fonction' => 'required|json',
            'telephone' => 'required|string|max:155',
            'email' => 'required|email|max:255',
            'file-upload' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:10240',
        ], [
            'file-upload.mimes' => 'Seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.',
            'file-upload.max' => 'La taille maximale de l\'image est de 10 Mo.',
        ]);

        // Gestion des fonctions (décodage JSON)
        $fonctions = json_decode($validateData['fonction'], true);
        $fonctionsList = [];
        if (is_array($fonctions)) {
            foreach ($fonctions as $fonction) {
                $fonctionsList[] = $fonction['value'];
            }
        }
        $fonctionsString = implode(', ', $fonctionsList);

        // Gestion du fichier uploadé
        $filePath = 'comite/profil.jpg'; // Image par défaut
        if ($request->hasFile('file-upload')) {
            $filePath = $request->file('file-upload')->store('comite', 'public');
        }

        // Création du membre dans la base de données
        Comite::create([
            'nom' => $validateData['nom'],
            'prenom' => $validateData['prenom'],
            'fonction' => $fonctionsString,
            'telephone' => $validateData['telephone'],
            'email' => $validateData['email'],
            'image' => $filePath,
        ]);

        // Redirection avec un message de succès
        return redirect()->route('comites')->with('success', 'Le membre a été ajouté avec succès.');
    }

    public function show($id)
    {
        $comite = Comite::findOrFail($id);

        // Retourner la vue avec les informations du membre
        return view('comites.show', [
            'comite' => $comite
        ]);
    }

    public function edit($id)
    {
        // Rechercher le membre par ID ou échouer
        $comite = Comite::findOrFail($id);

        // Retourner la vue d'édition avec les données du membre
        return view('comites.edit', compact('comite'));
    }

    public function update(Request $request, $id)
    {

        // Trouver le tournoi correspondant
        $comite = Comite::findOrFail($id);
        // Validation des champs
        $validateData = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'fonction' => 'required|json',
            'telephone' => 'required|string|max:155',
            'email' => 'required|email|max:255',
            'file-upload' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:10240',
        ], [
            'file-upload.mimes' => 'Seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.',
            'file-upload.max' => 'La taille maximale de l\'image est de 10 Mo.',
        ]);

        // Gestion des fonctions (décodage JSON)
        $fonctions = json_decode($validateData['fonction'], true);
        $fonctionsList = [];
        if (is_array($fonctions)) {
            foreach ($fonctions as $fonction) {
                $fonctionsList[] = $fonction['value'];
            }
        }
        $fonctionsString = implode(', ', $fonctionsList);

        // Gestion du fichier uploadé
        $filePath = 'comite/profil.jpg'; // Image par défaut
        if ($request->hasFile('file-upload')) {
            $filePath = $request->file('file-upload')->store('comite', 'public');
        }
        
        // Enregistrement dans la base de données
        $comite->update([
            'nom' => $validateData['nom'],
            'prenom' => $validateData['prenom'],
            'fonction' => $fonctionsString,
            'telephone' => $validateData['telephone'],
            'email' => $validateData['email'],
            'image' => $filePath,
        ]);

        // Redirection avec un message de succès
        return redirect()->route('comites')->with('success', 'Le membre a bien été mis à jour.');
    }

    public function destroy($id)
    {
        $comite  = Comite::findOrFail($id);
        $comite->delete();

        return redirect()->route('comites')->with('success', 'Le membre a bien été supprimé');
    }
}
