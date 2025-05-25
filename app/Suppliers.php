<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Suppliers;

class Suppliers extends Model
{
    public $guarded = [];

    public function purchase(){
        // return $this->belongsTo(Purchase::class);
    }

    public function supplierInfo(){
        return $this->belongsTo(Suppliers::class, 'supplier');
    }
}
