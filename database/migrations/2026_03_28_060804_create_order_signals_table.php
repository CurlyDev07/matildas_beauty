<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderSignalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_signals', function (Blueprint $table) {

            $table->bigIncrements('id');

            // link to fb_ads (optional)
            $table->unsignedBigInteger('fb_ads_id')->nullable();

            // tracking
            $table->string('website')->nullable();
            $table->string('session_id')->nullable();
            $table->string('local_session_id')->nullable();
            $table->text('fingerprint')->nullable();

            // identity
            $table->string('full_name')->nullable();
            $table->string('phone_number')->nullable();

            // promo
            $table->string('promo')->nullable();

            // traffic
            $table->text('fbclid')->nullable();
            $table->string('utm_campaign')->nullable();
            $table->string('utm_content')->nullable();
            $table->string('utm_medium')->nullable();

            // device
            $table->string('device_type')->nullable();
            $table->text('user_agent')->nullable();

            // meta
            $table->bigInteger('timestamp')->nullable();

            $table->timestamps();

            // indexes
            $table->index('session_id');
            $table->index('phone_number');
            $table->index('promo');
            $table->string('ip_address')->nullable();
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_signals');
    }
}
