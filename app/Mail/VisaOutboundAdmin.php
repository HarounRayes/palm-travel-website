<?php

namespace App\Mail;

use App\VisaOutboundApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VisaOutboundAdmin extends Mailable
{
    use Queueable, SerializesModels;

    protected $application;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(VisaOutboundApplication $application)
    {
        $this->application = $application;
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
            ->view('emails.outboundApplicationAdmin')
            ->with(['application' => $this->application]);
    }
}
