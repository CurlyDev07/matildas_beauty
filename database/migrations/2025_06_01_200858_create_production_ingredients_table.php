<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductionIngredientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('production_ingredients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('production_id');
            $table->unsignedBigInteger('ingredient_id'); // <-- add this
            $table->string('product_name');
            $table->decimal('product_price_per_grams', 10, 2);
            $table->decimal('product_percentage', 10, 2);
            $table->decimal('grams', 10, 2);
            $table->decimal('price', 10, 2);
            $table->timestamps();

            $table->foreign('production_id')->references('id')->on('productions')->onDelete('cascade');
            $table->foreign('ingredient_id')->references('id')->on('ingredients')->onDelete('cascade'); // <-- add this
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('production_ingredients');
    }
}
