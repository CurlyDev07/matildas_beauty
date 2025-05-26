<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabPurchaseIngredientsTable  extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('lab_purchase_ingredients', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('lab_purchase_id');
            $table->unsignedBigInteger('ingredient_id');
            
            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('weight', 10, 2)->nullable();
            $table->integer('qty')->nullable();
            $table->decimal('sub_total', 10, 2)->nullable();
            $table->timestamps();

            $table->foreign('lab_purchase_id')->references('id')->on('lab_purchases')->onDelete('cascade');
            $table->foreign('ingredient_id')->references('id')->on('ingredients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lab_purchase_ingredients');
    }
}
