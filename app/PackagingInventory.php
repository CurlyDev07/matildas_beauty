<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackagingInventory extends Model
{
    protected $table = 'packaging_inventory';

    public $guarded = [];

    public function material()
    {
        return $this->belongsTo(PackagingMaterial::class, 'packaging_material_id');
    }
}
