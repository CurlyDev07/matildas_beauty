<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use Storage;
use File;
use Illuminate\Support\Arr;
use App\ProductImage;
use App\ProductVariantOption;
use App\Http\Requests\Products\UploadProductsRequest;
use App\PurchaseProduct;
class ProductsCon extends Controller
{

    protected $products;

    public function __construct(Product $products) {
        $this->products = $products;
    }

    public function index(Request $request){
        $products = Product::with(array('images' => function($query){
                $query->where('primary', 1);
            })
        )

        ->when($request->no_cogs, function($query){
            return $query->where('price', 0);
        })// filter all product with no price

        ->when($request->no_selling_price, function($query){
            return $query->where('selling_price', 0);
        })// filter all product with no no_selling_price

        ->when($request->out_of_stock, function($query){
            return $query->where('qty', '<=',0);
        })// filter Out Of Stock

        ->when($request->sort, function($query){
            return $query->orderBy('id', request()->sort);
        })// sort

        ->when($request->search, function($query){
            return $query->where('sku', 'like', '%'.request()->search.'%')
            ->orWhere('title', 'like', '%'.request()->search.'%');
        })// search
        ->oldest('qty')->paginate(100);

        return view('admin.products.index', compact('products'));
    }
    
    public function add(){
        return view('admin.products.add');
    }

    public function store(UploadProductsRequest $request){
        $product = Product::create($request->all());

        $primary = 0;
        foreach ($request->images as $key => $value) {
            $img = uuid().'.jpg';
            $path = '/images/products/';
            $small_image = $path.'small-'.$img;
            $original_image = $path.'original-'.$img;

            // small image
            upload_resize_product_image($small_image, $value['base64_image'], 'small');
            $product->images()->create([
                'img' => $small_image,
                'primary' => 1,
                'size' => 'small'
            ]);

            // original image
            upload_resize_product_image($original_image, $value['base64_image'], 'original');
            $product->images()->create([
                'img' => $original_image,
                'primary' => 1,
                'size' => 'original'
            ]);

        }// Upload Images

        $this->products->recomputeProfit($product->id);// Recompute And Update Profit

        return response()->json(['code' => 200]);
    }

    public function update($id){
        $products = Product::where('id', $id)->with(['images'])->get()->toArray()[0];
        return view('admin.products.update', compact('products'));
    }
    
    public function patch(UploadProductsRequest $request){

        $this->products->recomputeProfit($request->id);// Recompute And Update Profit

        /*--------------------------------------------------------------------------
        | FIND AND UPDATE THE PROPERTY
        |--------------------------------------------------------------------------*/
        $product = Product::find($request->id);
        $update = $product->update($request->except(['id', 'images', 'qty']));
        $old_imgs = ProductImage::where('product_id', $request->id)->pluck('img')->toArray();

        /*--------------------------------------------------------------------------
        | CHECK IF NEW IMAGES IS EXIST IN DATABASE ELSE DELETE IMAGE
        |--------------------------------------------------------------------------*/
        $get_image_names_from_req_img = Arr::pluck($request->images, 'base64_image');

        foreach ($old_imgs as $old_img) {
            if (!in_array($old_img, $get_image_names_from_req_img)) {
                $old_images_removed_cloud_front = str_replace(config('app.cloudfront'),"", $old_img);
                ProductImage::where('img', $old_images_removed_cloud_front)->delete();
            }
        }

        $primary = 0;
        foreach ($request->images as $key => $value) {
            /*--------------------------------------------------------------------------
            | CRATE NEW IMAGES IF NOT EXIST IN DB
            |--------------------------------------------------------------------------*/
            if (!in_array($value['base64_image'], $old_imgs)) {
                $img = uuid().'.jpg';
                $path = '/images/products/';
                $small_image = $path.'small-'.$img;
                $original_image = $path.'original-'.$img;
                
                // small image
                upload_resize_product_image($small_image, $value['base64_image'], 'small');
                $product->images()->create([
                    'img' => $small_image,
                    'primary' => $value['primary'],
                    'size' => 'small'
                ]);
    
                // original image
                upload_resize_product_image($original_image, $value['base64_image'], 'original');
                $product->images()->create([
                    'img' => $original_image,
                    'primary' => $value['primary'],
                    'size' => 'original'
                ]);
            }

            /*--------------------------------------------------------------------------
            | UPDATE ALL IMAGE PRIMARY
            |--------------------------------------------------------------------------*/
            ProductImage::where('img', $value['base64_image'])->update(['primary' => $value['primary']]);
            $value['primary'] == 1 ? $primary++ : '';
        }

        /*--------------------------------------------------------------------------
        | SET MAIN IMAGE IF NOT SET
        |--------------------------------------------------------------------------*/
        if ($primary == 0) {
            $product->images()->first()->update(['primary' => 1]);
        }

        return response()->json(['code' => 200]);
    }

    public function status(Request $request){
       Product::find($request->id)->update(['status' => $request->status]);
    }

    public function delete(Request $request){
        foreach ($request->property_ids as $property_id) {
            Product::find($property_id)->delete();
        }
    }

    public function restore(Request $request){
        foreach ($request->property_ids as $property_id) {
            Product::withTrashed()->find($property_id)->restore();
        }
    }

    public function archive(){
        $archive = Product::select('id', 'title', 'price', 'deleted_at')->orderBy('id', 'desc')
        ->onlyTrashed()->get()->toArray();

        return view('admin.products.archive', compact('archive'));
    }

    public function generate_variant(){
        $arranged = request()->variants ? get_variations(request()->variants) : [];
            $variant_key_values = json_encode(request()->variants);
        
            $all_combination = [];
        
            foreach ($arranged as $key => $value) {
                $one_combination = '';
                $i = 0;
                foreach ($value as $key2 => $value2) {
                    if ($i == 0 && count($value) == 1) {
                        $one_combination .= $value2;
                        $i++;
                        break;
                    }// for only one variant remove the (/)
                    
                    if(count($value) == ($i + 1)){
                        $one_combination .= $value2;
                        $i++;
                        break;
                    }// last variant remove the (/)
                    
                    // for variant greater than 1 and less than the variant count add (/)
                    $one_combination .= $value2 .' / ';
                    $i++;
                }
                $all_combination[] = $one_combination;
            }
           
            return view('admin.products.variant_items_form', compact('all_combination', 'variant_key_values'));
    }


    public function change_profit(Request $request){
        $product = Product::find($request->id);
        $update = $product->update(['profit' => $request->profit]);

        return request()->all();
    }
    
    public function change_price(Request $request){
        $product = Product::find($request->id);
        $update = $product->update(['price' => $request->price]);

        $profit = $this->products->recomputeProfit($request->id);// Recompute And Update Profit
        return $profit;
    }

    public function selling_price(Request $request){
        $product = Product::find($request->id);
        $update = $product->update(['selling_price' => $request->selling_price]);
        
        $profit = $this->products->recomputeProfit($request->id);// Recompute And Update Profit

        return $profit;
    }

    public function get_cogs(Request $request){ 
        $last_price = PurchaseProduct::where('product_id', $request->id)->where('received', 'yes')->get('price')->last();

        if ($last_price) {
            $product = Product::find($request->id);
            $update = $product->update(['price' => $last_price->price]);
            $profit = $this->products->recomputeProfit($request->id);// Recompute And Update Profit
            return 'hello';
    
            return $profit;
        }

        $profit = $this->products->recomputeProfit($request->id);// Recompute And Update Profit

        return 'hello';
    }


}



 
