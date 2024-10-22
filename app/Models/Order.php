<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'order_id',
        'customer_name',
        'total',
        'status',
        'billing_email',
        'billing_phone',
        'billing_address_1',
        'billing_address_2',
        'billing_city',
        'billing_state',
        'billing_postcode',
        'billing_country',
        'payment_method_title',
        'date_paid',
        'date_created',
        'date_modified',
        'date_completed',
        'trx_wallet',
        'client_id'  // Chave estrangeira para Client
        // Adicionar mais campos conforme necessário
    ];

    // Relacionamento com os itens do pedido
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Relacionamento com o envio (shipment)
    public function shipment()
    {
        return $this->hasOne(Shipment::class); // Um pedido tem um envio
    }

    // Relacionamento com o cashback
    public function cashback()
    {
        return $this->hasOne(Cashback::class);
    }

    // Relacionamento com o cliente
    public function client()
    {
        return $this->belongsTo(Client::class); // Um pedido pertence a um cliente
    }

    // Order.php (modelo)
    protected static function boot()
    {
        parent::boot();

        // Deletar o Shipment associado quando uma Order é deletada
        static::deleting(function ($order) {
            if ($order->shipment) {
                $order->shipment->delete();
            }
        });

        // Restaurar o Shipment associado quando a Order é restaurada
        static::restoring(function ($order) {
            if ($order->shipment()->withTrashed()->exists()) {
                $order->shipment()->restore();
            }
        });
    }

}
