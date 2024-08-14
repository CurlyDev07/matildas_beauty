<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_id')->index()->nullable();
            $table->string('purchase_id')->index()->nullable();
            $table->string('price')->nullable();
            $table->integer('qty')->nullable();
            $table->integer('sub_total')->nullable();
            $table->string('received')->default('no')->comment('is product received or not? yes | no | incomplete');
            $table->integer('received_qty')->nullable()->comment('The Received Quantity');
            $table->string('stock_in')->default('no')->comment('Values: yes | no | partial');
            $table->date('expiration_date')->nullable();
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
        Schema::dropIfExists('purchase_products');
    }
}
