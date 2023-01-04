<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suppliers extends Model
{
    public $guarded = [];

    public function purchase(){
        // return $this->belongsTo(Purchase::class);
    }
}
