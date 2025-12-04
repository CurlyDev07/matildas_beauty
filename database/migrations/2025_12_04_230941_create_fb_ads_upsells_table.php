<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFbAdsUpsellsTable extends Migration
{
    public function up()
    {
        Schema::create('fb_ads_upsell', function (Blueprint $table) {
            $table->bigIncrements('id');

            // 1. Link to the Product definition
            $table->unsignedBigInteger('fb_ads_product_id');

            // 2. Link to the Main Ad/Order (Table: fb_ads)
            $table->unsignedBigInteger('fb_ads_id');

            // 3. Product Name (Snapshot)
            $table->string('product_name');

            $table->decimal('amount', 10, 2);
            $table->timestamps();

            // Constraints
            $table->foreign('fb_ads_product_id')
                ->references('id')
                ->on('fb_ads_product')
                ->onDelete('cascade');

            $table->foreign('fb_ads_id')
                ->references('id')
                ->on('fb_ads') 
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('fb_ads_upsell');
    }
}