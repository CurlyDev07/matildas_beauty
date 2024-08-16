<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Purchase extends Model
{
    protected $guarded = [];

    public function purchase_product(){

        return $this->hasMany(PurchaseProduct::class);
    }

    public function suppliers(){
        return $this->hasOne(Suppliers::class, 'id', 'supplier');
    }
}
