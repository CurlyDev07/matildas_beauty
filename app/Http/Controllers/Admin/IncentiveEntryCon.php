<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\IncentiveEntry;
use Illuminate\Http\Request;

class IncentiveEntryCon extends Controller
{
    public function index()
    {
        $entries = IncentiveEntry::with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.fbads.incentives_monitoring.index', compact('entries'));
    }

    public function create()
    {
        return view('admin.fbads.incentives_monitoring.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type'            => 'required|in:Upsell,InfoTxt,Pancake,Events',
            'customer_mobile' => 'required|string|max:20',
        ]);

        IncentiveEntry::create([
            'user_id'         => auth()->id(),
            'type'            => $request->type,
            'customer_mobile' => $request->customer_mobile,
        ]);

        return redirect()->route('fbads.incentives.index')->with('success', 'Entry added.');
    }

    public function edit($id)
    {
        abort_unless(auth()->user()->isMaster(), 403);

        $entry = IncentiveEntry::findOrFail($id);

        return view('admin.fbads.incentives_monitoring.edit', compact('entry'));
    }

    public function update(Request $request, $id)
    {
        abort_unless(auth()->user()->isMaster(), 403);

        $request->validate([
            'type'            => 'required|in:Upsell,InfoTxt,Pancake,Events',
            'customer_mobile' => 'required|string|max:20',
        ]);

        $entry = IncentiveEntry::findOrFail($id);
        $entry->update([
            'type'            => $request->type,
            'customer_mobile' => $request->customer_mobile,
        ]);

        return redirect()->route('fbads.incentives.index')->with('success', 'Entry updated.');
    }

    public function destroy($id)
    {
        abort_unless(auth()->user()->isMaster(), 403);

        IncentiveEntry::findOrFail($id)->delete();

        return redirect()->route('fbads.incentives.index')->with('success', 'Entry deleted.');
    }
}
