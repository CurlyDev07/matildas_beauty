<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSummaryFieldsToFbAdsMetricUploadsTable extends Migration
{
    public function up()
    {
        Schema::table('fb_ads_metric_uploads', function (Blueprint $table) {
            if (!Schema::hasColumn('fb_ads_metric_uploads', 'summary_ad_spend')) {
                $table->decimal('summary_ad_spend', 15, 2)->nullable()->after('rows_imported');
            }
            if (!Schema::hasColumn('fb_ads_metric_uploads', 'summary_roas')) {
                $table->decimal('summary_roas', 12, 4)->nullable()->after('summary_ad_spend');
            }
        });
    }

    public function down()
    {
        Schema::table('fb_ads_metric_uploads', function (Blueprint $table) {
            foreach (['summary_ad_spend', 'summary_roas'] as $col) {
                if (Schema::hasColumn('fb_ads_metric_uploads', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
}

