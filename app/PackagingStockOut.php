<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackagingStockOut extends Model
{
    public $guarded = [];

    public function items()
    {
        return $this->hasMany(PackagingStockOutItem::class, 'stock_out_id');
    }
}
