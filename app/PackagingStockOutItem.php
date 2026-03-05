<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackagingStockOutItem extends Model
{
    public $guarded = [];

    public function stockOut()
    {
        return $this->belongsTo(PackagingStockOut::class, 'stock_out_id');
    }

    public function material()
    {
        return $this->belongsTo(PackagingMaterial::class, 'packaging_material_id');
    }
}
