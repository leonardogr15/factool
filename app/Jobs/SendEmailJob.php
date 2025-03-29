<?php

namespace App\Jobs;

use App\Mail\SendContactEmail;
use App\Models\Contact;
use Illuminate\Bus\Dispatchable;
use Illuminate\Foundation\Bus\Dispatchable as BusDispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJob extends Job
{
    use Dispatchable, SerializesModels;

    protected $contact;

    /**
     * Create a new job instance.
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
        // Usamos el modelo de contacto para enviar el correo
        Mail::to($this->contact->email)->send(new SendContactEmail($this->contact));
    }
}
