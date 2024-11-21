<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // Affichage formulaire d'inscription
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function store(Request $request){

        // Validation des champs
        $validateData = $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:user,email',
            'password'=>'required|string|min:8|confirmed',
        ], [
            'email.unique' => "Un compte existe déjà avec cette adresse email.",
            'password.confirmed' => "Les mots de passes ne sont pas identiques.",
            'password.min' => "Le mot de passe doit contenir au moins 8 caractères."
        ]);

        // Création de l'utilisateur
        $user = User::create([
           'name'=>$validateData['name'],
           'email'=>$validateData['email'],
           'password'=>Hash::make($validateData['password']),
           'regen'=>false,
           'role_id'=>3,
        ]);

        Auth::login($user);

        // Redirection vers la page souhaitée après inscription
        return redirect()->route('evenements')->with('success', 'Inscription réussie ! ');
    }
}
