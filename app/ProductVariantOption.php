<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductVariantOption extends Model
{
    protected $fillable = ['product_id', 'name', 'price', 'price', 'qty', 'sku', 'barcode', 'image'];
    public $timestamps = false;

}
