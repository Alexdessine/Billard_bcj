<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SessionController extends Controller
{
    // Affichage formulaire d'inscription
    public function index()
    {
        return view('session.index');
    }

    public function login(Request $request){

        // Validation des champs
        $validateData = $request->validate([
            'email'=>'required|email',
            'password'=>'required|string|min:8',
        ], [
            'email.required' => "L'email est requis.",
            'password.required' => "Le mot de passe est requis.",
            'password.min' => "Le mot de passe doit contenir au moins 8 caractères."
        ]);

        // tentative de connexion
        if (Auth::attempt(['email' => $validateData['email'], 'password' => $validateData['password']])){
            // rediriger l'utilisateur vers la page souhaité après connexion
            return redirect()->route('evenements')->with('success', 'Connexion réussie !');
        }

        // Si la tentative de connexion échoue
        return redirect()->back()->withInput()->withErrors([
            'email' => 'Les informations ne correspondent pas'
        ]);
    }

    public function destroy()
    {
        Auth::logout();
        return redirect('/');
    }
}
