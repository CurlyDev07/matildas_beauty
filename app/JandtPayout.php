<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JandtPayout extends Model
{
    protected $guarded = [];

    protected $casts = [
        'raw_payload' => 'array',
    ];

    public function upload()
    {
        return $this->belongsTo(JandtPayoutUpload::class, 'upload_id');
    }
}

