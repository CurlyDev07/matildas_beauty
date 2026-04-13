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
        $period   = $request->get('period', 'today');
        $dateFrom = $request->get('date_from');
        $dateTo   = $request->get('date_to');
        $userId   = auth()->id();

        [$start, $end] = $this->periodRange($period, $dateFrom, $dateTo);

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
            'deliveredCount', 'approvedCount', 'approvedValue', 'myPayouts',
            'dateFrom', 'dateTo'
        ));
    }

    private function periodRange($period, $dateFrom = null, $dateTo = null)
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
            case 'custom':
                $from = $dateFrom ? \Carbon\Carbon::parse($dateFrom)->startOfDay() : $now->copy()->startOfDay();
                $to   = $dateTo   ? \Carbon\Carbon::parse($dateTo)->endOfDay()     : $now->copy()->endOfDay();
                return [$from, $to];
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

    public function markReturned($id)
    {
        abort_unless(auth()->user()->isMaster(), 403);

        $entry = IncentiveEntry::findOrFail($id);

        // Cannot mark returned once approved or paid
        if ($entry->approved || $entry->payout_id) {
            return redirect()->back()->with('error', 'Cannot mark returned — entry is already approved or paid.');
        }

        $entry->update(['delivery_status' => 'returned']);

        return redirect()->route('fbads.incentives.index')->with('success', 'Entry marked as returned.');
    }

    public function markDelivered(Request $request, $id)
    {
        $entry = IncentiveEntry::findOrFail($id);

        abort_unless($entry->user_id === auth()->id() || auth()->user()->isMaster(), 403);

        if (!$entry->delivery_status) {
            $entry->update(['delivery_status' => 'delivered']);
        }

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('fbads.incentives.index')->with('success', 'Entry marked as delivered.');
    }

    public function allEntries(Request $request)
    {
        abort_unless(auth()->user()->isMaster(), 403);

        $search = $request->get('search', '');

        $query = IncentiveEntry::with(['user', 'payout'])
            ->orderBy('created_at', 'desc');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('customer_mobile', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($u) use ($search) {
                      $u->where('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%");
                  });
            });
        }

        $entries = $query->limit(100)->get();

        $rates = IncentiveRate::pluck('rate', 'type')->toArray();

        return view('admin.staff.incentive_entries', compact('entries', 'rates', 'search'));
    }

    public function approvals()
    {
        abort_unless(auth()->user()->isMaster(), 403);

        $entries = IncentiveEntry::with('user')
            ->where('delivery_status', 'delivered')
            ->where('approved', false)
            ->orderBy('created_at', 'desc')
            ->get();

        // Approved but not yet paid — can still be reverted
        $approvedEntries = IncentiveEntry::with('user')
            ->where('approved', true)
            ->whereNull('payout_id')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.staff.incentive_approvals', compact('entries', 'approvedEntries'));
    }

    public function approve($id)
    {
        abort_unless(auth()->user()->isMaster(), 403);

        IncentiveEntry::findOrFail($id)->update(['approved' => true]);

        return redirect()->route('staff.incentive_approvals')->with('success', 'Incentive approved.');
    }

    public function disapprove($id)
    {
        abort_unless(auth()->user()->isMaster(), 403);

        $entry = IncentiveEntry::findOrFail($id);

        // Cannot revert once included in a payout
        if ($entry->payout_id) {
            return redirect()->route('staff.incentive_approvals')->with('error', 'Cannot revert — entry is already part of a released payout.');
        }

        $entry->update(['approved' => false]);

        return redirect()->route('staff.incentive_approvals')->with('success', 'Approval reverted.');
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
        // abort_unless(auth()->user()->isMaster(), 403);

        IncentiveEntry::findOrFail($id)->delete();

        return redirect()->route('fbads.incentives.index')->with('success', 'Entry deleted.');
    }
}
