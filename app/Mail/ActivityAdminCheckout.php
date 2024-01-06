<?php

namespace App\Mail;

use App\ActivityOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActivityAdminCheckout extends Mailable
{
    use Queueable, SerializesModels;

    protected $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ActivityOrder $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from(config("mail.from")["address"], config("mail.from")["name"])
            ->view('emails.order-activity-checkout')
            ->subject('Booking Confirmation: Activity ('.$this->order->code.')')
            ->with(['order' => $this->order]);
    }
}
