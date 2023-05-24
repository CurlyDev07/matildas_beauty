<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionProducts extends Model
{
    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at'];


    public function product(){
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
