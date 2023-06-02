<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('supplier')->nullable();
            $table->integer('total_qty')->nullable();
            $table->integer('total_price')->nullable();
            $table->integer('shipping_fee')->nullable();
            $table->integer('transaction_fee')->nullable();
            $table->integer('tax')->nullable();
            $table->string('status')->default('OTW')->comments('VALUES: OTW|INCOMPLETE|COMPLETED');
            $table->date('date')->comment('date of purchase');
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
        Schema::dropIfExists('purchases');
    }
}
