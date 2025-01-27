<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LoginOtpEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;  // Variable to store OTP

    public function __construct($otp)
    {
        $this->otp = $otp;  // Assign the OTP to the public variable
    }

    public function build()
    {
        return $this->subject('Your OTP for Login')
                    ->view('emails.LoginOtp');  // Use the Blade template for OTP
    }
}
