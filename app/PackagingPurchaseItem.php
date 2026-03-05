<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackagingPurchaseItem extends Model
{
    public $guarded = [];

    public function purchase()
    {
        return $this->belongsTo(PackagingPurchase::class, 'purchase_id');
    }

    public function material()
    {
        return $this->belongsTo(PackagingMaterial::class, 'packaging_material_id');
    }
}
