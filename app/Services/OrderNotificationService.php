<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use App\Mail\NewOrderEmail;
use App\Mail\OrderPlacedEmail;
use App\Mail\OrderAcceptedEmail;
use App\Mail\OrderDispatchedEmail;
use App\Mail\OrderDeliveredEmail;
use App\Mail\OrderRejectedEmail;
use App\Mail\OrderCanceledUserEmail;
use App\Mail\OrderCanceledAdminEmail;
use Exception;
use Log;

class OrderNotificationService
{
    public function sendOrderNotification($toEmail, $orderData, $notificationType)
    {
        try {
            switch ($notificationType) {
                case 'admin_order':
                    Mail::to($toEmail)->send(new NewOrderEmail($orderData));
                    break;
                case 'user_order_placed':
                    Mail::to($toEmail)->send(new OrderPlacedEmail($orderData));
                    break;
                case 'user_order_accepted':
                    Mail::to($toEmail)->send(new OrderAcceptedEmail($orderData));
                    break;
                case 'user_order_dispatched':
                    Mail::to($toEmail)->send(new OrderDispatchedEmail($orderData));
                    break;
                case 'user_order_delivered':
                    Mail::to($toEmail)->send(new OrderDeliveredEmail($orderData));
                    break;
                case 'user_order_rejected':
                    Mail::to($toEmail)->send(new OrderRejectedEmail($orderData));
                    break;
                case 'user_order_canceled':
                    Mail::to($toEmail)->send(new OrderCanceledUserEmail($orderData));
                    break;
                case 'admin_order_canceled':
                    Mail::to($toEmail)->send(new OrderCanceledAdminEmail($orderData));
                    break;
                default:
                    throw new Exception("Invalid notification type.");
            }
            Log::info("Email for $notificationType sent to $toEmail successfully.");
        } catch (Exception $e) {
            Log::error("Failed to send $notificationType email: " . $e->getMessage());
        }
    }
}
