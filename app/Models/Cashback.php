<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cashback extends Model
{
    use HasFactory;

    // Definir os campos que podem ser atribuídos em massa
    protected $fillable = [
        'order_id',
        'trx_wallet',
        'status',
    ];

    // Relacionamento com a ordem
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
