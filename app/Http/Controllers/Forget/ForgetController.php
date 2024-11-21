<?php

namespace App\Http\Controllers\Forget;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\PasswordResetRequest;
use App\Http\Controllers\Controller;
use App\Mail\AdminPasswordResetNotification;
use Illuminate\Support\Facades\Mail;

class ForgetController extends Controller
{
    //
    public function index()
    {
        return view('forget.index');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'email' => 'required|email',
        ]);

        // Cherche l'utilisateur avec l'adresse mail fournie
        $user = User::where('email', $validateData['email'])->first();

        if ($user) {
            // Mettre à jour la colonne 'regen' de l'utilisateur
            $user->update(['regen' => true]);

            // Envoyer l'email de notification à l'utilisateur
            Mail::to($user->email)->send(new PasswordResetRequest($user));

            // Envoyer l'email de notification à l'administrateur
            Mail::to(env('ADMIN_EMAIL', 'admin@bcj.fr'))->send(new AdminPasswordResetNotification($user));

            return back()->with('success', 'un Email vous sera envoyé avec vos nouveaux identifiants');
        }else {
            // Si l'utilisateur n'existe pas
            return back()->withInput()->withErrors(['email' => "Aucun compte n'existe avec cette email"]);
        }        
    }
}
