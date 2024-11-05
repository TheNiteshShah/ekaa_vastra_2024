<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewOrderEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $orderData;
    public $orderDetails;

    public function __construct($orderData, $orderDetails)
    {
        $this->orderData = $orderData;
        $this->orderDetails = $orderDetails;
    }

    public function build()
    {
        return $this->subject('New Order Received')
            ->view('emails.newOrder'); // Blade file to use
    }
}
