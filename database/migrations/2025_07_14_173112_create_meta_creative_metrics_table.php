<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetaCreativeMetricsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meta_creative_metrics', function (Blueprint $table) {
            
             $table->bigIncrements('id');

            $table->date('reporting_start')->nullable();
            $table->date('reporting_end')->nullable();

            $table->string('ad_name')->nullable();
            $table->string('campaign_name')->nullable();
            $table->string('ad_set_name')->nullable();
            $table->string('ad_set_budget')->nullable();
            $table->string('ad_set_budget_type')->nullable();

            $table->decimal('amount_spent', 12, 2)->nullable();
            $table->integer('purchases')->nullable();
            $table->decimal('purchases_conversion_value', 12, 2)->nullable();
            $table->decimal('cost_per_purchase', 12, 2)->nullable();
            $table->decimal('purchase_roas', 6, 3)->nullable();

            $table->bigInteger('impressions')->nullable();
            $table->bigInteger('reach')->nullable();
            $table->decimal('frequency', 6, 3)->nullable();

            $table->decimal('ctr_all', 6, 3)->nullable();
            $table->decimal('ctr_link_click', 6, 3)->nullable();
            $table->bigInteger('outbound_clicks')->nullable();
            $table->bigInteger('landing_page_views')->nullable();
            $table->bigInteger('video_plays_3s')->nullable();
            $table->bigInteger('video_thruplays')->nullable();
            $table->decimal('cost_per_thruplay', 12, 2)->nullable();

            $table->bigInteger('video_plays_25')->nullable();
            $table->bigInteger('video_plays_50')->nullable();
            $table->bigInteger('video_plays_75')->nullable();
            $table->string('video_avg_play_time')->nullable();

            $table->decimal('cpm', 12, 2)->nullable();
            $table->string('quality_ranking')->nullable();
            $table->string('engagement_rate_ranking')->nullable();
            $table->string('conversion_rate_ranking')->nullable();

            $table->bigInteger('adds_to_cart')->nullable();
            $table->decimal('adds_to_cart_conversion_value', 12, 2)->nullable();
            $table->decimal('cost_per_add_to_cart', 12, 2)->nullable();

            $table->bigInteger('checkouts_initiated')->nullable();
            $table->decimal('checkouts_initiated_conversion_value', 12, 2)->nullable();
            $table->decimal('cost_per_checkout_initiated', 12, 2)->nullable();

            $table->decimal('profit', 12, 2)->nullable();
            $table->decimal('conversion_rate', 8, 5)->nullable();
            $table->decimal('view_rate_25', 8, 5)->nullable();
            $table->decimal('retention_50_from_25', 8, 5)->nullable();
            $table->decimal('retention_75_from_50', 8, 5)->nullable();

            $table->bigInteger('link_clicks')->nullable();
            $table->decimal('cpc', 12, 2)->nullable();
            $table->decimal('cost_per_landing_page_view', 12, 2)->nullable();
            $table->decimal('hold_rate', 8, 5)->nullable();

            $table->timestamps();

            $table->unique(['reporting_start', 'reporting_end', 'ad_name'], 'unique_ad_day');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meta_creative_metrics');
    }
}
