<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormulationIngredientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formulation_ingredients', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->unsignedBigInteger('formulation_id');
            $table->foreign('formulation_id')->references('id')->on('formulations')->onDelete('cascade');
        
            $table->unsignedBigInteger('ingredient_id');
            $table->foreign('ingredient_id')->references('id')->on('ingredients')->onDelete('cascade');

            $table->string('phase')->nullable();
            $table->text('phase_note')->nullable();
            $table->string('bg_color')->nullable(); // e.g. "#FFCC00" or phase label
            $table->decimal('percentage', 6, 3)->nullable(); // e.g. 0.123
            $table->decimal('grams', 10, 2)->nullable();
            $table->decimal('price', 10, 2)->nullable();
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
        Schema::dropIfExists('formulation_ingredients');
    }
}
