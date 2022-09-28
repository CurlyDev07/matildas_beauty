<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

class CategoriesCon extends Controller
{
    public function index(){
        $categories = Category::all()->toArray();

        return view('admin.categories.index', compact('categories'));
    }
    
    public function add(){
        return view('admin.categories.add');
    }

    public function store(Request $request){
        Category::create($request->all());
        return redirect()->route('category.list');
    }

    public function delete(Request $request){
        Category::find($request->id)->delete();
    }
}
