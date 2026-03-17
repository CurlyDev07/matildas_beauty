<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IncentivePayout extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'released_at'  => 'datetime',
        'period_start' => 'date',
        'period_end'   => 'date',
    ];

    public function releasedBy()
    {
        return $this->belongsTo(User::class, 'released_by_id');
    }

    public function entries()
    {
        return $this->hasMany(IncentiveEntry::class, 'payout_id');
    }
}
