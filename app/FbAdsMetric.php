<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FbAdsMetric extends Model
{
    protected $guarded = [];

    public function upload()
    {
        return $this->belongsTo(FbAdsMetricUpload::class, 'upload_id');
    }
}

