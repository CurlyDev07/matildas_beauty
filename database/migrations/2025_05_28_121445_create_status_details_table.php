<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('fb_ad_id');
            $table->unsignedBigInteger('status_reason_id');
            $table->string('previous_status');
            $table->string('new_status');
            $table->string('admin_name');
            $table->text('remarks')->nullable();
            $table->timestamps();

            $table->foreign('fb_ad_id')->references('id')->on('fb_ads')->onDelete('cascade');
            $table->foreign('status_reason_id')->references('id')->on('status_reasons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('status_details');
    }
}
