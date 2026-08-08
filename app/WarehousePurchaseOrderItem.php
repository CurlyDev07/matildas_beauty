<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WarehousePurchaseOrderItem extends Model
{
    protected $guarded = ['id'];

    public function purchaseOrder()
    {
        return $this->belongsTo(WarehousePurchaseOrder::class, 'warehouse_purchase_order_id');
    }

    public function item()
    {
        return $this->belongsTo(InventoryItem::class, 'inventory_item_id');
    }
}
