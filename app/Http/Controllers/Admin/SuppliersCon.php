<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Suppliers\CreateSupplierRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Suppliers;
use App\Purchase;
use App\Product;
use App\PurchaseProduct;


class SuppliersCon extends Controller
{
    public function index(Request $request){
        $suppliers = Suppliers::all();


        return view('admin.suppliers.index', ['suppliers' => $suppliers]);
    }

    public function create(Request $request){
        
        return view('admin.suppliers.create');
    }

    public function store(CreateSupplierRequest $request){
        $supplier = Suppliers::create($request->all());

        return redirect()->back()->with('success', 'Success');
    }

    public function view($supplier_id){
        $supplier = Suppliers::find($supplier_id);
        
        return view('admin.suppliers.update', ['supplier' => $supplier]);
    }
    
    public function details($supplier_id){
        $supplier = Suppliers::find($supplier_id);

        $purchase_ids = Purchase::where('supplier', $supplier_id)->pluck('id');
        $purchase_products = PurchaseProduct::whereIn('purchase_id', $purchase_ids)->pluck('product_id')->unique();
        $products = Product::whereIn('id', $purchase_products)->select('id', 'title', 'sku')->get();
        
        return view('admin.suppliers.details', ['products' => $products, 'supplier' => $supplier]);
    }

    
    public function patch(CreateSupplierRequest $request){
        $supplier = Suppliers::find($request->id);
        $supplier->update($request->all());

        return redirect()->back()->with('success', 'Success');
    }
}
