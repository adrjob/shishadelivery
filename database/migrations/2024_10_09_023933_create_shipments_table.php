<?php

// database/migrations/timestamp_create_shipments_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentsTable extends Migration
{
    public function up()
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade'); // Relacionamento com Orders
            $table->string('tracking_number')->nullable(); // Número de rastreamento
            $table->string('shipping_status')->default('Pedido Recebido'); // Status inicial
            $table->string('carrier')->nullable(); // Transportadora
            $table->date('shipping_date')->nullable(); // Data de envio
            $table->date('delivery_estimate')->nullable(); // Estimativa de entrega
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('shipments');
    }
}
