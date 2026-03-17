<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IncentiveEntry extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'approved' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payout()
    {
        return $this->belongsTo(IncentivePayout::class);
    }
}
