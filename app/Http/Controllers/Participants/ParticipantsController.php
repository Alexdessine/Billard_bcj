<?php

namespace App\Http\Controllers\Participants;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Scraping_urls_participation;

class ParticipantsController extends Controller
{
    //
    public function index()
    {
        // Vérifier si le fichier Excel existe
        $date = Carbon::now()->format('Y-m-d');
        $fileName = "participants_{$date}.xlsx";
        $fileExists = Storage::disk('public')->exists("participants/{$fileName}");

        // Retourner la vue avec les données nécessaires
        return view('participants.index', compact('fileExists', 'fileName'));
    }

    public function show()
    {
        $liens = Scraping_urls_participation::all();

        return view ('participants.show', compact('liens'));
    }

    public function updateLinks(Request $request)
    {
                // Validation des liens envoyés
        $validatedData = $request->validate([
            'liens.*.id' => 'required|integer|exists:scraping_urls,id',
            'liens.*.url' => 'required|url',
        ]);

        // Mise à jour des liens
        foreach ($validatedData['liens'] as $lienData) {
            $liens = Scraping_urls_participation::findOrFail($lienData['id']);
            $liens->update([
                'url' => $lienData['url'],
            ]);
        }

        return redirect()->route('participants')->with('success', 'Les liens ont bien été mis à jour');
    }

    public function download()
    {
        // Générer le fichier Excel
        $date = Carbon::now()->format('Y-m-d');
        $fileName = "participants_{$date}.xlsx";
        $filePath = "participants/{$fileName}";

        // Vérifier si le fichier existe
        if(!Storage::disk('public')->exists($filePath)) {
            return redirect()->route('participants')->with('errors', 'Le fichier demandé n\'existe pas');
        }

        return Storage::disk('public')->download($filePath);
    }

    public function generate()
    {
        // Chemin absolu vers le script python
        $scriptPath = base_path('resources/script/participant.py');

        // execution du script Python
        $output = shell_exec("python {$scriptPath} 2>&1");

        // Retourner avec un message de succès
        return redirect()->route('participants')->with('success', 'Le fichier a bien été généré');
    }
}
