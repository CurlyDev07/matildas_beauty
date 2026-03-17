<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\IncentiveEntry;
use App\IncentivePayout;
use App\IncentiveRate;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IncentivePayoutCon extends Controller
{
    public function index()
    {
        abort_unless(auth()->user()->isMaster(), 403);

        $payouts = IncentivePayout::with('releasedBy')
            ->withCount('entries')
            ->orderBy('released_at', 'desc')
            ->get();

        $pendingCount = IncentiveEntry::where('approved', true)
            ->whereNull('payout_id')
            ->count();

        $today = now()->day;
        if ($today <= 15) {
            $suggestStart = now()->startOfMonth()->format('Y-m-d');
            $suggestEnd   = now()->startOfMonth()->addDays(14)->format('Y-m-d');
        } else {
            $suggestStart = now()->startOfMonth()->addDays(15)->format('Y-m-d');
            $suggestEnd   = now()->endOfMonth()->format('Y-m-d');
        }

        return view('admin.staff.payouts.index', compact(
            'payouts', 'pendingCount', 'suggestStart', 'suggestEnd'
        ));
    }

    public function preview(Request $request)
    {
        abort_unless(auth()->user()->isMaster(), 403);

        $request->validate([
            'period_start' => 'required|date',
            'period_end'   => 'required|date|after_or_equal:period_start',
        ]);

        $start = $request->period_start . ' 00:00:00';
        $end   = $request->period_end   . ' 23:59:59';

        $rates = IncentiveRate::pluck('rate', 'type')->toArray();

        $entries = IncentiveEntry::with('user')
            ->where('approved', true)
            ->whereNull('payout_id')
            ->whereBetween('created_at', [$start, $end])
            ->orderBy('user_id')
            ->get();

        $byUser = $entries->groupBy('user_id')->map(function ($userEntries) use ($rates) {
            $user   = $userEntries->first()->user;
            $total  = $userEntries->sum(function ($e) use ($rates) {
                return $rates[$e->type] ?? 0;
            });
            $byType = $userEntries->groupBy('type')->map->count();
            return compact('user', 'total', 'byType');
        })->sortByDesc('total');

        $grandTotal  = $byUser->sum('total');
        $entryCount  = $entries->count();
        $periodStart = $request->period_start;
        $periodEnd   = $request->period_end;

        return view('admin.staff.payouts.preview', compact(
            'byUser', 'grandTotal', 'entryCount', 'periodStart', 'periodEnd', 'rates'
        ));
    }

    public function release(Request $request)
    {
        abort_unless(auth()->user()->isMaster(), 403);

        $request->validate([
            'period_start' => 'required|date',
            'period_end'   => 'required|date|after_or_equal:period_start',
        ]);

        $start = $request->period_start . ' 00:00:00';
        $end   = $request->period_end   . ' 23:59:59';

        $rates = IncentiveRate::pluck('rate', 'type')->toArray();

        $entries = IncentiveEntry::where('approved', true)
            ->whereNull('payout_id')
            ->whereBetween('created_at', [$start, $end])
            ->get();

        if ($entries->isEmpty()) {
            return redirect()->back()->with('error', 'No approved unpaid entries found for this period.');
        }

        $total = $entries->sum(function ($e) use ($rates) {
            return $rates[$e->type] ?? 0;
        });

        $startCarbon = Carbon::parse($request->period_start);
        $endCarbon   = Carbon::parse($request->period_end);
        $label = $startCarbon->format('M j') . '–' . $endCarbon->format('j, Y');

        $payout = IncentivePayout::create([
            'label'          => $label,
            'period_start'   => $request->period_start,
            'period_end'     => $request->period_end,
            'total_amount'   => $total,
            'released_at'    => now(),
            'released_by_id' => auth()->id(),
        ]);

        IncentiveEntry::whereIn('id', $entries->pluck('id'))
            ->update(['payout_id' => $payout->id]);

        return redirect()->route('staff.payouts.index')
            ->with('success', "Payout \"{$payout->label}\" released — ₱" . number_format($total, 0) . " across {$entries->count()} entries.");
    }

    public function show($id)
    {
        abort_unless(auth()->user()->isMaster(), 403);

        $payout = IncentivePayout::with(['entries.user', 'releasedBy'])->findOrFail($id);

        $rates = IncentiveRate::pluck('rate', 'type')->toArray();

        $byUser = $payout->entries->groupBy('user_id')->map(function ($userEntries) use ($rates) {
            $user   = $userEntries->first()->user;
            $total  = $userEntries->sum(function ($e) use ($rates) {
                return $rates[$e->type] ?? 0;
            });
            $byType = $userEntries->groupBy('type')->map->count();
            $byTypeEarned = $userEntries->groupBy('type')->map(function ($typeEntries) use ($rates) {
                $type = $typeEntries->first()->type;
                return $typeEntries->count() * ($rates[$type] ?? 0);
            });
            return compact('user', 'total', 'byType', 'byTypeEarned');
        })->sortByDesc('total');

        return view('admin.staff.payouts.show', compact('payout', 'byUser', 'rates'));
    }
}
