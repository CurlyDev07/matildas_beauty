<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('transaction_id')->index();
            $table->string('payment_id')->index();
            $table->string('payer_id')->nullable();
            $table->string('payer_email')->nullable();
            $table->float('shipping_fee', 10, 2)->nullable();
            $table->float('subtotal', 10, 2)->nullable();
            $table->float('total', 10, 2)->nullable();
            $table->string('currency')->nullable();
            $table->string('payment_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_payments');
    }
}
