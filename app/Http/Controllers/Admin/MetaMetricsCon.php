<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\MetaCreativeMetric;
use Illuminate\Support\Facades\DB;

class MetaMetricsCon extends Controller
{

    public function getSpendProfit(Request $request){
        $start = $request->input('start_date') ?? now()->subDays(7)->toDateString();
        $end = $request->input('end_date') ?? now()->toDateString();

        $data = MetaCreativeMetric::whereBetween('reporting_start', [$start, $end])
            ->selectRaw('ad_name, SUM(amount_spent) as amount_spent, SUM(profit) as profit')
            ->groupBy('ad_name')
            ->orderByRaw('SUM(amount_spent) DESC')
            ->get();

        return response()->json($data);
    }

    public function getRoasPerAd(Request $request){
        $start = $request->input('start_date');
        $end = $request->input('end_date');

        if (!$start || !$end) {
            return response()->json([]);
        }

        $data = MetaCreativeMetric::whereBetween('reporting_start', [$start, $end])
            ->select('ad_name',
                DB::raw('SUM(amount_spent) as total_spent'),
                DB::raw('SUM(purchase_roas * amount_spent) / NULLIF(SUM(amount_spent), 0) as avg_roas'))
            ->whereNotNull('purchase_roas')
            ->groupBy('ad_name')
            ->get()
            ->map(function ($item) {
                return [
                    'ad_name' => $item->ad_name,
                    'roas' => round((float)$item->avg_roas, 2),
                ];
            });

        return response()->json($data);
    }


    public function getAdList(){
        $ads = DB::table('meta_creative_metrics')
            ->select('ad_name')
            ->groupBy('ad_name')
            ->orderBy('ad_name')
            ->pluck('ad_name');

        return response()->json($ads);
    }

    public function getAdHistory(Request $request){
        $adName = $request->ad_name;
        $start = $request->start_date;
        $end = $request->end_date;

        $rows = DB::table('meta_creative_metrics')
            ->selectRaw('reporting_start, AVG(ctr_all) as ctr, AVG(frequency) as frequency, AVG(purchase_roas) as roas')
            ->where('ad_name', $adName)
            ->when($start && $end, function ($q) use ($start, $end) {
                $q->whereBetween('reporting_start', [$start, $end]);
            })
            ->groupBy('reporting_start')
            ->orderBy('reporting_start')
            ->get();

        return response()->json($rows);
    }

    public function getDailyProfit(Request $request){
        $start = $request->input('start_date');
        $end = $request->input('end_date');

        $query = DB::table('meta_creative_metrics')
            ->select(
                DB::raw('DATE(reporting_start) as date'),
                DB::raw('SUM(profit) as total_profit')
            )
            ->whereBetween('reporting_start', [$start, $end])
            ->groupBy('date')
            ->orderBy('date');

        $data = $query->get();
        
        return response()->json($data);
    }
}
