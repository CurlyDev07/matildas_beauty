<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\IncentiveRate;
use Illuminate\Http\Request;

class IncentiveRateCon extends Controller
{
    public function index()
    {
        abort_unless(auth()->user()->isMaster(), 403);

        $rates = IncentiveRate::orderByRaw("FIELD(type, 'Upsell', 'InfoTxt', 'Pancake', 'Events')")->get();

        return view('admin.staff.incentive_rates', compact('rates'));
    }

    public function update(Request $request, $type)
    {
        abort_unless(auth()->user()->isMaster(), 403);

        $request->validate([
            'rate' => 'required|numeric|min:0',
        ]);

        IncentiveRate::where('type', $type)->update(['rate' => $request->rate]);

        return redirect()->route('staff.incentive_rates.index')->with('success', "{$type} rate updated to ₱" . number_format($request->rate, 2) . '.');
    }
}
