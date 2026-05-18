<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MobileApiToken extends Model
{
    protected $guarded = ['id'];

    protected $dates = [
        'last_used_at',
        'expires_at',
        'revoked_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

