<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderColumnToFbAdsProductTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('fb_ads_product', function (Blueprint $table) {
            $table->integer('order')->default(0)->after('sku');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('fb_ads_product', function (Blueprint $table) {
            $table->dropColumn('order');
        });
    }
}