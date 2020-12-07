<?php

namespace App\Mail;
use App\UserInfo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewUser extends Mailable
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
        return $this->markdown('emails.newuser')->subject("Nuovo utente registrato");;
    }
}
