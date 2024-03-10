<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserEnquiry extends Mailable
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
            ->view('emails.user-enquiry')
            ->subject('Palm Oasis Travel | Your Holiday Package Enquiry '.$this->enquiry->package->packageCountry->name_en)
            ->with(['enquiry' => $this->enquiry]);
    }
}
