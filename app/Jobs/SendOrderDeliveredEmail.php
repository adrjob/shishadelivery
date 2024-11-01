<?php

namespace App\Jobs;

use App\Mail\OrderDelivered;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendOrderDeliveredEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function handle()
    {
        // Verifica se o e-mail está presente antes de enviar
        if (!empty($this->order->billing_email)) {
            \Log::info("Enviando e-mail de entrega para: " . $this->order->billing_email);

            // Mensagem de e-mail
            $messageContent = "Sua encomenda foi entregue com sucesso!";

            Mail::raw($messageContent, function ($message) {
                $message->to($this->order->billing_email) // Endereço do destinatário
                    ->subject('Seu Pedido Foi Entregue') // Assunto do e-mail
                    ->from('store@shishacoin.io', 'Shisha Coin'); // Endereço e nome do remetente
            });
        } else {
            \Log::error("Não foi possível enviar o e-mail de entrega para o pedido {$this->order->id}: endereço de e-mail vazio.");
        }
    }

}
