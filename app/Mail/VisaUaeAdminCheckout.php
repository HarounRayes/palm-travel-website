<?php

namespace App\Mail;

use App\VisaUaeApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VisaUaeAdminCheckout extends Mailable
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
        $message = $this
            ->from(config("mail.from")["address"], config("mail.from")["name"])
            ->view('emails.uae-application-checkout')
            ->subject('Booking Confirmation: UAE Visa (' . $this->application->reference_id . ')')
            ->with(['application' => $this->application]);

        foreach ($this->application->people as $person) {
            foreach ($this->application->visa->requirements_documents as $file) {
                $message->attach(storage_path('app/public/files/' . $person->value($file->requirement->id)), [
                    'as' => $person->firstName()->value . '-' . $person->lastName()->value . '-' . $file->requirement->name_en
                ]);
            }
        }
        return $message;
    }
}
