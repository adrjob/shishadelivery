<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function build()
    {
        // dd($this->order);
        return $this->subject('Your Order is On the Way')
            ->view('emails.order-status', [
                'order' => $this->order,
                'isDeliverd' => false,
                
            ]);
    }

}
