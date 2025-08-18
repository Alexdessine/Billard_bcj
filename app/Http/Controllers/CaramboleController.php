<?php

namespace App\Http\Controllers;

use Mpdf\Mpdf;
use Dompdf\Dompdf;
use App\Models\Post;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Calendrier_national;
use App\Models\Calendrier_regional;
use App\Models\CaramboleCalendrier;
use App\Models\ClassementCarambole;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\CaramboleCalendrierNational;
use App\Models\CaramboleCalendrierRegional;
use App\Models\CaramboleCalendrierDepartemental;
use App\Models\CaramboleCalendrierInternational;

class CaramboleController extends Controller
{
    //

    public function index()
    {
        return view('carambole.index', [
            'posts' => Post::paginate(5),
        ]);
    }

        public function show(Post $post): View
    {
        return view('carambole.show', [
            'post' => $post, 
        ]);
    }

    public function calendrier()
    {
        // Récupérer le calendrier national et regional
        $carambole_national = CaramboleCalendrierNational::orderBy('id', 'desc')->take(8)->get()->reverse();
        $carambole_regional = CaramboleCalendrierRegional::orderBy('id', 'desc')->take(8)->get()->reverse();
        $carambole_international = CaramboleCalendrierInternational::orderBy('id', 'desc')->take(8)->get()->reverse();
        $carambole_departemental = CaramboleCalendrierDepartemental::orderBy('id', 'desc')->take(8)->get()->reverse();
        $carambole_calendrier = CaramboleCalendrier::orderBy('id', 'desc')->take(8)->get()->reverse();

        return view('carambole.calendrier', compact(
            'carambole_national',
            'carambole_regional',
            'carambole_international',
            'carambole_departemental',
            'carambole_calendrier'
        ));
    }


    public function classement()
    {
        $nomFichier = 'Une bande 23 joueurs.xlsx';

        // Lire le fichier depuis le disque
        $chemin = Storage::disk('public')->path("pdf/carambole/excel/{$nomFichier}");

        // Vérifier si le fichier existe dans le disque "public"
        if (!Storage::disk('public')->exists("pdf/carambole/excel/{$nomFichier}")) {
            abort(404, 'Fichier non trouvé');
        }


        $spreadsheet = IOFactory::load($chemin);
        $sheet = $spreadsheet->getSheet(0);
        $data = $sheet->toArray(null, true, false, false); // tableau associatif

        return view('carambole.classement', compact('data'));
    }
    
    public function classementPdf()
    {
        $nomFichier = 'Une bande 23 joueurs.xlsx';
        $chemin = Storage::disk('public')->path("pdf/carambole/excel/{$nomFichier}");

        if (!Storage::disk('public')->exists("pdf/carambole/excel/{$nomFichier}")) {
            abort(404, 'Fichier classement introuvable.');
        }

        $spreadsheet = IOFactory::load($chemin);
        $sheet = $spreadsheet->getActiveSheet();
        $data = $sheet->toArray(null, true, true, true);

        $html = view('carambole.classement-pdf', compact('data'))->render();

        $mpdf = new Mpdf(['orientation' => 'L']);
        $mpdf->WriteHTML($html);

        return response($mpdf->Output('', 'S'), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="classement.pdf"');
    }

    public function classementMultiple()
    {
        // Récupère les entrées depuis la DB (filtre si besoin par discipline)
        $rows = ClassementCarambole::query()
            // ->where('discipline', 'carambole')   // ajuste/retire ce filtre selon ton usage
            ->orderByDesc('id')          // ou ->orderBy('title')
            ->get(['title', 'file']);

        // On mappe vers la même structure que ton ancienne vue attendait
        $fichiers = $rows->map(function ($row) {
            return [
                'nom' => $row->title,
                // Génère l’URL publique vers /storage/...
                'url' => Storage::url($row->file), // ex: "ftp/3 bandes.pdf" -> "/storage/ftp/3 bandes.pdf"
            ];
        });

        return view('carambole.classement', compact('fichiers'));
    }
}
