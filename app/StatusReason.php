<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusReason extends Model
{
    protected $fillable = ['reason', 'category', 'img'];
}
