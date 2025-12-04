<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FbAdsProduct extends Model
{
    // Explicitly define table since it is singular in your request
    protected $table = 'fb_ads_product';

    protected $fillable = [
        'sku',
        'price',
        'slashed_price',
        'image1',
        'image2',
        'image3',
        'image4',
        'image5',
        'discount_tag',
        'product_name',
        'description',
        'promo_line1',
        'promo_line2',
        'promo_line3',
        'scarcity_text',
    ];
}