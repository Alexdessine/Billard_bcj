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
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email:rfc,dns',
            'message' => 'required|string|min:10|max:5000',
        ]);

        try {
            Mail::raw(
                "Nom : {$validated['name']}\n".
                "Email : {$validated['email']}\n\n".
                "Message :\n{$validated['message']}",
                function ($message) use ($validated) {
                    // 1) FROM = une adresse de TON domaine (authentifiée SPF/DKIM)
                    $message->from('no-reply@bcj37.fr', 'BCJ37 — Formulaire de contact');

                    // 2) TO = ta boîte de réception
                    $message->to('contact@bcj37.fr');

                    // 3) REPLY-TO = l’adresse de l’expéditeur réel
                    $message->replyTo($validated['email'], $validated['name']);

                    $message->subject('Nouveau message depuis le formulaire de contact');
                }
            );

            return back()->with('success', 'Votre message a bien été envoyé.');
        } catch (\Throwable $e) {
            report($e);
            return back()->with('error', "Une erreur est survenue lors de l'envoi du message.");
        }
    }
}
