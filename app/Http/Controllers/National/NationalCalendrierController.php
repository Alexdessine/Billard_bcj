<?php

namespace App\Http\Controllers\National;

use App\Http\Controllers\Controller;
use App\Models\Calendrier_national;
use Illuminate\Http\Request;

class NationalCalendrierController extends Controller
{
    public function index()
    {
        $nationaux = Calendrier_national::paginate(10);
        return view('national.index', compact('nationaux'));
    }

    public function create()
    {
        return view('national.create');
    }

    public function show($id)
    {
        $national = Calendrier_national::findOrFail($id);

        // Retourner la vue avec les éléments
        return view('national.show', [
            'national' => $national
        ]);
    }

    public function store(Request $request)
    {
        // Validation des champs
        $validateData = $request->validate([
            'date-debut' => 'required|date',
            'date-fin' => 'required|date|after_or_equal:date-debut',
            'name' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'ville' => 'required|string|max:255',
            'region' => 'required|string|max:255',
            'postal-code' => ['required', 'regex:/^\d{5}$/'],
            'club' => 'required|string|max:255',
            'url' => 'required|url|max:255',
        ], [
            'postal-code.regex' => 'Le code postal doit être au format numérique suivant 00000.',
            'date-fin.after_or_equal' => 'La date de fin doit être égale ou supérieure à la date de début',
        ]);

        // Concaténation de l'adresse
        $lieu = $validateData['adresse'] . ' - ' .
                $validateData['postal-code'] . ' - ' .
                $validateData['ville'] . ' - ' .
                $validateData['region'];
        
        // Enregistrement dans la base de données
        Calendrier_national::create([
            'date_debut' => $validateData['date-debut'],
            'date_fin' => $validateData['date-fin'],
            'titre' => $validateData['name'],
            'lieu' => $lieu,
            'club' => $validateData['club'],
            'url' => $validateData['url'],
            'is_closed' => 0,
        ]);

        // Redirection avec un message de succès
        return redirect()->route('national')->with('success', 'Le tournoi a bien été créer.');
    }

        
    public function edit($id)
    {
        // Rechercher l'entrée par ID ou échouer
        $national = Calendrier_national::findOrFail($id);

        // Décomposer le champ 'lieu en parties
        $lieuParts = explode(' - ', $national->lieu);
        $adresse = $lieuParts[0] ?? '';
        $postalCode = $lieuParts[1] ?? '';
        $ville = $lieuParts[2] ?? '';
        $region = $lieuParts[3] ?? '';

        // Retourner la vue d'édition avec les données de l'entrée
        return view('national.edit', compact('national', 'adresse', 'postalCode', 'ville', 'region'));
    }

    public function update(Request $request, $id)
    {

        // Trouver le tournoi correspondant
        $national = Calendrier_national::findOrFail($id);
        // Validation des champs
        $validateData = $request->validate([
            'date-debut' => 'required|date',
            'date-fin' => 'required|date|after_or_equal:date-debut',
            'name' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'ville' => 'required|string|max:255',
            'region' => 'required|string|max:255',
            'postal-code' => ['required', 'regex:/^\d{5}$/'],
            'club' => 'required|string|max:255',
            'url' => 'required|url|max:255',
        ], [
            'postal-code.regex' => 'Le code postal doit être au format numérique suivant 00000.',
            'date-debut.required' => 'La date de début est obligatoire',
            'date-fin.after_or_equal' => 'La date de fin doit être égale ou supérieure à la date de début',
        ]);

        // Concaténation de l'adresse
        $lieu = $validateData['adresse'] . ' - ' .
                $validateData['postal-code'] . ' - ' .
                $validateData['ville'] . ' - ' .
                $validateData['region'];
        
        // Enregistrement dans la base de données
        $national->update([
            'date_debut' => $validateData['date-debut'],
            'date_fin' => $validateData['date-fin'],
            'titre' => $validateData['name'],
            'lieu' => $lieu,
            'club' => $validateData['club'],
            'url' => $validateData['url'],
        ]);

        // Redirection avec un message de succès
        return redirect()->route('national')->with('success', 'Le tournoi a bien été mis à jour.');
    }

    public function destroy($id)
    {
        $national = Calendrier_national::findorFail($id);
        $national->delete();

        return redirect()->route('national')->with('success', 'Tournoi supprimé avec succès');
    }
}
