<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Suppliers\CreateSupplierRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Suppliers;


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
    
    public function patch(CreateSupplierRequest $request){
        $supplier = Suppliers::find($request->id);
        $supplier->update($request->all());

        return redirect()->back()->with('success', 'Success');
    }
}
