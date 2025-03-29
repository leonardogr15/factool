<?php

namespace App\Jobs;

use App\Mail\SendContactEmail;
use App\Models\Contact;
use Illuminate\Bus\Dispatchable;  // Importar Dispatchable desde Illuminate\Bus
use Illuminate\Bus\Queueable;     // Importar Queueable desde Illuminate\Bus
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJob
{
    use Dispatchable, Queueable, SerializesModels;  // Usar los traits correctamente

    protected $contact;

    /**
     * Crear una nueva instancia del trabajo.
     *
     * @param  \App\Models\Contact  $contact
     * @return void
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    /**
     * Ejecutar el trabajo de envío de correo.
     *
     * @return void
     */
    public function handle()
    {
        // Enviar el correo usando el modelo de contacto
        Mail::to($this->contact->email)->send(new SendContactEmail($this->contact));
    }
}
