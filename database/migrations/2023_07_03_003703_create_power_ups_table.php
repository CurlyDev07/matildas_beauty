<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePowerUpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('power_ups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id')->index();
            $table->string('store_id')->index();
            $table->string('phone');
            $table->string('email');
            $table->string('password');
            $table->integer('sf');
            $table->integer('total');
            $table->date('purchase_date')->comment('date of purchase');
            $table->date('review_date')->comment('date of review');
            $table->string('status');
            $table->string('notes');
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
        Schema::dropIfExists('power_ups');
    }
}
