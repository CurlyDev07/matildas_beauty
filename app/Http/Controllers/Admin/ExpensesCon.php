<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Expenses;
use App\ExpensesCategory;

class ExpensesCon extends Controller
{
    public function index(){
        $expenses = Expenses::with(['category'])->orderBy('date', 'desc')->get();
        return view('admin.expenses.index', ['expenses' => $expenses]);
    }

    public function create(){
        $categories = ExpensesCategory::all();

        return view('admin.expenses.create', ['categories' => $categories]);
    }

    public function store(){

        Expenses::Create([
            'name' => request()->name,
            'category_id' => request()->category_id,
            'quantity' => request()->quantity,
            'cost' => request()->cost,
            'notes' => request()->Notes,
            'date' => date_f(request()->date, 'Y-m-d H:i:s'),
        ]);
        return redirect()->route('expenses.index');
    }

    public function update($id){
        $categories = ExpensesCategory::all();
        $expense = Expenses::find($id)->toArray();
        return view('admin.expenses.update', ['categories' => $categories, 'expense' => $expense]);
    }

    public function patch(){
        $expense = Expenses::find(request()->id)->update(request()->all());
        return redirect()->route('expenses.index');
    }
   
    public function category(){
        $categories = ExpensesCategory::all();
        return view('admin.expenses.category.index', ['categories' => $categories]);
    }

    public function category_store(){
        $create = ExpensesCategory::create(request()->all());
       return redirect()->back();
    }

    public function category_delete($id){
        $create = ExpensesCategory::find($id)->delete();

       return redirect()->back();
    }
}
