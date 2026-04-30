<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FbAdsMetricUpload extends Model
{
    protected $guarded = [];

    public function metrics()
    {
        return $this->hasMany(FbAdsMetric::class, 'upload_id');
    }
}

