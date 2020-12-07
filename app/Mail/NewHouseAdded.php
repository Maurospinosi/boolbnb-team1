<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewHouseAdded extends Mailable
{
    use Queueable, SerializesModels;

    public $dati;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dati)
    {
        $this->dati = $dati;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.newhouseadded')->subject("Nuova casa aggiunta");
    }
}
