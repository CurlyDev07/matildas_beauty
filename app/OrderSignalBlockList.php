<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderSignalBlockList extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'fingerprintjs_visitor_id',
        'user_id',
        'attempt_count',
        'last_attempt_at',
        'timestamp',
    ];
}
