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
        // Validar la entrada
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        // Crear el nuevo contacto
        $contact = Contact::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        // Despachar el Job para enviar el correo
        SendEmailJob::dispatch($contact);

        return response()->json(['message' => 'Contacto creado y correo enviado.'], 201);
    }
}
