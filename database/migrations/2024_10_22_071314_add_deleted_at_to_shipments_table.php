<?php

// database/migrations/xxxx_xx_xx_xxxxxx_add_deleted_at_to_shipments_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeletedAtToShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shipments', function (Blueprint $table) {
            $table->softDeletes();  // Adiciona a coluna `deleted_at`
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shipments', function (Blueprint $table) {
            $table->dropSoftDeletes();  // Remove a coluna `deleted_at` caso a migração seja revertida
        });
    }
}
