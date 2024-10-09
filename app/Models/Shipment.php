<?php

// app/Models/Shipment.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $fillable = [
        'order_id',
        'tracking_number',
        'shipping_status',
        'carrier',
        'shipping_date',
        'delivery_estimate',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class); // Um envio pertence a um pedido
    }
}
