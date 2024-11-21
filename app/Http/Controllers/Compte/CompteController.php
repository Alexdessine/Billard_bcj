<?php

namespace App\Http\Controllers\Compte;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\UpdatePasswordNotification;

class CompteController extends Controller
{
    //
    public function index()
    {
        $utilisateur = Auth::user();

        return view('compte.index', compact('utilisateur'));
    }

    public function edit(Request $request)
    {
        // Validation des champs
        $validateData = $request->validate([
            'current_password' => 'required|string|min:8',
            'password'=>[
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/[A-Z]/', //Au moins une lettre majuscule
                'regex:/[0-9]/', //Au moins un chiffre
            ],
        ], [
            'current_password.required' => 'Le mot de passe actuel est requis',
            'password.required' => 'Le nouveau mot de passe est requis',
            'password.confirmed' => 'Les mots de passes ne sont pas identiques',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères',
            'password.regex' => 'Le mot de passe doit contenir au moins une majuscule et un chiffre'
        ]);

        // Vérifier le mot de passe actuel
        if (!Hash::check($validateData['current_password'], Auth::user()->password)){
            return redirect()->back()->withErrors([
                'current_password' => 'Le mot de passe actuel est incorrect',
            ]);
        }

        // Si tout est ok, mettre à jour le mot de passe
        Auth::user()->update([
            'password'=> Hash::make($validateData['password']),
        ]);

        Mail::to(Auth::user()->email)->send(new UpdatePasswordNotification(Auth::user()));

        // Rediriger avec un message de succès
        return redirect()->route('compte')->with('success', 'Mot de passe mis à jour avec succès');
    }
}
