<?php

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Dispatchable;

class SendContactEmail extends Mailable
{
    use Dispatchable, Queueable, SerializesModels;

    public $contact;

    /**
     * Crear una nueva instancia de mensaje.
     *
     * @param  \App\Models\Contact  $contact
     * @return void
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    /**
     * Construir el mensaje de correo.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Correo de Contacto')
                    ->view('emails.contact-email')
                    ->with([
                        'name' => $this->contact->name,
                        'email' => $this->contact->email,
                    ]);
    }
}
