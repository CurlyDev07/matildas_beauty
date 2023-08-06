<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockInOut extends Model
{
    protected $guarded = [];

    public function stock_in_out_product(){
        return $this->hasMany(StockInOutProducts::class, 'stock_in_out_id', 'id');
    }
    
    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

}
