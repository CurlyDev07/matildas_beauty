<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreMetricsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_metrics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('store_id')->index();
            $table->integer('sales');
            $table->integer('orders');
            $table->double('conversion_rate', 8, 2);
            $table->integer('visitors');
            $table->date('date')->comment('date of metrics');
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
        Schema::dropIfExists('store_metrics');
    }
}
