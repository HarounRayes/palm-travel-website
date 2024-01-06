<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserContact extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function
    __construct()
    {
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from(config("mail.from")["address"],config("mail.from")["name"])
            ->subject('Contact Message From Palmoasis Website')
            ->view('emails.user-contact');
    }
}
