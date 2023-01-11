<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRtsProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rts_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('rts_id')->index();
            $table->integer('product_id')->index();
            $table->integer('capital')->nullable()->comment('puhunan');
            $table->integer('selling_price')->nullable();
            $table->integer('potential_profit')->nullable()->comment('capital - selling_price');
            $table->string('condition')->comment('good/damaged');
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
        Schema::dropIfExists('rts_products');
    }
}
