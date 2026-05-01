<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JandtPayoutUpload extends Model
{
    protected $guarded = [];

    public function payouts()
    {
        return $this->hasMany(JandtPayout::class, 'upload_id');
    }
}

