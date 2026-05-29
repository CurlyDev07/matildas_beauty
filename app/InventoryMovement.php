<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryMovement extends Model
{
    protected $guarded = ['id'];

    public function item()
    {
        return $this->belongsTo(InventoryItem::class, 'inventory_item_id');
    }

    public function movementType()
    {
        return $this->belongsTo(InventoryMovementType::class, 'movement_type_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
