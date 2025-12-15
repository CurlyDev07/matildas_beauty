<?php

namespace App\Http\Controllers\Admin; // Changed from App\Http\Controllers

use App\Http\Controllers\Controller; // Add this line

use App\OrderSource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderSourceController extends Controller
{
    // Display list of sources
    public function index()
    {
        $sources = OrderSource::orderBy('type')->orderBy('name')->get();
        return view('admin.order-sources.index', compact('sources'));
    }

    // Show create form
    public function create()
    {
        return view('admin.order-sources.create');
    }

    // Store new source
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100|unique:order_sources,name',
            'type' => 'required|in:website,social,sms,call,event,referral,other',
            'description' => 'nullable|string|max:500',
            'color' => 'nullable|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'is_active' => 'nullable|boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $source = OrderSource::create([
            'name' => $request->name,
            'type' => $request->type,
            'description' => $request->description,
            'color' => $request->color ?? '#6b7280',
            'is_active' => $request->has('is_active') ? 1 : 0
        ]);

        return redirect()->route('order-sources.index')
            ->with('success', 'Order source created successfully!');
    }

    // Show edit form
    public function edit($id)
    {
        $source = OrderSource::findOrFail($id);
        return view('admin.order-sources.edit', compact('source'));
    }

    // Update source
    public function update(Request $request, $id)
    {
        $source = OrderSource::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100|unique:order_sources,name,' . $id,
            'type' => 'required|in:website,social,sms,call,event,referral,other',
            'description' => 'nullable|string|max:500',
            'color' => 'nullable|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'is_active' => 'nullable|boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $source->update([
            'name' => $request->name,
            'type' => $request->type,
            'description' => $request->description,
            'color' => $request->color,
            'is_active' => $request->has('is_active') ? 1 : 0
        ]);

        return redirect()->route('order-sources.index')
            ->with('success', 'Order source updated successfully!');
    }

    // Delete source
    public function destroy($id)
    {
        $source = OrderSource::findOrFail($id);
        
        // Check if source has orders
        $orderCount = $source->orders()->count();
        
        if ($orderCount > 0) {
            return redirect()->back()
                ->with('error', "Cannot delete this source. It has {$orderCount} orders associated with it. Set it to inactive instead.");
        }

        $source->delete();

        return redirect()->route('order-sources.index')
            ->with('success', 'Order source deleted successfully!');
    }

    // Toggle active status
    public function toggleActive($id)
    {
        $source = OrderSource::findOrFail($id);
        $source->is_active = !$source->is_active;
        $source->save();

        return redirect()->back()
            ->with('success', 'Source status updated!');
    }

    // API endpoint for dropdown in order form
    public function getActiveSources()
    {
        $sources = OrderSource::active()
            ->orderBy('type')
            ->orderBy('name')
            ->get(['id', 'name', 'type', 'color']);

        return response()->json($sources);
    }
}