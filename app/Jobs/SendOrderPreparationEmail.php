<?php

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderPrepared;

class SendOrderPreparationEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function handle()
    {
        try {
            Mail::to($this->order->billing_email)->send(new OrderPrepared($this->order));
            \Log::info("Email de preparação de pedido enviado para {$this->order->billing_email}");
        } catch (\Exception $e) {
            \Log::error("Falha ao enviar email de preparação de pedido: {$e->getMessage()}");
        }
    }
}
