<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rts extends Model
{
    protected $guarded = [];

    public function products(){
        return $this->hasMany(RtsProducts::class);
    }
}
