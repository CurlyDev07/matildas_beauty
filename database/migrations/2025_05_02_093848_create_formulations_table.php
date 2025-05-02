<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormulationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formulations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('model');
            $table->string('product_name');
            $table->decimal('batch', 10, 2)->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('ph', 5, 2)->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('formulations');
    }
}
