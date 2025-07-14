<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MetaCreativeMetric extends Model
{
    protected $fillable = [
        'reporting_start',
        'reporting_end',
        'ad_name',
        'campaign_name',
        'ad_set_name',
        'ad_set_budget',
        'ad_set_budget_type',
        'amount_spent',
        'purchases',
        'purchases_conversion_value',
        'cost_per_purchase',
        'purchase_roas',
        'impressions',
        'reach',
        'frequency',
        'ctr_all',
        'ctr_link_click',
        'outbound_clicks',
        'landing_page_views',
        'video_plays_3s',
        'video_thruplays',
        'cost_per_thruplay',
        'video_plays_25',
        'video_plays_50',
        'video_plays_75',
        'video_avg_play_time',
        'cpm',
        'quality_ranking',
        'engagement_rate_ranking',
        'conversion_rate_ranking',
        'adds_to_cart',
        'adds_to_cart_conversion_value',
        'cost_per_add_to_cart',
        'checkouts_initiated',
        'checkouts_initiated_conversion_value',
        'cost_per_checkout_initiated',
        'profit',
        'conversion_rate',
        'view_rate_25',
        'retention_50_from_25',
        'retention_75_from_50',
        'link_clicks',
        'cpc',
        'cost_per_landing_page_view',
        'hold_rate',
    ];
}
