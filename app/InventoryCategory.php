<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryCategory extends Model
{
    protected $guarded = ['id'];

    public function parent()
    {
        return $this->belongsTo(InventoryCategory::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(InventoryCategory::class, 'parent_id');
    }
}
