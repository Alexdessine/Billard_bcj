<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    // Afficher l'editeur
    public function create()
    {
        return view('test');
    }

    // Sauvegarder le contenu
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'content' => ['required', 'string'],
        ]);

        $test = Test::create($data);

        return redirect()
            ->route('lecture-test', ['test' => $test->id])
            ->with('ok', 'Contenu enregistré.');
    }

    // Lecture (si id non fourni : dernier enregistrement)
    public function show(?Test $test = null)
    {
        $test = $test ?? Test::latest('id')->firstOrFail();
        return view('lecture-test', compact('test'));
    }
}
