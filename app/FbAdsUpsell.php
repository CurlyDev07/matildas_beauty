<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FbAdsUpsell extends Model
{
    protected $table = 'fb_ads_upsell';

    protected $fillable = [
        'fb_ads_product_id',
        'fb_ads_id',
        'product_name', // Added here
        'amount'
    ];

    public function product()
    {
        return $this->belongsTo(FbAdsProduct::class, 'fb_ads_product_id');
    }

    public function fbAd()
    {
        // Assuming your main model is FbAd (singular) or FbAds (plural)
        return $this->belongsTo(FbAds::class, 'fb_ads_id');
    }
}