<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackagingPurchase extends Model
{
    public $guarded = [];

    public function supplier()
    {
        return $this->belongsTo(Suppliers::class, 'supplier_id');
    }

    public function items()
    {
        return $this->hasMany(PackagingPurchaseItem::class, 'purchase_id');
    }
}
