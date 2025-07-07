<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    //
    public function index(Contact $contact)
    {
        $contact = Contact::first();
        return view('contact', [
            'contact' => $contact, 
        ]);
    }

    // public function contact()
    // {
    //     return view('layouts.footer' , [
    //         'contact_footer' => SiteSetting::first(), 
    //     ]);
    // }

    public function send(Request $request)
    {
        // Validation basique
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Envoie de l'email
            Mail::raw(
                "Nom : {$validated['name']}\n" .
                "Email : {$validated['email']}\n\n" .
                "Message :\n{$validated['message']}",
                function ($message) use ($validated) {
                    $message->to('contact@bcj37.fr')
                            ->subject('Nouveau message depuis le formulaire de contact')
                            ->from($validated['email'], $validated['name']);
                }
            );

        return redirect()->back()->with('success', 'Votre message a bien été envoyé');
    }
}
