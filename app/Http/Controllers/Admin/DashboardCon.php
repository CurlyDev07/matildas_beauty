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
        $quickRange = $request->query('quick_range', 'this_month');

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

        $campaignSort = $request->query('campaign_sort', 'roas_desc');

        $rangeStart = $startDate->copy()->startOfDay();
        $rangeEnd = $endDate->copy()->endOfDay();

        $periodDays = $startDate->diffInDays($endDate) + 1;
        $previousStart = $startDate->copy()->subDays($periodDays);
        $previousEnd = $startDate->copy()->subDay();
        $previousRangeStart = $previousStart->copy()->startOfDay();
        $previousRangeEnd = $previousEnd->copy()->endOfDay();

        $current = DB::table('fb_ads')
            ->selectRaw('COALESCE(SUM(total),0) as revenue, COUNT(*) as orders')
            ->whereBetween('created_at', [$rangeStart, $rangeEnd])
            ->first();

        $previous = DB::table('fb_ads')
            ->selectRaw('COALESCE(SUM(total),0) as revenue, COUNT(*) as orders')
            ->whereBetween('created_at', [$previousRangeStart, $previousRangeEnd])
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
        $lowestPackagingStocks = DB::table('packaging_materials')
            ->leftJoin('packaging_inventory', 'packaging_inventory.packaging_material_id', '=', 'packaging_materials.id')
            ->select(
                'packaging_materials.name',
                'packaging_materials.unit',
                DB::raw('COALESCE(packaging_inventory.quantity, 0) as quantity')
            )
            ->orderBy('quantity', 'asc')
            ->orderBy('packaging_materials.name', 'asc')
            ->limit(10)
            ->get();

        $recentProductions = DB::table('productions')
            ->select('date', 'product_name', 'total_quantity', 'total')
            ->orderBy('date', 'desc')
            ->orderBy('id', 'desc')
            ->limit(10)
            ->get();

        $assignedCallerCounts = DB::table('fb_ads')
            ->leftJoin('users', 'users.id', '=', 'fb_ads.user_id')
            ->whereBetween('fb_ads.created_at', [$rangeStart, $rangeEnd])
            ->whereNotNull('fb_ads.user_id')
            ->where('fb_ads.user_id', '>', 0)
            ->select(
                'fb_ads.user_id',
                DB::raw('COALESCE(NULLIF(TRIM(CONCAT(COALESCE(users.first_name, ""), " ", COALESCE(users.last_name, ""))), ""), CONCAT("User #", fb_ads.user_id)) as caller_name'),
                DB::raw('COUNT(*) as total_rows')
            )
            ->groupBy('fb_ads.user_id', 'users.first_name', 'users.last_name')
            ->get();

        $unassignedCount = (int) DB::table('fb_ads')
            ->whereBetween('created_at', [$rangeStart, $rangeEnd])
            ->where(function ($q) {
                $q->whereNull('user_id')->orWhere('user_id', 0);
            })
            ->count();

        $topCallers = collect();
        if ($unassignedCount > 0) {
            $topCallers->push((object) [
                'caller_name' => 'Unassign',
                'total_rows' => $unassignedCount,
            ]);
        }

        $topCallers = $topCallers
            ->merge($assignedCallerCounts->map(function ($row) {
                return (object) [
                    'caller_name' => $row->caller_name,
                    'total_rows' => (int) $row->total_rows,
                ];
            }))
            ->sortByDesc('total_rows')
            ->take(5)
            ->values();

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
        $previousRepeatStats = $this->computeRepeatStats($previousRangeStart, $previousRangeEnd);
        $currentRepeatRate = $currentRepeatStats['rate'];
        $previousRepeatRate = $previousRepeatStats['rate'];
        $repeatRateDiff = $currentRepeatRate - $previousRepeatRate;

        $campaignPerformance = DB::table('fb_ads_metrics')
            ->selectRaw("
                campaign_name,
                COALESCE(SUM(purchases), 0) as purchases,
                COALESCE(AVG(cost_per_purchase_php), 0) as cost_per_purchase_php,
                COALESCE(AVG(purchase_roas_return_on_ad_spend), 0) as purchase_roas_return_on_ad_spend,
                COALESCE(SUM(amount_spent_php), 0) as amount_spent_php,
                COALESCE(SUM(purchases_conversion_value), 0) as purchases_conversion_value
            ")
            ->whereBetween('reporting_starts', [$startDate->toDateString(), $endDate->toDateString()])
            ->whereNotNull('campaign_name')
            ->where('campaign_name', '!=', '')
            ->groupBy('campaign_name')
            ->get()
            ->map(function ($row) {
                $purchases = (float) $row->purchases;
                $revenue = (float) $row->purchases_conversion_value;
                $row->aov = $purchases > 0 ? ($revenue / $purchases) : 0;
                return $row;
            });

        $campaignPerformance = $this->sortCampaignPerformance($campaignPerformance, $campaignSort)->values();

        $campaignTotalSpend = (float) $campaignPerformance->sum('amount_spent_php');

        $orderSourceBreakdown = DB::table('fb_ads')
            ->leftJoin('order_sources', 'fb_ads.source_id', '=', 'order_sources.id')
            ->select(
                DB::raw("COALESCE(order_sources.name, 'Website') as source_name"),
                DB::raw("COALESCE(order_sources.color, '#94a3b8') as source_color"),
                DB::raw('COUNT(*) as order_count')
            )
            ->whereBetween('fb_ads.created_at', [$rangeStart, $rangeEnd])
            ->groupBy('order_sources.id', 'order_sources.name', 'order_sources.color')
            ->orderByDesc('order_count')
            ->get();

        $sourceTotalOrders = (int) $orderSourceBreakdown->sum('order_count');
        $sourceLabels = $orderSourceBreakdown->pluck('source_name')->toArray();
        $sourceCounts = $orderSourceBreakdown->pluck('order_count')->map(function ($v) { return (int) $v; })->toArray();
        $sourceColors = $orderSourceBreakdown->pluck('source_color')->toArray();

        $topPromoRevenue = DB::table('fb_ads')
            ->select(
                DB::raw("COALESCE(NULLIF(TRIM(promo), ''), 'No Promo') as promo_name"),
                DB::raw('COALESCE(SUM(total), 0) as revenue_total')
            )
            ->whereBetween('created_at', [$rangeStart, $rangeEnd])
            ->groupBy('promo_name')
            ->orderByDesc('revenue_total')
            ->limit(10)
            ->get();

        $topPromoLabels = $topPromoRevenue->pluck('promo_name')->toArray();
        $topPromoTotals = $topPromoRevenue->pluck('revenue_total')->map(function ($v) { return (float) $v; })->toArray();

        $bankTransactions = DB::table('bank_transactions')
            ->select('sender_name', 'receiver_name', 'amount', 'date', 'time')
            ->whereBetween('date', [$startDate->toDateString(), $endDate->toDateString()])
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->limit(5)
            ->get();

        $monthBuckets = [];
        for ($i = 5; $i >= 0; $i--) {
            $m = Carbon::now()->startOfMonth()->subMonths($i);
            $key = $m->format('Y-m');
            $monthBuckets[$key] = [
                'label' => $m->format('M Y'),
                'revenue' => 0.0,
                'ad_spend' => 0.0,
            ];
        }

        $revenueRows = DB::table('fb_ads')
            ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') as ym, COALESCE(SUM(total), 0) as revenue")
            ->whereBetween('created_at', [Carbon::now()->startOfMonth()->subMonths(5)->startOfDay(), Carbon::now()->endOfDay()])
            ->groupBy('ym')
            ->get();

        foreach ($revenueRows as $row) {
            if (isset($monthBuckets[$row->ym])) {
                $monthBuckets[$row->ym]['revenue'] = (float) $row->revenue;
            }
        }

        $adSpendRows = DB::table('fb_ads_metrics')
            ->selectRaw("DATE_FORMAT(reporting_starts, '%Y-%m') as ym, COALESCE(SUM(amount_spent_php), 0) as ad_spend")
            ->whereBetween('reporting_starts', [Carbon::now()->startOfMonth()->subMonths(5)->toDateString(), Carbon::now()->toDateString()])
            ->groupBy('ym')
            ->get();

        foreach ($adSpendRows as $row) {
            if (isset($monthBuckets[$row->ym])) {
                $monthBuckets[$row->ym]['ad_spend'] = (float) $row->ad_spend;
            }
        }

        $trendLabels = array_values(array_map(function ($m) { return $m['label']; }, $monthBuckets));
        $trendRevenue = array_values(array_map(function ($m) { return $m['revenue']; }, $monthBuckets));
        $trendAdSpend = array_values(array_map(function ($m) { return $m['ad_spend']; }, $monthBuckets));

        $ordersWeekCurrent = $this->buildFourBucketOrderCounts($rangeStart, $rangeEnd);
        $ordersWeekPrevious = $this->buildFourBucketOrderCounts($previousRangeStart, $previousRangeEnd);
        $ordersWeekLabels = ['Week 1', 'Week 2', 'Week 3', 'Week 4'];

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
            'campaignPerformance' => $campaignPerformance,
            'campaignTotalSpend' => $campaignTotalSpend,
            'campaignSort' => $campaignSort,
            'lowestPackagingStocks' => $lowestPackagingStocks,
            'recentProductions' => $recentProductions,
            'topCallers' => $topCallers,
            'orderSourceBreakdown' => $orderSourceBreakdown,
            'sourceTotalOrders' => $sourceTotalOrders,
            'sourceLabels' => $sourceLabels,
            'sourceCounts' => $sourceCounts,
            'sourceColors' => $sourceColors,
            'topPromoLabels' => $topPromoLabels,
            'topPromoTotals' => $topPromoTotals,
            'bankTransactions' => $bankTransactions,
            'trendLabels' => $trendLabels,
            'trendRevenue' => $trendRevenue,
            'trendAdSpend' => $trendAdSpend,
            'ordersWeekCurrent' => $ordersWeekCurrent,
            'ordersWeekPrevious' => $ordersWeekPrevious,
            'ordersWeekLabels' => $ordersWeekLabels,
        ]);
    }

    private function buildFourBucketOrderCounts($rangeStart, $rangeEnd)
    {
        $days = $rangeStart->copy()->startOfDay()->diffInDays($rangeEnd->copy()->endOfDay()) + 1;
        $bucketSize = max(1, (int) ceil($days / 4));
        $counts = [];

        for ($i = 0; $i < 4; $i++) {
            $bucketStart = $rangeStart->copy()->addDays($i * $bucketSize)->startOfDay();
            $bucketEnd = $bucketStart->copy()->addDays($bucketSize - 1)->endOfDay();

            if ($bucketStart->gt($rangeEnd)) {
                $counts[] = 0;
                continue;
            }

            if ($bucketEnd->gt($rangeEnd)) {
                $bucketEnd = $rangeEnd->copy()->endOfDay();
            }

            $counts[] = (int) DB::table('fb_ads')
                ->whereBetween('created_at', [$bucketStart, $bucketEnd])
                ->count();
        }

        return $counts;
    }

    private function sortCampaignPerformance($rows, $sort)
    {
        switch ($sort) {
            case 'roas_asc':
                return $rows->sortBy('purchase_roas_return_on_ad_spend');
            case 'spend_desc':
                return $rows->sortByDesc('amount_spent_php');
            case 'spend_asc':
                return $rows->sortBy('amount_spent_php');
            case 'purchases_desc':
                return $rows->sortByDesc('purchases');
            case 'purchases_asc':
                return $rows->sortBy('purchases');
            case 'aov_desc':
                return $rows->sortByDesc('aov');
            case 'aov_asc':
                return $rows->sortBy('aov');
            case 'roas_desc':
            default:
                return $rows->sortByDesc('purchase_roas_return_on_ad_spend');
        }
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
