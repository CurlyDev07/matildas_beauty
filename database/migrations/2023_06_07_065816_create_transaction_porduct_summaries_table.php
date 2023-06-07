<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionPorductSummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_porduct_summaries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('transaction_id')->index()->nullable();
            $table->integer('product_id')->index()->nullable();
            $table->integer('qty')->nullable();
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
        Schema::dropIfExists('transaction_porduct_summaries');
    }
}
