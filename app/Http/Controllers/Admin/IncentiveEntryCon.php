<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\IncentiveEntry;
use App\IncentiveRate;
use Illuminate\Http\Request;

class IncentiveEntryCon extends Controller
{
    public function index(Request $request)
    {
        $period = $request->get('period', 'today');
        $userId = auth()->id();

        [$start, $end] = $this->periodRange($period);

        $analyticsRaw = IncentiveEntry::where('user_id', $userId)
            ->whereBetween('created_at', [$start, $end])
            ->selectRaw('type, count(*) as count')
            ->groupBy('type')
            ->pluck('count', 'type')
            ->toArray();

        $analytics = [];
        foreach (['Upsell', 'InfoTxt', 'Pancake', 'Events'] as $type) {
            $analytics[$type] = $analyticsRaw[$type] ?? 0;
        }

        $rates = IncentiveRate::pluck('rate', 'type')->toArray();

        $deliveredCount = IncentiveEntry::where('user_id', $userId)
            ->whereBetween('created_at', [$start, $end])
            ->where('delivery_status', 'delivered')
            ->count();

        $approvedCount = IncentiveEntry::where('user_id', $userId)
            ->whereBetween('created_at', [$start, $end])
            ->where('approved', true)
            ->count();

        $approvedRaw = IncentiveEntry::where('user_id', $userId)
            ->whereBetween('created_at', [$start, $end])
            ->where('approved', true)
            ->selectRaw('type, count(*) as count')
            ->groupBy('type')
            ->pluck('count', 'type')
            ->toArray();

        $approvedValue = 0;
        foreach ($approvedRaw as $type => $count) {
            $approvedValue += $count * ($rates[$type] ?? 0);
        }

        $myEntries = IncentiveEntry::with('payout')->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        // Derive payout history from already-loaded entries (no extra queries)
        $myPayouts = $myEntries->filter(function ($e) { return $e->payout_id; })
            ->groupBy('payout_id')
            ->map(function ($entries) use ($rates) {
                $payout = $entries->first()->payout;
                $myTotal = $entries->sum(function ($e) use ($rates) {
                    return $rates[$e->type] ?? 0;
                });
                $byType = $entries->groupBy('type')->map->count();
                return compact('payout', 'myTotal', 'byType');
            })
            ->sortByDesc(function ($row) {
                return optional($row['payout'])->released_at;
            });

        return view('admin.fbads.incentives_monitoring.index', compact(
            'myEntries', 'analytics', 'rates', 'period',
            'deliveredCount', 'approvedCount', 'approvedValue', 'myPayouts'
        ));
    }

    private function periodRange($period)
    {
        $now = now();
        switch ($period) {
            case 'yesterday':
                return [$now->copy()->subDay()->startOfDay(), $now->copy()->subDay()->endOfDay()];
            case 'this_week':
                return [$now->copy()->startOfWeek(), $now->copy()->endOfWeek()];
            case 'last_week':
                return [$now->copy()->subWeek()->startOfWeek(), $now->copy()->subWeek()->endOfWeek()];
            case 'this_month':
                return [$now->copy()->startOfMonth(), $now->copy()->endOfMonth()];
            default: // today
                return [$now->copy()->startOfDay(), $now->copy()->endOfDay()];
        }
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

    public function markDelivered($id)
    {
        $entry = IncentiveEntry::findOrFail($id);

        abort_unless($entry->user_id === auth()->id(), 403);

        if (!$entry->delivery_status) {
            $entry->update(['delivery_status' => 'delivered']);
        }

        return redirect()->route('fbads.incentives.index')->with('success', 'Entry marked as delivered.');
    }

    public function approvals()
    {
        abort_unless(auth()->user()->isMaster(), 403);

        $entries = IncentiveEntry::with('user')
            ->where('delivery_status', 'delivered')
            ->where('approved', false)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.staff.incentive_approvals', compact('entries'));
    }

    public function approve($id)
    {
        abort_unless(auth()->user()->isMaster(), 403);

        IncentiveEntry::findOrFail($id)->update(['approved' => true]);

        return redirect()->route('staff.incentive_approvals')->with('success', 'Incentive approved.');
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
