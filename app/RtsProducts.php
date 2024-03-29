<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RtsProducts extends Model
{
    protected $guarded = [];

    public function products(){
        return $this->hasMany(Product::class, 'id', 'product_id');
    }
}
