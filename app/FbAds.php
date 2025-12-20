<?php

namespace App;
use App\StatusDetail;
use Illuminate\Database\Eloquent\Model;

class FbAds extends Model
{
    protected $guarded = [];

    public function statusDetail()
    {
        return $this->hasOne(StatusDetail::class, 'fb_ad_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // In app/FbAds.php

    public function upsells()
    {
        // This assumes your Upsell model is 'App\FbAdsUpsell' 
        // and the foreign key is 'fb_ads_id'
        return $this->hasMany(\App\FbAdsUpsell::class, 'fb_ads_id');
    }


    public function source()
    {
        return $this->belongsTo(\App\OrderSource::class, 'source_id', 'id');
    }
}
