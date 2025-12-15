<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSourceIdToFbAdsTable extends Migration
{
    public function up()
    {
        Schema::table('fb_ads', function (Blueprint $table) {
            $table->unsignedInteger('source_id')->nullable()->after('user_id');
            $table->index('source_id');
        });
    }

    public function down()
    {
        Schema::table('fb_ads', function (Blueprint $table) {
            $table->dropIndex(['source_id']);
            $table->dropColumn('source_id');
        });
    }
}