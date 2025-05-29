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
}
