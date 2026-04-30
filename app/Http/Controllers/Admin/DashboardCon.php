<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardCon extends Controller
{
    public function index(Request $request)
    {
        $today = Carbon::today();
        $startDate = $today->copy();
        $endDate = $today->copy();
        $quickRange = $request->query('quick_range', 'today');

        switch ($quickRange) {
            case 'yesterday':
                $startDate = $today->copy()->subDay();
                $endDate = $today->copy()->subDay();
                break;
            case '7_days':
                $startDate = $today->copy()->subDays(6);
                $endDate = $today->copy();
                break;
            case '14_days':
                $startDate = $today->copy()->subDays(13);
                $endDate = $today->copy();
                break;
            case '30_days':
                $startDate = $today->copy()->subDays(29);
                $endDate = $today->copy();
                break;
            case 'this_month':
                $startDate = $today->copy()->startOfMonth();
                $endDate = $today->copy();
                break;
            case 'last_month':
                $startDate = $today->copy()->subMonthNoOverflow()->startOfMonth();
                $endDate = $today->copy()->subMonthNoOverflow()->endOfMonth();
                break;
            default:
                $quickRange = 'today';
                break;
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $startDate = Carbon::parse($request->query('start_date'));
            $endDate = Carbon::parse($request->query('end_date'));
            $quickRange = 'custom';
        }

        if ($startDate->gt($endDate)) {
            [$startDate, $endDate] = [$endDate, $startDate];
        }

        $rangeStart = $startDate->copy()->startOfDay();
        $rangeEnd = $endDate->copy()->endOfDay();

        $periodDays = $startDate->diffInDays($endDate) + 1;
        $previousStart = $startDate->copy()->subDays($periodDays);
        $previousEnd = $startDate->copy()->subDay();

        $current = DB::table('fb_ads')
            ->selectRaw('COALESCE(SUM(total),0) as revenue, COUNT(*) as orders')
            ->whereBetween('created_at', [$rangeStart, $rangeEnd])
            ->first();

        $previous = DB::table('fb_ads')
            ->selectRaw('COALESCE(SUM(total),0) as revenue, COUNT(*) as orders')
            ->whereBetween('created_at', [$previousStart->startOfDay(), $previousEnd->endOfDay()])
            ->first();

        $currentAdSpend = (float) DB::table('fb_ads_metrics')
            ->whereBetween('reporting_starts', [$startDate->toDateString(), $endDate->toDateString()])
            ->sum('amount_spent_php');

        $previousAdSpend = (float) DB::table('fb_ads_metrics')
            ->whereBetween('reporting_starts', [$previousStart->toDateString(), $previousEnd->toDateString()])
            ->sum('amount_spent_php');

        $currentRoas = (float) DB::table('fb_ads_metrics')
            ->whereBetween('reporting_starts', [$startDate->toDateString(), $endDate->toDateString()])
            ->avg('purchase_roas_return_on_ad_spend');

        $previousRoas = (float) DB::table('fb_ads_metrics')
            ->whereBetween('reporting_starts', [$previousStart->toDateString(), $previousEnd->toDateString()])
            ->avg('purchase_roas_return_on_ad_spend');

        // Not filter-dependent: match /admin/lab/inventory computation
        $chemicalsStockTotal = (float) DB::table('ingredients')
            ->leftJoin('ingredient_stocks', 'ingredient_stocks.ingredient_id', '=', 'ingredients.id')
            ->selectRaw('COALESCE(SUM(COALESCE(ingredient_stocks.total_weight, 0) * COALESCE(ingredients.price_per_grams, 0)), 0) as total_value')
            ->value('total_value');

        $chemicalsBelowOneWeight = (int) DB::table('ingredients')
            ->leftJoin('ingredient_stocks', 'ingredient_stocks.ingredient_id', '=', 'ingredients.id')
            ->whereNotNull('ingredient_stocks.total_weight')
            ->where('ingredient_stocks.total_weight', '<', 1)
            ->count();

        // Not filter-dependent: match /admin/packaging/inventory computation
        $packagingStockTotal = (float) DB::table('packaging_materials')
            ->leftJoin('packaging_inventory', 'packaging_inventory.packaging_material_id', '=', 'packaging_materials.id')
            ->selectRaw('COALESCE(SUM(COALESCE(packaging_inventory.quantity, 0) * COALESCE(packaging_materials.cost_per_unit, 0)), 0) as total_value')
            ->value('total_value');

        $packagingSkuCount = (int) DB::table('packaging_materials')->count();

        $totalCustomers = (int) DB::table('fb_ads')->count();

        $currentMonthCustomers = (int) DB::table('fb_ads')
            ->whereBetween('created_at', [
                Carbon::now()->startOfMonth()->startOfDay(),
                Carbon::now()->endOfMonth()->endOfDay(),
            ])
            ->count();

        $lastMonthCustomers = (int) DB::table('fb_ads')
            ->whereBetween('created_at', [
                Carbon::now()->subMonthNoOverflow()->startOfMonth()->startOfDay(),
                Carbon::now()->subMonthNoOverflow()->endOfMonth()->endOfDay(),
            ])
            ->count();

        $customersMonthDiff = $currentMonthCustomers - $lastMonthCustomers;

        $currentRepeatStats = $this->computeRepeatStats($rangeStart, $rangeEnd);
        $previousRepeatStats = $this->computeRepeatStats($previousStart->startOfDay(), $previousEnd->endOfDay());
        $currentRepeatRate = $currentRepeatStats['rate'];
        $previousRepeatRate = $previousRepeatStats['rate'];
        $repeatRateDiff = $currentRepeatRate - $previousRepeatRate;

        $currentRevenue = (float) $current->revenue;
        $currentOrders = (int) $current->orders;
        $currentAov = $currentOrders > 0 ? $currentRevenue / $currentOrders : 0.0;

        $previousRevenue = (float) $previous->revenue;
        $previousOrders = (int) $previous->orders;
        $previousAov = $previousOrders > 0 ? $previousRevenue / $previousOrders : 0.0;

        $changeLabel = 'vs previous period';
        if ($quickRange === 'today') {
            $changeLabel = 'vs yesterday';
        } elseif ($quickRange === 'yesterday') {
            $changeLabel = 'vs previous day';
        }

        $kpis = [
            [
                'label' => 'Revenue',
                'value' => 'P' . number_format($currentRevenue, 0),
                'change' => $this->formatChange($this->computePercentChange($currentRevenue, $previousRevenue)),
                'up' => $currentRevenue >= $previousRevenue,
                'sub' => 'vs P' . number_format($previousRevenue, 0) . ' ' . $changeLabel,
                'change_label' => $changeLabel,
                'icon' => 'fa-chart-line',
                'color' => '#7c3aed',
                'bg' => '#f5f3ff',
            ],
            [
                'label' => 'Total Orders',
                'value' => number_format($currentOrders),
                'change' => $this->formatChange($this->computePercentChange($currentOrders, $previousOrders)),
                'up' => $currentOrders >= $previousOrders,
                'sub' => 'vs ' . number_format($previousOrders) . ' ' . $changeLabel,
                'change_label' => $changeLabel,
                'icon' => 'fa-shopping-bag',
                'color' => '#0284c7',
                'bg' => '#f0f9ff',
            ],
            [
                'label' => 'Avg Order Value',
                'value' => 'P' . number_format($currentAov, 0),
                'change' => $this->formatChange($this->computePercentChange($currentAov, $previousAov)),
                'up' => $currentAov >= $previousAov,
                'sub' => 'vs P' . number_format($previousAov, 0) . ' ' . $changeLabel,
                'change_label' => $changeLabel,
                'icon' => 'fa-tag',
                'color' => '#10b981',
                'bg' => '#f0fdf4',
            ],
            [
                'label'  => 'FB Ad Spend',
                'value'  => 'P' . number_format($currentAdSpend, 0),
                'change' => $this->formatChange($this->computePercentChange($currentAdSpend, $previousAdSpend)),
                'up'     => $currentAdSpend >= $previousAdSpend,
                'sub'    => 'vs P' . number_format($previousAdSpend, 0) . ' ' . $changeLabel,
                'change_label' => $changeLabel,
                'icon'   => 'fa-bullhorn',
                'color'  => '#f59e0b',
                'bg'     => '#fffbeb',
            ],
            [
                'label'  => 'ROAS',
                'value'  => number_format($currentRoas, 1) . 'x',
                'change' => $this->formatChange($this->computePercentChange($currentRoas, $previousRoas)),
                'up'     => $currentRoas >= $previousRoas,
                'sub'    => 'vs ' . number_format($previousRoas, 1) . 'x ' . $changeLabel,
                'change_label' => $changeLabel,
                'icon'   => 'fa-chart-bar',
                'color'  => '#ef4444',
                'bg'     => '#fff1f2',
            ],
            [
                'label'  => 'Gross Margin',
                'value'  => '68.4%',
                'change' => '+1.2%',
                'up'     => true,
                'sub'    => 'vs 67.2% last month',
                'change_label' => 'vs last month',
                'icon'   => 'fa-percent',
                'color'  => '#0d9488',
                'bg'     => '#f0fdfa',
            ],
        ];

        $dateSummary = $startDate->isSameDay($endDate)
            ? $startDate->format('M d, Y')
            : $startDate->format('M d, Y') . ' - ' . $endDate->format('M d, Y');

        return view('admin.dashboard', [
            'kpis' => $kpis,
            'filterStartDate' => $startDate->toDateString(),
            'filterEndDate' => $endDate->toDateString(),
            'quickRange' => $quickRange,
            'dateSummary' => $dateSummary,
            'chemicalsStockTotal' => $chemicalsStockTotal,
            'chemicalsBelowOneWeight' => $chemicalsBelowOneWeight,
            'packagingStockTotal' => $packagingStockTotal,
            'packagingSkuCount' => $packagingSkuCount,
            'totalCustomers' => $totalCustomers,
            'customersMonthDiff' => $customersMonthDiff,
            'repeatRate' => $currentRepeatRate,
            'repeatRateDiff' => $repeatRateDiff,
            'repeatCustomersCount' => $currentRepeatStats['repeat_count'],
        ]);
    }

    private function computeRepeatStats($startDateTime, $endDateTime)
    {
        $baseQuery = DB::table('fb_ads')
            ->whereBetween('created_at', [$startDateTime, $endDateTime])
            ->whereNotNull('phone_number')
            ->where('phone_number', '!=', '');

        $totalUniquePhones = (clone $baseQuery)->distinct('phone_number')->count('phone_number');

        if ($totalUniquePhones === 0) {
            return [
                'rate' => 0.0,
                'repeat_count' => 0,
            ];
        }

        $repeatPhones = (clone $baseQuery)
            ->select('phone_number')
            ->groupBy('phone_number')
            ->havingRaw('COUNT(*) > 1')
            ->get()
            ->count();

        return [
            'rate' => ($repeatPhones / $totalUniquePhones) * 100,
            'repeat_count' => $repeatPhones,
        ];
    }

    private function computePercentChange($current, $previous)
    {
        if ((float) $previous === 0.0) {
            return (float) $current === 0.0 ? 0.0 : 100.0;
        }

        return (($current - $previous) / $previous) * 100;
    }

    private function formatChange($value)
    {
        $prefix = $value >= 0 ? '+' : '';
        return $prefix . number_format($value, 1) . '%';
    }
}
