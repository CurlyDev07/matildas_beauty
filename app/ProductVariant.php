<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $fillable = ['product_id', 'variant_type', 'name'];
    public $timestamps = false;

    public function product_variant_types(){
        return $this->hasMany(ProductVariantType::class);
    }
}
