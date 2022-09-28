<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseProduct extends Model
{
    protected $guarded = [];

    public function product(){
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
