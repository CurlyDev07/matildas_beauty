<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $guarded = [];

    public function purchase_product(){
        return $this->hasMany(PurchaseProduct::class);
    }
}
