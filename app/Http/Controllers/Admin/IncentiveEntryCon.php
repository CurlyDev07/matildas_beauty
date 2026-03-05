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

        // Duplicate keys: same user + mobile + date logged more than once
        $mobileCount = [];
        foreach ($entries as $entry) {
            $key = $entry->user_id . '|' . $entry->customer_mobile . '|' . $entry->created_at->toDateString();
            $mobileCount[$key] = ($mobileCount[$key] ?? 0) + 1;
        }
        $duplicateKeys = array_keys(array_filter($mobileCount, fn($c) => $c > 1));

        $todayCounts = ['Upsell' => 0, 'InfoTxt' => 0, 'Pancake' => 0, 'Events' => 0];
        foreach ($entries as $entry) {
            if ($entry->user_id == auth()->id() && $entry->created_at->isToday() && isset($todayCounts[$entry->type])) {
                $todayCounts[$entry->type]++;
            }
        }

        return view('admin.fbads.incentives_monitoring.index', compact('entries', 'duplicateKeys', 'todayCounts'));
    }

    public function create()
    {
        $todayEntries = IncentiveEntry::where('user_id', auth()->id())
            ->whereDate('created_at', today())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.fbads.incentives_monitoring.create', compact('todayEntries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type'            => 'required|in:Upsell,InfoTxt,Pancake,Events',
            'customer_mobile' => 'required|string|max:20',
        ]);

        // Duplicate check: same user + mobile already logged today
        $isDuplicate = IncentiveEntry::where('user_id', auth()->id())
            ->where('customer_mobile', $request->customer_mobile)
            ->whereDate('created_at', today())
            ->exists();

        IncentiveEntry::create([
            'user_id'         => auth()->id(),
            'type'            => $request->type,
            'customer_mobile' => $request->customer_mobile,
        ]);

        if ($isDuplicate) {
            return redirect()->route('fbads.incentives.create')
                ->with('warning', 'Entry saved — but this mobile number was already logged today.');
        }

        return redirect()->route('fbads.incentives.create')->with('success', 'Entry added.');
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
