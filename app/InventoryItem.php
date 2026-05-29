<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    protected $guarded = ['id'];

    public function unit()
    {
        return $this->belongsTo(InventoryUnit::class, 'unit_id');
    }

    public function category()
    {
        return $this->belongsTo(InventoryCategory::class, 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(
            InventoryTag::class,
            'inventory_item_tags',
            'inventory_item_id',
            'inventory_tag_id'
        );
    }

    public function stocks()
    {
        return $this->hasMany(WarehouseInventory::class, 'inventory_item_id');
    }

    public function movements()
    {
        return $this->hasMany(InventoryMovement::class, 'inventory_item_id');
    }
}
