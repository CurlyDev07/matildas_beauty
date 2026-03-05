<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackagingMaterial extends Model
{
    public $guarded = [];

    public function inventory()
    {
        return $this->hasOne(PackagingInventory::class, 'packaging_material_id');
    }

    public function purchaseItems()
    {
        return $this->hasMany(PackagingPurchaseItem::class, 'packaging_material_id');
    }
}
