<?php

namespace App\Mail;

use App\VisaOutboundApplication;
use App\VisaUaeApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VisaUaeMember extends Mailable
{
    use Queueable, SerializesModels;

    protected $application;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(VisaUaeApplication $application)
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
            ->from(env('MAIL_FROM_ADDRESS') ,env('MAIL_FROM_NAME'))
            ->view('emails.user-uae-application')
            ->subject('Palm Oasis Travel | UAE Visa Enquiry ('.$this->application->reference_id . ')')
            ->with(['application' => $this->application]);
    }
}
