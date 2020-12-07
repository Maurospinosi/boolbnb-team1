<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\User;
use App\Message;

class SendNewMail extends Mailable
{
    use Queueable, SerializesModels;

    public $host_name;
    public $guest_name;
    public $house_id;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($host_name, $guest_name, $house_id)
    {
        $this->host_name = $host_name;
        $this->guest_name = $guest_name;
        $this->house_id = $house_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('guest.mail.message_sent');
    }
}