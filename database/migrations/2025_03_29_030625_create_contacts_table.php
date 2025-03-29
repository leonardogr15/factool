<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Almacenar un nuevo contacto y enviar un correo.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:contacts,email', 
        ]);

        $existingContact = Contact::where('email', $validated['email'])->first();
        if ($existingContact) {
            return response()->json(['message' => 'El correo ya está registrado.'], 400);
        }

        $contact = Contact::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        SendEmailJob::dispatch($contact);

        return response()->json(['message' => 'Contacto creado y correo enviado.'], 201);
    }
}
