<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = [];
    protected $appends = ['items_count'];

    public function products(){
        return $this->hasMany(TransactionProducts::class);
    }

    public function payments(){
        return $this->hasOne(TransactionPayment::class);
    }

    public function getItemsCountAttribute(){
        return $this->products()->sum("qty");
    }
}

