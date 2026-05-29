<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WarehouseInventory extends Model
{
    protected $table = 'warehouse_inventory';

    protected $guarded = ['id'];

    public function item()
    {
        return $this->belongsTo(InventoryItem::class, 'inventory_item_id');
    }

    public function status()
    {
        return $this->belongsTo(InventoryStatus::class, 'inventory_status_id');
    }

    public function getTotalCostValueAttribute()
    {
        return (float) $this->quantity * (float) optional($this->item)->cost;
    }

    public function getTotalSellingValueAttribute()
    {
        return (float) $this->quantity * (float) optional($this->item)->selling_price;
    }
}
