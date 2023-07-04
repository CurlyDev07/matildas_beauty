<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PowerUp extends Model
{
    protected $guarded = [];

    public function store(){
        return $this->hasOne(Store::class, 'id', 'store_id');
    }
}
