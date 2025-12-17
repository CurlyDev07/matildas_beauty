<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\FbAdsProduct;
use Illuminate\Http\Request;

class FbAdsProductController extends Controller
{
    public function index()
    {
        $products = FbAdsProduct::orderBy('order', 'asc')->get();
        return view('admin.fb_ads_products.index', compact( 'products'));
    }

    public function create()
    {
        return view('admin.fb_ads_products.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateRequest($request);
        FbAdsProduct::create($data);

        // Updated redirect to use the admin route if needed, 
        // usually resource routes inside admin prefix might change names,
        // but assuming 'fb-ads.index' name is preserved by your route setup:
        return redirect()->route('fb-ads.index')->with('success', 'Product created successfully.');
    }

    public function edit($id)
    {
        $product = FbAdsProduct::findOrFail($id);
        return view('admin.fb_ads_products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = FbAdsProduct::findOrFail($id);
        $data = $this->validateRequest($request, $id);
        $product->update($data);

        return redirect()->route('fb-ads.index')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $product = FbAdsProduct::findOrFail($id);
        $product->delete();

        return redirect()->route('fb-ads.index')->with('success', 'Product deleted.');
    }

    private function validateRequest($request, $id = null)
    {
        $skuRule = 'required|string|max:255|unique:fb_ads_product,sku' . ($id ? ',' . $id : '');

        return $request->validate([
            'sku' => $skuRule,
            'product_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'slashed_price' => 'nullable|numeric',
            'discount_tag' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'promo_line1' => 'nullable|string|max:255',
            'promo_line2' => 'nullable|string|max:255',
            'promo_line3' => 'nullable|string|max:255',
            'scarcity_text' => 'nullable|string|max:255',
            
            // Image Links
            'image1' => 'nullable|string|max:255',
            'image2' => 'nullable|string|max:255',
            'image3' => 'nullable|string|max:255',
            'image4' => 'nullable|string|max:255',
            'image5' => 'nullable|string|max:255',
        ]);
    }


    public function updateOrder(Request $request, $id)
    {
        $product = FbAdsProduct::findOrFail($id);
        $direction = $request->input('direction');
        
        if ($direction === 'up') {
            // Get the product immediately above this one
            $swapProduct = FbAdsProduct::where('order', '<', $product->order)
                ->orderBy('order', 'desc')
                ->first();
        } elseif ($direction === 'down') {
            // Get the product immediately below this one
            $swapProduct = FbAdsProduct::where('order', '>', $product->order)
                ->orderBy('order', 'asc')
                ->first();
        }
        
        if (isset($swapProduct)) {
            // Swap the order values
            $currentOrder = $product->order;
            $product->order = $swapProduct->order;
            $swapProduct->order = $currentOrder;
            
            $product->save();
            $swapProduct->save();
        }
        
        return redirect()->back()->with('success', 'Order updated');
    }
}