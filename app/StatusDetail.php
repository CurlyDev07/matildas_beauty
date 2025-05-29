<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\StatusReason;
use App\FbAd;
use App\StatusDetail;

class StatusDetail extends Model
{
    protected $fillable = [
        'fb_ad_id',
        'status_reason_id',
        'previous_status',
        'new_status',
        'admin_name',
        'remarks'
    ];


    public function fbAd()
    {
        return $this->belongsTo(FbAd::class, 'fb_ad_id');
    }

    public function reason()
    {
        return $this->belongsTo(StatusReason::class, 'status_reason_id');
    }
    
}
