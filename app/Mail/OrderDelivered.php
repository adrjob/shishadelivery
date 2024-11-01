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
        $fromAddress = env('MAIL_FROM_ADDRESS');
        \Log::info('Enviando e-mail de: ' . $fromAddress);

        return $this->from($fromAddress) // Use isto para forçar o uso do .env
            ->subject('Your Order Has Been Delivered')
            ->view('emails.order-status', [
                'order' => $this->order,
                'isDelivered' => true,
            ]);
    }

}
