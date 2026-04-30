<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExportedDateToFbAdsMetricUploadsTable extends Migration
{
    public function up()
    {
        Schema::table('fb_ads_metric_uploads', function (Blueprint $table) {
            $table->date('exported_date')->nullable()->after('file_path');
        });
    }

    public function down()
    {
        Schema::table('fb_ads_metric_uploads', function (Blueprint $table) {
            $table->dropColumn('exported_date');
        });
    }
}

