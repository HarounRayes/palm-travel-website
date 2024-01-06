<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Enquiry extends Mailable
{
    use Queueable, SerializesModels;

    protected $enquiry;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(\App\Enquiry $Enquiry)
    {
        $this->enquiry = $Enquiry;
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
            ->subject('New Enquiry [Holiday Package]')
            ->view('emails.enquiry')
            ->with(['enquiry' => $this->enquiry]);
    }
}
