<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionPorductSummary extends Model
{
    protected $guarded = [];

    public function products(){
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
