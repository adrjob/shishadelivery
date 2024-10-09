<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOrdersTableAddBillingFields extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'billing_address_1')) {
                $table->string('billing_address_1')->nullable();
            }
            if (!Schema::hasColumn('orders', 'billing_address_2')) {
                $table->string('billing_address_2')->nullable();
            }
            if (!Schema::hasColumn('orders', 'billing_city')) {
                $table->string('billing_city')->nullable();
            }
            if (!Schema::hasColumn('orders', 'billing_state')) {
                $table->string('billing_state')->nullable();
            }
            if (!Schema::hasColumn('orders', 'billing_postcode')) {
                $table->string('billing_postcode')->nullable();
            }
            if (!Schema::hasColumn('orders', 'billing_country')) {
                $table->string('billing_country')->nullable();
            }
            if (!Schema::hasColumn('orders', 'billing_email')) {
                $table->string('billing_email')->nullable();
            }
            if (!Schema::hasColumn('orders', 'billing_phone')) {
                $table->string('billing_phone')->nullable();
            }
            if (!Schema::hasColumn('orders', 'payment_method')) {
                $table->string('payment_method')->nullable();
            }
            if (!Schema::hasColumn('orders', 'payment_method_title')) {
                $table->string('payment_method_title')->nullable();
            }
            if (!Schema::hasColumn('orders', 'date_created')) {
                $table->timestamp('date_created')->nullable();
            }
            if (!Schema::hasColumn('orders', 'date_modified')) {
                $table->timestamp('date_modified')->nullable();
            }
            if (!Schema::hasColumn('orders', 'date_completed')) {
                $table->timestamp('date_completed')->nullable();
            }
            if (!Schema::hasColumn('orders', 'date_paid')) {
                $table->timestamp('date_paid')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'billing_address_1',
                'billing_address_2',
                'billing_city',
                'billing_state',
                'billing_postcode',
                'billing_country',
                'billing_email',
                'billing_phone',
                'payment_method',
                'payment_method_title',
                'date_created',
                'date_modified',
                'date_completed',
                'date_paid',
            ]);
        });
    }
}
