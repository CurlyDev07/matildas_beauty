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
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->integer('sf')->nullable();
            $table->integer('total')->nullable();
            $table->date('purchase_date')->nullable()->comment('date of purchase');
            $table->date('review_date')->nullable()->comment('date of review');
            $table->string('status')->nullable()->comment('Shipping | Done');
            $table->string('notes')->nullable();
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
