<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderSignalBlockListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_signal_block_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fingerprintjs_visitor_id')->index();
            $table->bigInteger('timestamp')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_signal_block_lists');
    }
}

