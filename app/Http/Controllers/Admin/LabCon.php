<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Ingredients;

class LabCon extends Controller
{
    public function index(){
        $ingredients  = Ingredients::all();

        return view('admin.lab.index', compact('ingredients'));
    }
   
    public function create(Request $request){
       $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'price_per_grams' => 'nullable|numeric',
            'note' => 'nullable|string',
        ]);

        // Save to database
        $insert = Ingredients::create($validated);

        // Redirect or return response
        return redirect()->route('lab.index');
    }

    public function update($id){
        $ingredient  = Ingredients::find($id);

        return view('admin.lab.update', compact('ingredient'));
    }

    public function patch(Request $request, $id){
            // Validate request
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'nullable|numeric',
                'weight' => 'nullable|numeric',
                'price_per_grams' => 'nullable|numeric',
                'note' => 'nullable|string',
            ]);

            // Find the ingredient by ID
            $ingredient = Ingredients::findOrFail($id);

            // Update the record
            $ingredient->update($validated);

            // Optional: redirect or return response
            return redirect()->route('lab.index');
    }

    public function purchase(){
        $ingredients  = Ingredients::all();

        return view('admin.lab.purchase.create', compact("ingredients"));
    }
}
