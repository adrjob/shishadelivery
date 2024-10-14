<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('cashbacks', function (Blueprint $table) {
            $table->decimal('coin_amount', 8, 2)->nullable()->change();  // Permite valores nulos para coin_amount
        });
    }

    public function down()
    {
        Schema::table('cashbacks', function (Blueprint $table) {
            $table->decimal('coin_amount', 8, 2)->nullable(false)->change();  // Reverte a coluna para NOT NULL
        });
    }

};
