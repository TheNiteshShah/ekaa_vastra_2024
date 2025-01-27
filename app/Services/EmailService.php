<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use App\Mail\LoginOtpEmail;
use Exception;
use Log;

class EmailService
{
    public function sendEmail($toEmail, $data, $notificationType)
    {
        try {
            switch ($notificationType) {
                case 'login':
                    // Send the OTP email
                    Mail::to($toEmail)->send(new LoginOtpEmail($data));
                    break;

                default:
                    // Handle invalid notification type
                    throw new Exception("Invalid notification type.");
            }

            // Log success and return true
            Log::info("Email for $notificationType sent to $toEmail successfully.");
            return true;
        } catch (Exception $e) {
            // Log failure and return false
            Log::error("Failed to send $notificationType email: " . $e->getMessage());
            return false;
        }
    }
}
