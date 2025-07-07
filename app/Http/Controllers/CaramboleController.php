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
        $carambole_national = CaramboleCalendrierNational::orderBy('id', 'asc')->take(8)->get();
        $carambole_regional = CaramboleCalendrierRegional::orderBy('id', 'asc')->take(8)->get();
        $carambole_international = CaramboleCalendrierInternational::orderBy('id', 'asc')->take(8)->get();
        $carambole_departemental = CaramboleCalendrierDepartemental::orderBy('id', 'asc')->take(8)->get();
        $carambole_calendrier = CaramboleCalendrier::orderBy('id', 'desc')->take(8)->get();

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
}
