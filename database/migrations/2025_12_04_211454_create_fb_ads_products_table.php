<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFbAdsProductsTable extends Migration
{
    public function up()
    {
        Schema::create('fb_ads_product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sku')->unique();
            $table->string('product_name');
            $table->decimal('price', 10, 2);
            $table->decimal('slashed_price', 10, 2)->nullable();
            
            // Images
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
            $table->string('image4')->nullable();
            $table->string('image5')->nullable();
            
            // Marketing Details
            $table->string('discount_tag')->nullable();
            $table->text('description')->nullable();
            $table->string('promo_line1')->nullable();
            $table->string('promo_line2')->nullable();
            $table->string('promo_line3')->nullable();
            $table->string('scarcity_text')->nullable(); // e.g., "Only 3 left!"
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fb_ads_product');
    }
}