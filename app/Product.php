<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\TransactionProducts;

class Product extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['title', 'description', 'campaign_price', 'selling_price','price', 'compare_price', 'qty', 'threshold','sku', 'barcode', 'short_description', 'status', 'profit', 'profit_percentage'];
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

    public function recomputeProfit($id){
        $product = $this->find($id);

        $selling_price = $product->selling_price > 1? $product->selling_price : 1;
        $cogs = $product->price > 0? $product->price : 1;

        $packaging_cost = 10;
        $total_charges_percentage = 28.82;

        $total_charges = (($total_charges_percentage/100) * $selling_price) + $packaging_cost;
        $profit = $selling_price - ($total_charges + $cogs);
        $profit_percentage = ($profit/$selling_price) * 100;

        $product->update([
            'profit' => (double)number_format($profit, 2),
            'profit_percentage' => (double)number_format($profit_percentage, 2)
        ]);

        return [
            'profit' => number_format($profit, 2),
            'profit_percentage' => number_format($profit_percentage, 2),
        ];
    }
}
