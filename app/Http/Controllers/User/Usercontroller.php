<?php

namespace App\Http\Controllers\User;

use App\Models\Role;
use App\Models\User;
use App\Mail\PasswordRegen;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\NewUserNotification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewUserAdminNotification;

class Usercontroller extends Controller
{
    //
    public function index()
    {
        $users = User::paginate(10);
        
        return view('user.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('user.show', [
            'user' => $user
        ]);
    }

    public function update($id){
        $password = Str::random(10);

        $user = User::find($id);

        $user->update([
            'regen' => false,
            'password' => Hash::make($password)
        ]);
        
        // Envoyer un mail de confirmation
        Mail::to($user->email)->send(new PasswordRegen($user, $password));

        return redirect()->route('utilisateurs.show', ['id' => $user->id])->with('success', "Le mot de passe vient d'être modifié, une notification a été envoyée par email.");
    }

    public function create()
    {
        $roles=Role::all();

        return view('user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        // Valider les données du formulaire
        $validateData = $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:user,email',
            'role'=>'required|exists:roles,id',
        ], [
            'name.required' => 'Le nom est requis.',
            'email.required' => 'L\'adresse email est requise.',
            'email.unique' => 'Cet email est déjà utilisé.',
            'role.required' => 'Un rôle doit être sélectionner.',
            'role.exists' => 'Le rôle sélectionner n\'est pas valide.',
        ]);

        // Générer un mot de passe aléatoire
        $password = Str::random(10);

        // Créer l'utilisateur
        $user = User::create([
            'name' => $validateData['name'],
            'email' => $validateData['email'],
            'password' => Hash::make($password),
            'role_id' => $validateData['role'],
            'regen' => false,
        ]);

        // Envoyer un email à l'utilisateur avec son mot de passe
        Mail::to($user->email)->send(new NewUserNotification($user, $password));

        // Envoyer un email à l'admin du site
        Mail::to(env('ADMIN_EMAIL', 'admin@bcj.fr'))->send(new NewUserAdminNotification($user));

        // rediriger avec un message de succès
        return redirect()->route('utilisateurs')->with('success', 'Utilisateur créer avec succès. Un email vient de lui être envoyé.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('utilisateurs')->with('success', "Utilisateur supprimé avec succès");
    }
}
