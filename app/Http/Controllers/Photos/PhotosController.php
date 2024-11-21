<?php

namespace App\Http\Controllers\Photos;

use App\Models\Gallerie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PhotosController extends Controller
{
    public function index()
    {
        // récupérer les évènements en ordre décroissant, limité à 1
        $photos = Gallerie::paginate(20);

        // Retourner la vue avec les évènements
        return view('photo.index', [
            'photos' => $photos
        ]);
    }

    public function create()
    {
        return view('photo.create');
    }

    public function store(Request $request)
    {
        // Validation des fichiers
        $request->validate([
            'file-upload.*' => 'required|file|mimes:png,jpg,jpeg,gif|max:10240',
        ]);

        $paths=[];

        if($request->hasFile('file-upload')){
            foreach($request->file('file-upload') as $file) {
                $paths[] = $file->store('gallerie', 'public');
            }
        }

        foreach ($paths as $path) {
            Gallerie::create([
                'images' => $path
            ]);
        }

        return redirect()->route('photos')->with('success', 'Les photos ont bien été insérées');
    }

    public function show($id)
    {
        $gallerie = Gallerie::findOrFail($id);

        // Retourner la vue avec les photos
        return view('photo.show', [
            'gallerie' => $gallerie
        ]);
    }

    public function destroy($id)
    {
        $gallerie = Gallerie::findOrFail($id);
        $gallerie->delete();

        return redirect()->route('photos')->with('success', 'La photo a bien été supprimée');
    }
}
