<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ClassementCarambole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CaramboleSyncController extends Controller
{
    public function __invoke(Request $request)
    {
        $folder     = (string) $request->input('folder', 'ftp');             // ex: 'ftp'
        $discipline = (string) $request->input('discipline', 2);   // chez toi: '2'
        $resetAll   = $request->boolean('reset_all', false);
        $reset      = $request->boolean('reset', false);
        $dry        = $request->boolean('dry', false);

        $disk = Storage::disk('public');

        // S'assurer que le dossier existe
        if (!$disk->exists($folder)) {
            $disk->makeDirectory($folder);
        }

        // Pour debug: chemin absolu
        $abs = method_exists($disk, 'path')
            ? $disk->path($folder)
            : base_path('storage/app/public/'.$folder);

        // Récupération récursive de tous les fichiers
        $all  = $disk->allFiles($folder);
        $pdfs = collect($all)
            ->filter(fn ($p) => Str::endsWith(Str::lower($p), '.pdf'))
            ->values();

        // Log minimal
        Log::info('carambole.sync scan', [
            'folder'      => $folder,
            'abs'         => $abs,
            'total_files' => count($all),
            'pdf_count'   => $pdfs->count(),
            'samples'     => $pdfs->take(5)->all(),
            'reset_all'   => $resetAll,
            'reset'       => $reset,
            'dry'         => $dry,
        ]);

        // Dry-run: ne modifie pas la BDD
        if ($dry) {
            return response()->json([
                'status'  => 'dry',
                'folder'  => $folder,
                'abs'     => $abs,
                'found'   => $pdfs->count(),
                'samples' => $pdfs->take(10)->values(),
            ]);
        }

        // Reset table si demandé
        if ($resetAll) {
            ClassementCarambole::query()->delete();
        } elseif ($reset) {
            ClassementCarambole::where('discipline', $discipline)->delete();
        }

        $synced = 0;

        DB::transaction(function () use ($pdfs, $discipline, &$synced, $disk) {
            foreach ($pdfs as $path) {
                $base = pathinfo($path, PATHINFO_FILENAME); // titre lisible

                // (Optionnel) Renommage "propre" en slug — tu peux commenter ce bloc si tu ne veux pas renommer physiquement
                $dir    = trim(dirname($path), '/');
                $slug   = Str::slug($base) ?: 'document';
                $target = $dir.'/'.$slug.'.pdf';

                // Évite les collisions si on renomme physiquement
                if ($target !== $path) {
                    $unique = $target;
                    $i = 1;
                    while ($disk->exists($unique) && $unique !== $path) {
                        $unique = $dir.'/'.$slug.'-'.$i.'.pdf';
                        $i++;
                    }
                    if ($unique !== $path) {
                        $disk->move($path, $unique);
                        $path = $unique;
                    }
                }

                // Upsert
                ClassementCarambole::updateOrCreate(
                    ['file' => $path],
                    ['title' => $base, 'discipline' => $discipline]
                );

                $synced++;
            }
        });

        return response()->json([
            'status' => 'ok',
            'folder' => $folder,
            'abs'    => $abs,
            'found'  => $pdfs->count(),
            'synced' => $synced,
        ]);
    }
}
