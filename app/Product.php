<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\TransactionProducts;

class Product extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['title', 'description', 'campaign_price', 'selling_price','price', 'compare_price', 'qty', 'threshold','sku', 'barcode', 'short_description', 'status'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $appends = ['primary_image'];

    public function images(){
        return $this->hasMany(ProductImage::class);
    }

    public function product_variants(){
        return $this->hasMany(ProductVariant::class);
    }
    
    public function product_variant_options(){
        return $this->hasMany(ProductVariantOption::class);
    }

    public function getPrimaryImageAttribute(){
        return $this->images()->where('primary', true)->first()['img'];
    }

    public function active(){
        return $this->where('status', 'active');
    }

    public function updateStocks($id, $purchasedQty){
        $product = $this->find($id);
        $product->update(['qty' => ($product->qty - $purchasedQty)]);
    }

    public function update_stocks_on_order_update($id, $product_order_stocks, $request_qty){
        $product = $this->find($id);
        $product->update(['qty' => (($product->qty + $product_order_stocks) - $request_qty)]);
    }
}
