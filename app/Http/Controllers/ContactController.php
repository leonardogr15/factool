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
            'email' => 'required|email',
        ]);

        $contact = Contact::updateOrCreate(
            ['email' => $validated['email']],
            ['name' => $validated['name']]
        );

        SendEmailJob::dispatch($contact);

        return response()->json(['message' => 'Contacto creado/actualizado y correo enviado.'], 201);
    }
}
