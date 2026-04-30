<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFbAdsMetricsTable extends Migration
{
    public function up()
    {
        Schema::create('fb_ads_metrics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('upload_id')->index();

            $table->date('reporting_starts')->nullable();
            $table->date('reporting_ends')->nullable();
            $table->string('ad_name')->nullable();
            $table->date('date_created')->nullable();
            $table->date('date_last_edited')->nullable();
            $table->string('last_significant_edit')->nullable();
            $table->string('campaign_name')->nullable();
            $table->string('campaign_id')->nullable();
            $table->string('ad_set_name')->nullable();
            $table->string('ad_set_id')->nullable();
            $table->string('ad_id')->nullable();
            $table->string('ad_delivery')->nullable();
            $table->string('ad_set_delivery')->nullable();
            $table->string('attribution_setting')->nullable();

            $table->decimal('amount_spent_php', 15, 2)->nullable();
            $table->unsignedBigInteger('reach')->nullable();
            $table->unsignedBigInteger('impressions')->nullable();
            $table->decimal('frequency', 12, 4)->nullable();
            $table->decimal('cpm_php', 15, 4)->nullable();
            $table->unsignedBigInteger('clicks_all')->nullable();
            $table->decimal('ctr_all', 12, 4)->nullable();
            $table->decimal('cpc_all_php', 15, 4)->nullable();
            $table->unsignedBigInteger('link_clicks')->nullable();
            $table->decimal('ctr_link_click_through_rate', 12, 4)->nullable();
            $table->decimal('cpc_cost_per_link_click_php', 15, 4)->nullable();
            $table->unsignedBigInteger('landing_page_views')->nullable();
            $table->decimal('cost_per_landing_page_view_php', 15, 4)->nullable();
            $table->decimal('landing_page_views_rate_per_link_clicks', 12, 4)->nullable();
            $table->unsignedBigInteger('content_views')->nullable();
            $table->decimal('content_views_conversion_value', 15, 2)->nullable();
            $table->unsignedBigInteger('adds_to_cart')->nullable();
            $table->decimal('cost_per_add_to_cart_php', 15, 4)->nullable();
            $table->decimal('initiate_check_out_rate', 12, 4)->nullable();
            $table->unsignedBigInteger('purchases')->nullable();
            $table->decimal('cost_per_purchase_php', 15, 4)->nullable();
            $table->decimal('purchases_conversion_value', 15, 2)->nullable();
            $table->decimal('purchase_roas_return_on_ad_spend', 12, 4)->nullable();
            $table->unsignedBigInteger('three_second_video_plays')->nullable();
            $table->decimal('three_second_video_plays_rate_per_impressions', 12, 4)->nullable();
            $table->decimal('cost_per_three_second_video_play_php', 15, 4)->nullable();
            $table->unsignedBigInteger('thruplays')->nullable();
            $table->decimal('cost_per_thruplay_php', 15, 4)->nullable();
            $table->unsignedBigInteger('video_plays_at_25')->nullable();
            $table->unsignedBigInteger('video_plays_at_50')->nullable();
            $table->unsignedBigInteger('video_plays_at_95')->nullable();
            $table->unsignedBigInteger('video_plays_at_75')->nullable();
            $table->unsignedBigInteger('video_plays_at_100')->nullable();
            $table->unsignedBigInteger('video_plays')->nullable();
            $table->decimal('video_average_play_time', 12, 4)->nullable();
            $table->unsignedBigInteger('post_engagements')->nullable();
            $table->decimal('cost_per_post_engagement_php', 15, 4)->nullable();
            $table->unsignedBigInteger('post_reactions')->nullable();
            $table->unsignedBigInteger('post_comments')->nullable();
            $table->unsignedBigInteger('post_saves')->nullable();
            $table->unsignedBigInteger('post_shares')->nullable();
            $table->string('quality_ranking')->nullable();
            $table->string('engagement_rate_ranking')->nullable();
            $table->string('conversion_rate_ranking')->nullable();
            $table->decimal('hook_rate', 12, 4)->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fb_ads_metrics');
    }
}

