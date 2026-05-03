<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFormatColumnsToFbAdsMetricsTable extends Migration
{
    public function up()
    {
        Schema::table('fb_ads_metrics', function (Blueprint $table) {
            if (!Schema::hasColumn('fb_ads_metrics', 'profit')) {
                $table->decimal('profit', 15, 2)->nullable()->after('amount_spent_php');
            }
            if (!Schema::hasColumn('fb_ads_metrics', 'aov_average_order_value')) {
                $table->decimal('aov_average_order_value', 15, 2)->nullable()->after('cost_per_purchase_php');
            }
            if (!Schema::hasColumn('fb_ads_metrics', 'conversion_rate_percent')) {
                $table->decimal('conversion_rate_percent', 12, 4)->nullable()->after('aov_average_order_value');
            }
            if (!Schema::hasColumn('fb_ads_metrics', 'vat')) {
                $table->decimal('vat', 15, 2)->nullable()->after('purchases_conversion_value');
            }
        });
    }

    public function down()
    {
        Schema::table('fb_ads_metrics', function (Blueprint $table) {
            foreach (['profit', 'aov_average_order_value', 'conversion_rate_percent', 'vat'] as $col) {
                if (Schema::hasColumn('fb_ads_metrics', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
}

