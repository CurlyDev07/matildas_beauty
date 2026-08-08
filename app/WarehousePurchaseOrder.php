<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WarehousePurchaseOrder extends Model
{
    protected $guarded = ['id'];

    protected $dates = ['range_start', 'range_end'];

    public function items()
    {
        return $this->hasMany(WarehousePurchaseOrderItem::class, 'warehouse_purchase_order_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
