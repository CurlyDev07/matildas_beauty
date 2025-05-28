<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFbAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fb_ads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product');
            $table->string('promo');
            $table->integer('total');
            $table->string('full_name');
            $table->string('phone_number');
            $table->string('address')->comment('Street Name/Building/House No./Subdv.');
            $table->text('province');
            $table->string('city');
            $table->string('barangay');
            $table->string('status')->default('TO ENCODE')->comment('TO ENCODE | TO CALL | TO SHIP | SHIPPED | DUPPLICATE | DELIVERED');
            $table->string('status_id');
            $table->integer('modification_id');
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
        Schema::dropIfExists('fb_ads');
    }
}
