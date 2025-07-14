<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetaCampaignMetricsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meta_campaign_metrics', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->date('reporting_start')->nullable();
            $table->date('reporting_end')->nullable();
            $table->string('campaign_name')->nullable();
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
            $table->decimal('ctr', 6, 3)->nullable();
            $table->decimal('cpm', 12, 2)->nullable();
            $table->bigInteger('clicks')->nullable();
            $table->decimal('cost_per_click', 12, 2)->nullable();
            $table->bigInteger('landing_page_views')->nullable();
            $table->decimal('cost_per_lp_view', 12, 2)->nullable();

            $table->bigInteger('adds_to_cart')->nullable();
            $table->decimal('adds_to_cart_conversion_value', 12, 2)->nullable();
            $table->decimal('cost_per_add_to_cart', 12, 2)->nullable();

            $table->bigInteger('checkouts_initiated')->nullable();
            $table->decimal('checkouts_conversion_value', 12, 2)->nullable();
            $table->decimal('cost_per_checkout', 12, 2)->nullable();

            $table->decimal('profit', 12, 2)->nullable();
            $table->decimal('conversion_rate', 8, 5)->nullable();
            $table->decimal('view_rate_25', 8, 5)->nullable();
            $table->decimal('retention_50_from_25', 8, 5)->nullable();
            $table->decimal('retention_75_from_50', 8, 5)->nullable();

            $table->timestamps();

            // ✅ Unique constraint to prevent duplicates
            $table->unique(
                ['reporting_start', 'reporting_end', 'campaign_name'],
                'unique_campaign_per_day'
            );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meta_campaign_metrics');
    }
}
