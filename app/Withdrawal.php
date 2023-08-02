<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    protected $guarded = [];
    
    public function store(){
        return $this->hasOne(Store::class, 'id', 'store_id');
    }
}
