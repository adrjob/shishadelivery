<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderDelivered extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function build()
    {
        return $this->subject('Your Order Has Been Delivered')
            ->view('emails.order-status', [
                'order' => $this->order,
                'isDeliverd' => true,
                // 'title' => 'Order Delivered',
                // 'message' => 'Good news! Your order has been delivered successfully.',
                // 'additionalMessage' => 'Thank you for choosing us!'
            ]);
    }
}
