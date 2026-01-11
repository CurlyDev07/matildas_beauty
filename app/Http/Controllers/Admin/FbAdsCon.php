<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\FbAds;
use App\FbEventListener;
use Illuminate\Support\Facades\DB;
use App\Store;
use App\User;
use App\StatusReason;
use App\StatusDetail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\MetaCreativeMetric;
use App\OrderSource;
use PhpOffice\PhpSpreadsheet\IOFactory;


class FbAdsCon extends Controller
{

    // public function index(Request $request){

    //     // Get grouped counts
    //     $grouped = FbAds::select('status', DB::raw('count(*) as total'))
    //         ->when(!$request->date, function($q){ // Show DEFAULT DATA For TODAY
    //             return $q->whereDate('created_at', now());
    //         })->when($request->date, function($q){
    //             $date = explode(" - ",request()->date);
    //             $from = carbon($date[0]);
    //             $to = carbon($date[1]);

    //             if ($from == $to) {
    //                 return $q->whereDate('created_at', $from);
    //             }

    //             return $q->whereBetween('created_at', [$from, $to]);
    //         })// FILTER DATE
    //         ->groupBy('status')
    //         ->get();

    //     // Get total count of all records
    //     $overallTotal = $grouped->sum('total');

    //     // Map into array with percentage
    //     $statusCounts = $grouped->mapWithKeys(function ($item) use ($overallTotal) {
    //         $percentage = $overallTotal > 0 ? round(($item->total / $overallTotal) * 100, 2) : 0;
    //         return [
    //             $item->status => [
    //                 'count' => $item->total,
    //                 'percent' => $percentage
    //             ]
    //         ];
    //     });
        
    //     // dd($statusCounts);

    //     // ======================== STATUS COUNT ========================


    //     $stores = Store::all();

    //     $orders = FbAds::orderBy('created_at', 'desc')
    //     ->when(!$request->date, function($q){
    //         return $q->whereDate('created_at', now());
    //     })// Show DEFAULT DATA For TODAY
    //     ->when($request->date, function($q){
    //         $date = explode(" - ",request()->date);
    //         $from = carbon($date[0]);
    //         $to = carbon($date[1]);

    //         if ($from == $to) {
    //             return $q->whereDate('created_at', $from);
    //         }

    //         return $q->whereBetween('created_at', [$from, $to]);
    //     })// FILTER DATE
    //     ->when($request->status, function($q){
    //         return $q->where('status', request()->status);
    //     })// Filter by STATUS
    //     ->get();

    //     return view('admin.fbads.index', [
    //         'orders' => $orders,
    //         'stores' => $stores,
    //         'statusCounts' => $statusCounts
    //     ]);
    // }


    public function index(Request $request){

    $search = trim((string) $request->search);
    $users = User::where('role', '!=', 'user')->get();
    
    $grouped = FbAds::select('status', DB::raw('count(*) as total'))
        ->when(!$request->date, function($q) use ($request){
            // ✅ ignore default date filter when searching
            if ($request->filled('search')) {
                return $q;
            }
            return $q->whereDate('created_at', now());
        })
        ->when($request->date, function($q){
            $date = explode(" - ",request()->date);
            $from = carbon($date[0]);
            $to = carbon($date[1]);
            if ($from == $to) {
                return $q->whereDate('created_at', $from);
            }
            return $q->whereBetween('created_at', [$from, $to]);
        })
        // ✅ SEARCH: phone_number OR full_name OR address
        ->when($search !== '', function($q) use ($search){
            return $q->where(function($qq) use ($search){
                $qq->where('phone_number', 'LIKE', '%' . $search . '%')
                   ->orWhere('full_name', 'LIKE', '%' . $search . '%')
                   ->orWhere('address', 'LIKE', '%' . $search . '%');
            });
        })

        // ✅ SEARCH: user
        ->when($request->agent, function ($q) use ($request) {
            $q->where('user_id', $request->agent);
        })


        ->groupBy('status')
        ->get();

    $overallTotal = $grouped->sum('total');

    $statusCounts = $grouped->mapWithKeys(function ($item) use ($overallTotal) {
        $percentage = $overallTotal > 0 ? round(($item->total / $overallTotal) * 100, 2) : 0;
        return [
            $item->status => [
                'count' => $item->total,
                'percent' => $percentage
            ]
        ];
    });

    // ======================== STATUS COUNT ========================

    $stores = Store::all();

    // UPDATED QUERY HERE
    $orders = FbAds::with('upsells') // <--- ADD THIS LINE (Eager Loading)
        ->orderBy('created_at', 'desc')
        ->when(!$request->date, function($q) use ($request){
            // ✅ ignore default date filter when searching
            if ($request->filled('search')) {
                return $q;
            }
            return $q->whereDate('created_at', now());
        })
        ->when($request->date, function($q){
            $date = explode(" - ",request()->date);
            $from = carbon($date[0]);
            $to = carbon($date[1]);

            if ($from == $to) {
                return $q->whereDate('created_at', $from);
            }

            return $q->whereBetween('created_at', [$from, $to]);
        })
        ->when($request->status, function($q){
            return $q->where('status', request()->status);
        })
        // ✅ SEARCH: phone_number OR full_name OR address
        ->when($search !== '', function($q) use ($search){
            return $q->where(function($qq) use ($search){
                $qq->where('phone_number', 'LIKE', '%' . $search . '%')
                   ->orWhere('full_name', 'LIKE', '%' . $search . '%')
                   ->orWhere('address', 'LIKE', '%' . $search . '%');
            });
        })
        // ✅ SEARCH: user
        ->when($request->agent, function ($q) use ($request) {
            $q->where('user_id', $request->agent);
        })
        ->get();

    return view('admin.fbads.index', [
        'orders' => $orders,
        'stores' => $stores,
        'statusCounts' => $statusCounts,
        'users' => $users
    ]);
}



    public function dashboard(){
        $now = Carbon::now();

        // -------------------------
        // TIME RANGES
        // -------------------------
        $today = $now->toDateString();
        $startOfWeek = $now->copy()->startOfWeek();
        $endOfWeek = $now->copy()->endOfWeek();
        $startOfMonth = $now->copy()->startOfMonth();
        $endOfMonth = $now->copy()->endOfMonth();
        $sevenDaysAgo = $now->copy()->subDays(6);
        $thirtyDaysAgo = $now->copy()->subDays(29);

        // -------------------------
        // TOTALS (Orders & Revenue)
        // -------------------------
        $totalOrdersToday = FbAds::whereDate('created_at', $today)->count();
        $totalRevenueToday = FbAds::whereDate('created_at', $today)->sum('total');

        $totalOrdersThisWeek = FbAds::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
        $totalRevenueThisWeek = FbAds::whereBetween('created_at', [$startOfWeek, $endOfWeek])->sum('total');

        $totalOrdersThisMonth = FbAds::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();
        $totalRevenueThisMonth = FbAds::whereBetween('created_at', [$startOfMonth, $endOfMonth])->sum('total');

        // -------------------------
        // ORDERS PER DAY (This Month)
        // -------------------------
        $days = collect();

        $currentDate = $startOfMonth->copy();
        while ($currentDate <= $now) {
            $label = $currentDate->format('M d');
            $count = FbAds::whereDate('created_at', $currentDate->toDateString())->count();

            $days->push($label);
            $currentDate->addDay();
        }

        // -------------------------
        // ORDERS BY PROMO
        // -------------------------
        $ordersByPromoToday = FbAds::select('promo', DB::raw('COUNT(*) as count'))
            ->whereDate('created_at', $today)
            ->groupBy('promo')
            ->get();

        $ordersByPromo7 = FbAds::select('promo', DB::raw('COUNT(*) as count'))
            ->whereBetween('created_at', [$sevenDaysAgo, $now])
            ->groupBy('promo')
            ->get();

        $ordersByPromo30 = FbAds::select('promo', DB::raw('COUNT(*) as count'))
            ->whereBetween('created_at', [$thirtyDaysAgo, $now])
            ->groupBy('promo')
            ->get();

        // -------------------------
        // ORDER STATUS SUMMARY (TODAY, 7, 30 DAYS)
        // -------------------------
        function getStatusData($startDate, $endDate) {
            $query = FbAds::select('status', DB::raw('COUNT(*) as count'))
                ->whereBetween('created_at', [$startDate, $endDate])
                ->groupBy('status')
                ->get();

            $labels = $query->pluck('status');
            $values = $query->pluck('count');
            $total = $values->sum();

            $percentages = $query->map(function ($item) use ($total) {
                return $total > 0 ? round(($item->count / $total) * 100, 2) : 0;
            });

            return [
                'labels' => $labels,
                'values' => $values,
                'percentages' => $percentages
            ];
        }

        $statusToday = getStatusData($today, now());
        $status7 = getStatusData($sevenDaysAgo, now());
        $status30 = getStatusData($thirtyDaysAgo, now());

        // -------------------------
        // ORDERS & REVENUE BY HOUR
        // -------------------------
        function getOrdersAndRevenuePerHour($startDate, $endDate) {
            $data = FbAds::whereBetween('created_at', [$startDate, $endDate])
                ->selectRaw('HOUR(created_at) as hour, COUNT(*) as orders, SUM(total) as revenue')
                ->groupBy('hour')
                ->orderBy('hour')
                ->get();

            $labels = collect(range(0, 23))->map(function ($h) {
                return sprintf('%02d:00', $h);
            });

            $orders = $labels->map(function ($label) use ($data) {
                $hour = (int) substr($label, 0, 2);
                return (int) optional($data->firstWhere('hour', $hour))->orders ?? 0;
            });

            $revenue = $labels->map(function ($label) use ($data) {
                $hour = (int) substr($label, 0, 2);
                return (int) optional($data->firstWhere('hour', $hour))->revenue ?? 0;
            });

            return [
                'labels' => $labels,
                'orders' => $orders,
                'revenue' => $revenue
            ];
        }

        $ordersRevenueToday = getOrdersAndRevenuePerHour(Carbon::today(), Carbon::today()->endOfDay());
        $ordersRevenue7 = getOrdersAndRevenuePerHour(Carbon::today()->subDays(6), now());
        $ordersRevenue30 = getOrdersAndRevenuePerHour(Carbon::today()->subDays(29), now());

        // // -------------------------
        // // AVERAGE ORDER VALUE (AOV)
        // // -------------------------
        // function getAOV($startDate, $endDate) {
        //     $orders = FbAds::whereBetween('created_at', [$startDate, $endDate])->count();
        //     $revenue = FbAds::whereBetween('created_at', [$startDate, $endDate])->sum('total');
        //     return $orders > 0 ? round($revenue / $orders, 2) : 0;
        // }

        // $aovToday = getAOV(Carbon::today(), Carbon::today()->endOfDay());
        // $aovWeek = getAOV(Carbon::today()->subDays(6), now());
        // $aovMonth = getAOV(Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth());

        // -------------------------
        // CUSTOMER LIFETIME VALUE (CLV)
        // -------------------------
        $ltvData = FbAds::select('phone_number', DB::raw('SUM(total) as revenue'), DB::raw('COUNT(*) as orders'))
            ->groupBy('phone_number')
            ->orderByDesc('revenue')
            ->take(30) // Top 10 highest LTV
            ->get();

        // -------------------------
        // AVERAGE ORDER VALUE (AOV) - Including Upsells
        // -------------------------

        // Today
        $statsToday = DB::table('fb_ads')
            ->leftJoin('fb_ads_upsell', 'fb_ads.id', '=', 'fb_ads_upsell.fb_ads_id')
            ->whereBetween('fb_ads.created_at', [Carbon::today(), Carbon::today()->endOfDay()])
            ->selectRaw('COUNT(DISTINCT fb_ads.id) as total_orders, SUM(fb_ads.total) as base_total, COALESCE(SUM(fb_ads_upsell.amount), 0) as upsell_total')
            ->first();
        $new_aovToday = $statsToday->total_orders > 0 ? round(($statsToday->base_total + $statsToday->upsell_total) / $statsToday->total_orders, 2) : 0;

        // This Week
        $statsWeek = DB::table('fb_ads')
            ->leftJoin('fb_ads_upsell', 'fb_ads.id', '=', 'fb_ads_upsell.fb_ads_id')
            ->whereBetween('fb_ads.created_at', [$startOfWeek, $endOfWeek])
            ->selectRaw('COUNT(DISTINCT fb_ads.id) as total_orders, SUM(fb_ads.total) as base_total, COALESCE(SUM(fb_ads_upsell.amount), 0) as upsell_total')
            ->first();
        $new_aovWeek = $statsWeek->total_orders > 0 ? round(($statsWeek->base_total + $statsWeek->upsell_total) / $statsWeek->total_orders, 2) : 0;

        // This Month
        $statsMonth = DB::table('fb_ads')
            ->leftJoin('fb_ads_upsell', 'fb_ads.id', '=', 'fb_ads_upsell.fb_ads_id')
            ->whereBetween('fb_ads.created_at', [$startOfMonth, $endOfMonth])
            ->selectRaw('COUNT(DISTINCT fb_ads.id) as total_orders, SUM(fb_ads.total) as base_total, COALESCE(SUM(fb_ads_upsell.amount), 0) as upsell_total')
            ->first();
        $new_aovMonth = $statsMonth->total_orders > 0 ? round(($statsMonth->base_total + $statsMonth->upsell_total) / $statsMonth->total_orders, 2) : 0;



        // You already have these from the AOV calculation:
        $upsellToday = $statsToday->upsell_total ?? 0;
        $upsellWeek = $statsWeek->upsell_total ?? 0;
        $upsellMonth = $statsMonth->upsell_total ?? 0;


        // -------------------------
        // UPSELL RATE - Percentage of orders with upsells
        // -------------------------

        // Today
        $ordersWithUpsellToday = DB::table('fb_ads')
            ->join('fb_ads_upsell', 'fb_ads.id', '=', 'fb_ads_upsell.fb_ads_id')
            ->whereBetween('fb_ads.created_at', [Carbon::today(), Carbon::today()->endOfDay()])
            ->distinct('fb_ads.id')
            ->count('fb_ads.id');
        $upsellRateToday = $statsToday->total_orders > 0 ? round(($ordersWithUpsellToday / $statsToday->total_orders) * 100, 2) : 0;

        // This Week
        $ordersWithUpsellWeek = DB::table('fb_ads')
            ->join('fb_ads_upsell', 'fb_ads.id', '=', 'fb_ads_upsell.fb_ads_id')
            ->whereBetween('fb_ads.created_at', [$startOfWeek, $endOfWeek])
            ->distinct('fb_ads.id')
            ->count('fb_ads.id');
        $upsellRateWeek = $statsWeek->total_orders > 0 ? round(($ordersWithUpsellWeek / $statsWeek->total_orders) * 100, 2) : 0;

        // This Month
        $ordersWithUpsellMonth = DB::table('fb_ads')
            ->join('fb_ads_upsell', 'fb_ads.id', '=', 'fb_ads_upsell.fb_ads_id')
            ->whereBetween('fb_ads.created_at', [$startOfMonth, $endOfMonth])
            ->distinct('fb_ads.id')
            ->count('fb_ads.id');
        $upsellRateMonth = $statsMonth->total_orders > 0 ? round(($ordersWithUpsellMonth / $statsMonth->total_orders) * 100, 2) : 0;

        // -------------------------
        // RETURN TO VIEW
        // -------------------------
        return view('admin.fbads.dashboard', compact(
            'totalOrdersToday',
            'totalRevenueToday',
            'totalOrdersThisWeek',
            'totalRevenueThisWeek',
            'totalOrdersThisMonth',
            'totalRevenueThisMonth',
            'days',
            'ordersByPromoToday',
            'ordersByPromo7',
            'ordersByPromo30',
            'statusToday',
            'status7',
            'status30',
            'ordersRevenueToday',
            'ordersRevenue7',
            'ordersRevenue30',
            'new_aovToday',
            'new_aovWeek',
            'new_aovMonth',
            'upsellToday',
            'upsellWeek',
            'upsellMonth',
            'ltvData',
            'upsellRateToday',
            'upsellRateWeek',
            'upsellRateMonth'
        ));
    }

    
    public function meta_metrics(Request $request){

        return view('admin.fbads.meta_metrics');
    }
  
    public function meta_metrics_post(Request $request){
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls'
        ]);

        $file = $request->file('excel_file');
        $spreadsheet = IOFactory::load($file->getRealPath());
        $sheet = $spreadsheet->getSheet(0)->toArray();

        $header = $sheet[0];
        $rows = array_slice($sheet, 1);
        $inserted = 0;
        $skipped = [];

        foreach ($rows as $row) {
            $data = array_combine($header, $row);

            if (empty($data['Ad name']) || empty($data['Reporting starts']) || empty($data['Reporting ends'])) {
                continue;
            }

            $exists = MetaCreativeMetric::where('reporting_start', date('Y-m-d', strtotime($data['Reporting starts'])))
                ->where('reporting_end', date('Y-m-d', strtotime($data['Reporting ends'])))
                ->where('ad_name', $data['Ad name'])
                ->exists();

            if ($exists) {
                $skipped[] = $data['Ad name'];
                continue;
            }

            MetaCreativeMetric::create([
                'reporting_start' => date('Y-m-d', strtotime($data['Reporting starts'])),
                'reporting_end' => date('Y-m-d', strtotime($data['Reporting ends'])),
                'ad_name' => $data['Ad name'] ?? null,
                'campaign_name' => $data['Campaign name'] ?? null,
                'ad_set_name' => $data['Ad set name'] ?? null,
                'ad_set_budget' => $data['Ad set budget'] ?? null,
                'ad_set_budget_type' => $data['Ad set budget type'] ?? null,
                'amount_spent' => $data['Amount spent (PHP)'] ?? null,
                'purchases' => $data['Purchases'] ?? null,
                'purchases_conversion_value' => $data['Purchases conversion value'] ?? null,
                'cost_per_purchase' => $data['Cost per purchase (PHP)'] ?? null,
                'purchase_roas' => $data['Purchase ROAS (return on ad spend)'] ?? null,
                'impressions' => $data['Impressions'] ?? null,
                'reach' => $data['Reach'] ?? null,
                'frequency' => $data['Frequency'] ?? null,
                'ctr_all' => $data['CTR (all)'] ?? null,
                'ctr_link_click' => $data['CTR (link click-through rate)'] ?? null,
                'outbound_clicks' => $data['Outbound clicks'] ?? null,
                'landing_page_views' => $data['Landing page views'] ?? null,
                'video_plays_3s' => $data['3-second video plays'] ?? null,
                'video_thruplays' => $data['ThruPlays'] ?? null,
                'cost_per_thruplay' => $data['Cost per ThruPlay (PHP)'] ?? null,
                'video_plays_25' => $data['Video plays at 25%'] ?? null,
                'video_plays_50' => $data['Video plays at 50%'] ?? null,
                'video_plays_75' => $data['Video plays at 75%'] ?? null,
                'video_avg_play_time' => $data['Video average play time'] ?? null,
                'cpm' => $data['CPM (cost per 1,000 impressions) (PHP)'] ?? null,
                'quality_ranking' => $data['Quality ranking'] ?? null,
                'engagement_rate_ranking' => $data['Engagement rate ranking'] ?? null,
                'conversion_rate_ranking' => $data['Conversion rate ranking'] ?? null,
                'adds_to_cart' => $data['Adds to cart'] ?? null,
                'adds_to_cart_conversion_value' => $data['Adds to cart conversion value'] ?? null,
                'cost_per_add_to_cart' => $data['Cost per add to cart (PHP)'] ?? null,
                'checkouts_initiated' => $data['Checkouts initiated'] ?? null,
                'checkouts_initiated_conversion_value' => $data['Checkouts initiated conversion value'] ?? null,
                'cost_per_checkout_initiated' => $data['Cost per checkout initiated (PHP)'] ?? null,
                'profit' => $data['Profit'] ?? null,
                'conversion_rate' => $data['Conversion Rate'] ?? null,
                'view_rate_25' => $data['25% View Rate'] ?? null,
                'retention_50_from_25' => $data['50% Retention from 25%'] ?? null,
                'retention_75_from_50' => $data['75% Retention from 50%'] ?? null,
                'link_clicks' => $data['Link clicks'] ?? null,
                'cpc' => $data['CPC (cost per link click) (PHP)'] ?? null,
                'cost_per_landing_page_view' => $data['Cost per landing page view (PHP)'] ?? null,
                'hold_rate' => $data['Hold Rate'] ?? null,
            ]);

            $inserted++;
        }

        return back()->with([
            'success' => "$inserted rows inserted.",
            'skipped' => $skipped,
        ]);

    }


    public function create(){
        $sources = \App\OrderSource::active()
            ->orderBy('type')
            ->orderBy('name')
            ->get();

            return view('admin.fbads.create', compact('sources'));
    }

    public function store(){
        // dd(request()->all());
        $order = FbAds::create(request()->all() + ['province' => '', 'city' => '', 'barangay' => '']);
        

       return redirect()->route('fbads.index');
    }

    public function order($id){
        $order = FbAds::with('source')->find($id);
        $sources = \App\OrderSource::active()
            ->orderBy('type')
            ->orderBy('name')
            ->get();


        return view('admin.fbads.order', ['order' => $order, 'sources' => $sources]);
    }

    public function patch(){
        
        FbAds::find(request()->id)->update(request()->all());
        
        return redirect()->back()->with('success', 'update successful');
    }

    public function event_listener(Request $request){
        $events = FbEventListener::groupBy('data')->select('data', DB::raw('count(*) as total'))
        ->when(!$request->date, function($q){
            return $q->whereDate('created_at', now());
        })// Show DEFAULT DATA For Today
        ->when($request->date, function($q){
            $date = explode(" - ",request()->date);
            $from = carbon($date[0]);
            $to = carbon($date[1]);

            if ($from == $to) {
                return $q->whereDate('created_at', $from);
            }

            return $q->whereBetween('created_at', [$from, $to]);
        })// FILTER DATE
        ->orderBy('data', 'desc')
        ->get();


        return view('admin.fbads.event_listener', ['events' => $events]);
    }

    public function events(Request $request)
    {
        $dateQuery = function ($query) use ($request) {

            // ✅ If searching → ignore default "today" filter (search across ALL dates)
            if ($request->filled('search')) {
                return $query;
            }

            // ✅ Default: show today's records only (when no date filter is provided)
            if (!$request->date) {
                return $query->whereDate('created_at', now());
            }

            [$from, $to] = array_map('carbon', explode(" - ", $request->date));

            return $from->isSameDay($to)
                ? $query->whereDate('created_at', $from)
                : $query->whereBetween('created_at', [$from, $to]);
        };

        // 🔍 Search keyword (trimmed)
        $search = trim((string) $request->search);

        $contact_number = FbAds::select('phone_number')
            ->tap($dateQuery)
            ->pluck('phone_number')
            ->all();

        // Get main events
        $events = FbEventListener::select('data', 'value', 'session_id', 'website')
            ->where('data', 'phone_number')
            ->tap($dateQuery)
            ->when($search !== '', function ($query) use ($search) {
                $query->where('value', 'LIKE', '%' . $search . '%');
            })
            ->latest('id')
            ->paginate(50)
            ->appends($request->except('page'));

        // Get ALL session IDs from current page
        $sessionIds = $events->pluck('session_id')
            ->filter()
            ->unique()
            ->toArray();

        // Single query to get all details for all sessions on this page
        $allDetails = FbEventListener::select('session_id', 'data', 'value')
            ->whereIn('session_id', $sessionIds)
            ->whereIn('data', ['full_name', 'address'])
            ->get()
            ->groupBy('session_id');

        return view('admin.fbads.events', compact('events', 'contact_number', 'allDetails'));
    }



    public function change_status(){
        $fbAd = FbAds::find(request()->id);
        
        if (!$fbAd) {
            return response(['error' => 'Record not found'], 404);
        }
        
        // Map your statuses to flow IDs
        $statusToFlowMapping = [
            'TO CALL' => 1,
            'CANCELLED' => 2,
            'DELETE' => 3,
        ];
        
        if (request()->status == "DELETE") {
            $fbAd->delete();
            $this->sendStatusSMS(request()->phone_number, request()->full_name ?? 'Customer', 3);
        } else {
            $fbAd->update([
                'status' => request()->status,
                'user_id' => auth()->user()->id
            ]);
            
            if (isset($statusToFlowMapping[request()->status])) {
                $statusCode = $statusToFlowMapping[request()->status];
                $this->sendStatusSMS(request()->phone_number, request()->full_name ?? 'Customer', $statusCode);
            }
        }

        return response(['success' => 'Success!']);
    }

    private function sendStatusSMS($phoneNumber, $name, $statusCode)
    {
        try {
            $url = 'http://52.41.148.38/api/v1/customer/register-status';
            
            $data = [
                'name' => $name,
                'mobile_number' => $phoneNumber,
                'status' => $statusCode
            ];

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Accept: application/json'
            ]);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $curlError = curl_error($ch);
            curl_close($ch);

            $result = json_decode($response, true);

            \Log::info('SMS Status Change', [
                'phone_number' => $phoneNumber,
                'name' => $name,
                'status_code' => $statusCode,
                'http_code' => $httpCode,
                'response' => $result,
                'curl_error' => $curlError
            ]);

            return $httpCode == 200 && !empty($result['success']);
            
        } catch (\Exception $e) {
            \Log::error('SMS API Error', [
                'phone_number' => $phoneNumber,
                'error' => $e->getMessage()
            ]);
            
            return false;
        }
    }

    public function status_details(Request $request){
    
        $search = $request->query('search');

        $status_details = StatusDetail::with([
            'fbAd:id,full_name,phone_number',
            'reason:id,reason,category,img'
        ])->when($search, function ($query) use ($search) {
            $query->whereHas('fbAd', function ($q) use ($search) {
                $q->where('phone_number', 'like', '%' . $search . '%');
            });
        })->get();
        
        // dd($status_details);

        return view('admin.fbads.status_details', compact('status_details'));
    }
    public function change_status_problematic(Request $request){
        $previous_status = FbAds::where('id', $request['id'])->first('status')->status;
        $fbads_id = $request['id'];
        $new_status = $request->status;
        $admin_name = auth()->user()->first_name;

        return view('admin.fbads.status_details_create', compact('previous_status', 'new_status', 'admin_name', 'fbads_id'));
    }

    public function status_details_store(Request $request){
        $request->validate([
            'reason'          => 'required|string|max:255',
            'category'        => 'nullable|string|max:255',
            'previous_status' => 'required|string',
            'new_status'      => 'required|string',
            'admin_name'      => 'required|string|max:255',
            'fbads_id'        => 'required|integer|exists:fb_ads,id',
            'file'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = null;
        $domain = 'https://matildasbeautybucket.s3.ap-southeast-1.amazonaws.com';

        // Handle file upload to S3
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $uuid = Str::uuid();
            $ext = $file->getClientOriginalExtension();
            $imgName = "$uuid.$ext";
            $path = '/images/status/';
            $fullPath = $path . 'original-' . $imgName;

            $base64Image = 'data:' . $file->getMimeType() . ';base64,' . base64_encode(file_get_contents($file));
            upload_resize_product_image($fullPath, $base64Image, 'original');
            $imagePath = $fullPath;
        }

        // Save to status_reasons
        $reason = StatusReason::create([
            'reason'   => $request->reason,
            'category' => $request->category,
            'img'      => $imagePath ? $domain . $imagePath : null,
        ]);

        // Save to status_details
        $statusDetail = StatusDetail::create([
            'fb_ad_id'        => $request->fbads_id,
            'status_reason_id'=> $reason->id,
            'previous_status' => $request->previous_status,
            'new_status'      => $request->new_status,
            'admin_name'      => $request->admin_name,
            'remarks'         => null,
        ]);

        // Update fb_ads table
        FbAds::where('id', $request->fbads_id)->update([
            'status'           => $request->new_status,
            'statusdetails_id' => $statusDetail->id,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('fbads.status_details');
    }
    
    public function getOrdersChart(Request $request)
    {
        $filter = $request->get('filter', 'last30'); // Default to last 30 days
        $customDate = $request->get('date');
        
        \Log::info('getOrdersChart called', ['filter' => $filter, 'date' => $customDate]);
        
        $categories = [];
        $orders = [];
        $revenue = [];
        
        switch ($filter) {
            case 'last30':
                // Last 30 days
                $data = FbAds::selectRaw('DATE(created_at) as date, COUNT(*) as total, SUM(total) as revenue')
                    ->whereBetween('created_at', [now()->subDays(29)->startOfDay(), now()->endOfDay()])
                    ->groupBy('date')
                    ->orderBy('date', 'asc')
                    ->get();
                
                $categories = $data->pluck('date')->map(fn($d) => \Carbon\Carbon::parse($d)->format('M d'));
                $orders = $data->pluck('total');
                $revenue = $data->pluck('revenue');
                break;
                
            case 'month':
                // This Month (current month)
                $data = FbAds::selectRaw('DATE(created_at) as date, COUNT(*) as total, SUM(total) as revenue')
                    ->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year)
                    ->groupBy('date')
                    ->orderBy('date', 'asc')
                    ->get();
                
                $categories = $data->pluck('date')->map(fn($d) => \Carbon\Carbon::parse($d)->format('M d'));
                $orders = $data->pluck('total');
                $revenue = $data->pluck('revenue');
                break;
                
            case 'lastmonth':
                // Last Month
                $lastMonth = now()->subMonth();
                $data = FbAds::selectRaw('DATE(created_at) as date, COUNT(*) as total, SUM(total) as revenue')
                    ->whereMonth('created_at', $lastMonth->month)
                    ->whereYear('created_at', $lastMonth->year)
                    ->groupBy('date')
                    ->orderBy('date', 'asc')
                    ->get();
                
                $categories = $data->pluck('date')->map(fn($d) => \Carbon\Carbon::parse($d)->format('M d'));
                $orders = $data->pluck('total');
                $revenue = $data->pluck('revenue');
                break;
                
            case 'year':
                // Full Year (Jan to present) - Monthly data
                $data = FbAds::selectRaw('MONTH(created_at) as month, COUNT(*) as total, SUM(total) as revenue')
                    ->whereYear('created_at', now()->year)
                    ->groupBy('month')
                    ->orderBy('month', 'asc')
                    ->get();
                
                $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                $categories = $data->pluck('month')->map(fn($m) => $months[$m - 1]);
                $orders = $data->pluck('total');
                $revenue = $data->pluck('revenue');
                break;
                
            case 'custom':
                if ($customDate) {
                    $dates = explode(" - ", $customDate);
                    $from = \Carbon\Carbon::createFromFormat('m/d/Y', trim($dates[0]))->startOfDay();
                    $to = \Carbon\Carbon::createFromFormat('m/d/Y', trim($dates[1]))->endOfDay();
                    
                    $data = FbAds::selectRaw('DATE(created_at) as date, COUNT(*) as total, SUM(total) as revenue')
                        ->whereBetween('created_at', [$from, $to])
                        ->groupBy('date')
                        ->orderBy('date', 'asc')
                        ->get();
                    
                    $categories = $data->pluck('date')->map(fn($d) => \Carbon\Carbon::parse($d)->format('M d'));
                    $orders = $data->pluck('total');
                    $revenue = $data->pluck('revenue');
                }
                break;
        }
        
        $response = [
            'categories' => $categories->toArray(),
            'orders' => $orders->toArray(),
            'revenue' => $revenue->map(fn($r) => (float)$r)->toArray(),
            'summary' => [
                'total_orders' => $orders->sum(),
                'total_revenue' => $revenue->sum(),
                'avg_order_value' => $orders->sum() > 0 
                    ? round($revenue->sum() / $orders->sum(), 2) 
                    : 0
            ]
        ];
        
        \Log::info('Response data', $response);
        
        return response()->json($response);
    }

    public function getOrderHeatmap(Request $request)
    {
        $filter = $request->get('filter', 'last30');
        
        $query = FbAds::query();
        
        // Apply date filter
        switch ($filter) {
            case 'last30':
                $startDate = now()->subDays(29)->startOfDay();
                $endDate = now()->endOfDay();
                $query->whereBetween('created_at', [$startDate, $endDate]);
                break;
            case 'month':
                $startDate = now()->startOfMonth();
                $endDate = now()->endOfDay();
                $query->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year);
                break;
            case 'lastmonth':
                $lastMonth = now()->subMonth();
                $startDate = $lastMonth->startOfMonth();
                $endDate = $lastMonth->endOfMonth();
                $query->whereMonth('created_at', $lastMonth->month)
                    ->whereYear('created_at', $lastMonth->year);
                break;
            case 'year':
                $startDate = now()->startOfYear();
                $endDate = now()->endOfDay();
                $query->whereYear('created_at', now()->year);
                break;
            default:
                $startDate = now()->subDays(29)->startOfDay();
                $endDate = now()->endOfDay();
        }
        
        // Get orders grouped by day of week and hour
        $data = $query->selectRaw('
                DAYOFWEEK(created_at) as day_of_week,
                HOUR(created_at) as hour,
                COUNT(*) as count
            ')
            ->groupBy('day_of_week', 'hour')
            ->get();
        
        // Calculate number of weeks in the period for averaging
        $daysDiff = $startDate->diffInDays($endDate) + 1;
        $weeksInPeriod = ceil($daysDiff / 7);
        
        // Build heatmap data structure
        $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        $hours = range(0, 23);
        
        $heatmapData = [];
        
        foreach ($days as $dayIndex => $dayName) {
            $dayData = [];
            
            foreach ($hours as $hour) {
                $mysqlDayIndex = $dayIndex + 1;
                
                $count = $data->where('day_of_week', $mysqlDayIndex)
                            ->where('hour', $hour)
                            ->first();
                
                // Calculate average per occurrence
                $totalCount = $count ? $count->count : 0;
                $avgCount = $weeksInPeriod > 0 ? round($totalCount / $weeksInPeriod, 1) : 0;
                
                $dayData[] = [
                    'x' => sprintf('%02d:00', $hour),
                    'y' => $avgCount // Using average instead of total
                ];
            }
            
            $heatmapData[] = [
                'name' => $dayName,
                'data' => $dayData
            ];
        }
        
        // Calculate summary stats
        $totalOrders = $data->sum('count');
        $peakHour = $data->sortByDesc('count')->first();
        
        $dayTotals = $data->groupBy('day_of_week')->map(function($day) {
            return $day->sum('count');
        })->sortByDesc(function($count) {
            return $count;
        });
        
        $peakDay = $dayTotals->keys()->first();
        
        return response()->json([
            'heatmap' => $heatmapData,
            'summary' => [
                'total_orders' => $totalOrders,
                'peak_hour' => $peakHour ? sprintf('%s at %02d:00', $days[$peakHour->day_of_week - 1], $peakHour->hour) : 'N/A',
                'peak_day' => $peakDay ? $days[$peakDay - 1] : 'N/A',
                'busiest_orders' => $peakHour ? $peakHour->count : 0,
                'period_weeks' => $weeksInPeriod
            ]
        ]);
    }

    public function getTopProducts(Request $request)
    {

        try {
        $filter = $request->get('filter', 'last30');
        $limit = 10;
        
        // Build base query
        $query = FbAds::query();
        
        // Apply date filter
        switch ($filter) {
            case 'last30':
                $query->whereBetween('created_at', [now()->subDays(29)->startOfDay(), now()->endOfDay()]);
                break;
            case 'month':
                $query->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year);
                break;
            case 'lastmonth':
                $lastMonth = now()->subMonth();
                $query->whereMonth('created_at', $lastMonth->month)
                    ->whereYear('created_at', $lastMonth->year);
                break;
            case 'year':
                $query->whereYear('created_at', now()->year);
                break;
        }
        
        // Get top products by order count
        $topByOrders = $query->selectRaw('promo, COUNT(*) as order_count, SUM(total) as total_revenue')
            ->groupBy('promo')
            ->orderByRaw('COUNT(*) DESC')
            ->limit($limit)
            ->get();
        
        // Get top products by revenue (fresh query)
        $queryRevenue = FbAds::query();
        
        switch ($filter) {
            case 'last30':
                $queryRevenue->whereBetween('created_at', [now()->subDays(29)->startOfDay(), now()->endOfDay()]);
                break;
            case 'month':
                $queryRevenue->whereMonth('created_at', now()->month)
                            ->whereYear('created_at', now()->year);
                break;
            case 'lastmonth':
                $lastMonth = now()->subMonth();
                $queryRevenue->whereMonth('created_at', $lastMonth->month)
                            ->whereYear('created_at', $lastMonth->year);
                break;
            case 'year':
                $queryRevenue->whereYear('created_at', now()->year);
                break;
        }
        
        $topByRevenue = $queryRevenue->selectRaw('promo, COUNT(*) as order_count, SUM(total) as total_revenue')
            ->groupBy('promo')
            ->orderByRaw('SUM(total) DESC')
            ->limit($limit)
            ->get();
        
        // Prepare response
        $byOrders = [
            'products' => [],
            'orders' => [],
            'revenue' => [],
            'aov' => []
        ];
        
        foreach ($topByOrders as $product) {
            $byOrders['products'][] = $product->promo;
            $byOrders['orders'][] = (int)$product->order_count;
            $byOrders['revenue'][] = (float)$product->total_revenue;
            $byOrders['aov'][] = round($product->total_revenue / $product->order_count, 2);
        }
        
        $byRevenue = [
            'products' => [],
            'orders' => [],
            'revenue' => [],
            'aov' => []
        ];
        
        foreach ($topByRevenue as $product) {
            $byRevenue['products'][] = $product->promo;
            $byRevenue['orders'][] = (int)$product->order_count;
            $byRevenue['revenue'][] = (float)$product->total_revenue;
            $byRevenue['aov'][] = round($product->total_revenue / $product->order_count, 2);
        }
        
        return response()->json([
            'by_orders' => $byOrders,
            'by_revenue' => $byRevenue,
            'summary' => [
                'total_products' => FbAds::distinct('promo')->count('promo'),
                'top_product' => $topByOrders->first() ? $topByOrders->first()->promo : 'N/A',
                'top_revenue_product' => $topByRevenue->first() ? $topByRevenue->first()->promo : 'N/A'
            ]
        ]);

        } catch (\Exception $e) {
            \Log::error('Top Products Error: ' . $e->getMessage());
            return response()->json([
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ], 500);
        }
    }

    public function getCustomerRepeatRate(Request $request)
    {
        try {
            $filter = $request->get('filter', 'last30');
            
            $query = FbAds::query();
            
            // Apply date filter
            switch ($filter) {
                case 'last30':
                    $query->whereBetween('created_at', [now()->subDays(29)->startOfDay(), now()->endOfDay()]);
                    break;
                case 'month':
                    $query->whereMonth('created_at', now()->month)
                        ->whereYear('created_at', now()->year);
                    break;
                case 'lastmonth':
                    $lastMonth = now()->subMonth();
                    $query->whereMonth('created_at', $lastMonth->month)
                        ->whereYear('created_at', $lastMonth->year);
                    break;
                case 'year':
                    // ALL TIME DATA - No filter!
                    // This shows all customers ever
                    break;
            }
            
            // Get customer order counts
            $customerOrders = $query->selectRaw('phone_number, COUNT(*) as order_count')
                ->groupBy('phone_number')
                ->get();
            
            $totalCustomers = $customerOrders->count();
            $repeatCustomers = $customerOrders->filter(function($customer) {
                return $customer->order_count > 1;
            })->count();
            
            $oneTimeCustomers = $customerOrders->filter(function($customer) {
                return $customer->order_count == 1;
            })->count();
            
            $repeatRate = $totalCustomers > 0 ? round(($repeatCustomers / $totalCustomers) * 100, 1) : 0;
            
            // Get breakdown by order count
            $orderCountBreakdown = [
                '1_order' => $customerOrders->filter(fn($c) => $c->order_count == 1)->count(),
                '2_orders' => $customerOrders->filter(fn($c) => $c->order_count == 2)->count(),
                '3_orders' => $customerOrders->filter(fn($c) => $c->order_count == 3)->count(),
                '4_orders' => $customerOrders->filter(fn($c) => $c->order_count == 4)->count(),
                '5_plus_orders' => $customerOrders->filter(fn($c) => $c->order_count >= 5)->count(),
            ];
            
            // Get top repeat customers
            $topRepeatCustomers = $customerOrders
                ->sortByDesc('order_count')
                ->take(10)
                ->values()
                ->map(function($customer) use ($filter) {
                    // Get total revenue for this customer
                    $revenueQuery = FbAds::where('phone_number', $customer->phone_number);
                    
                    // Apply same filter
                    switch ($filter) {
                        case 'last30':
                            $revenueQuery->whereBetween('created_at', [now()->subDays(29)->startOfDay(), now()->endOfDay()]);
                            break;
                        case 'month':
                            $revenueQuery->whereMonth('created_at', now()->month)
                                    ->whereYear('created_at', now()->year);
                            break;
                        case 'lastmonth':
                            $lastMonth = now()->subMonth();
                            $revenueQuery->whereMonth('created_at', $lastMonth->month)
                                    ->whereYear('created_at', $lastMonth->year);
                            break;
                        case 'year':
                            // All time - no filter
                            break;
                    }
                    
                    $revenue = $revenueQuery->sum('total');
                    
                    return [
                        'phone' => $customer->phone_number,
                        'orders' => (int)$customer->order_count,
                        'revenue' => (float)$revenue,
                        'aov' => $customer->order_count > 0 ? round($revenue / $customer->order_count, 2) : 0
                    ];
                })
                ->toArray();
            
            // Calculate average orders per customer
            $avgOrdersPerCustomer = $totalCustomers > 0 
                ? round($customerOrders->sum('order_count') / $totalCustomers, 1) 
                : 0;
            
            return response()->json([
                'repeat_rate' => $repeatRate,
                'total_customers' => $totalCustomers,
                'repeat_customers' => $repeatCustomers,
                'one_time_customers' => $oneTimeCustomers,
                'avg_orders_per_customer' => $avgOrdersPerCustomer,
                'breakdown' => $orderCountBreakdown,
                'top_repeat_customers' => $topRepeatCustomers
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Customer Repeat Rate Error: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return response()->json([
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ], 500);
        }
    }

    public function getRevenueComparison(Request $request)
    {
        try {
            $now = now();
            
            // TODAY vs YESTERDAY (at current time)
            $todayStart = $now->copy()->startOfDay();
            $todayNow = $now->copy();
            $yesterdayStart = $now->copy()->subDay()->startOfDay();
            $yesterdayEnd = $now->copy()->subDay()->setTime($now->hour, $now->minute, $now->second);
            
            $todayData = FbAds::whereBetween('created_at', [$todayStart, $todayNow])
                ->selectRaw('COUNT(*) as orders, SUM(total) as revenue')
                ->first();
            
            $yesterdayData = FbAds::whereBetween('created_at', [$yesterdayStart, $yesterdayEnd])
                ->selectRaw('COUNT(*) as orders, SUM(total) as revenue')
                ->first();
            
            $todayRevenue = (float)($todayData->revenue ?? 0);
            $todayOrders = (int)($todayData->orders ?? 0);
            $yesterdayRevenue = (float)($yesterdayData->revenue ?? 0);
            $yesterdayOrders = (int)($yesterdayData->orders ?? 0);
            
            $todayVsYesterdayChange = $yesterdayRevenue > 0 
                ? round((($todayRevenue - $yesterdayRevenue) / $yesterdayRevenue) * 100, 1)
                : 0;
            
            // LAST 7 DAYS vs PREVIOUS 7 DAYS (Days 8-14)
            $last7DaysStart = $now->copy()->subDays(6)->startOfDay();
            $last7DaysEnd = $now->copy()->endOfDay();
            $previous7DaysStart = $now->copy()->subDays(13)->startOfDay();
            $previous7DaysEnd = $now->copy()->subDays(7)->endOfDay();
            
            $last7DaysData = FbAds::whereBetween('created_at', [$last7DaysStart, $last7DaysEnd])
                ->selectRaw('COUNT(*) as orders, SUM(total) as revenue')
                ->first();
            
            $previous7DaysData = FbAds::whereBetween('created_at', [$previous7DaysStart, $previous7DaysEnd])
                ->selectRaw('COUNT(*) as orders, SUM(total) as revenue')
                ->first();
            
            $last7DaysRevenue = (float)($last7DaysData->revenue ?? 0);
            $last7DaysOrders = (int)($last7DaysData->orders ?? 0);
            $previous7DaysRevenue = (float)($previous7DaysData->revenue ?? 0);
            $previous7DaysOrders = (int)($previous7DaysData->orders ?? 0);
            
            $last7DaysChange = $previous7DaysRevenue > 0 
                ? round((($last7DaysRevenue - $previous7DaysRevenue) / $previous7DaysRevenue) * 100, 1)
                : 0;
            
            // THIS MONTH vs LAST MONTH
            $thisMonthStart = $now->copy()->startOfMonth();
            $thisMonthEnd = $now->copy()->endOfDay();
            $lastMonthStart = $now->copy()->subMonth()->startOfMonth();
            $lastMonthEnd = $now->copy()->subMonth()->endOfMonth();
            
            $thisMonthData = FbAds::whereBetween('created_at', [$thisMonthStart, $thisMonthEnd])
                ->selectRaw('COUNT(*) as orders, SUM(total) as revenue')
                ->first();
            
            $lastMonthData = FbAds::whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])
                ->selectRaw('COUNT(*) as orders, SUM(total) as revenue')
                ->first();
            
            $thisMonthRevenue = (float)($thisMonthData->revenue ?? 0);
            $thisMonthOrders = (int)($thisMonthData->orders ?? 0);
            $lastMonthRevenue = (float)($lastMonthData->revenue ?? 0);
            $lastMonthOrders = (int)($lastMonthData->orders ?? 0);
            
            $monthChange = $lastMonthRevenue > 0 
                ? round((($thisMonthRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100, 1)
                : 0;
            
            return response()->json([
                'today_vs_yesterday' => [
                    'today' => [
                        'revenue' => $todayRevenue,
                        'orders' => $todayOrders,
                        'label' => 'Today (' . $now->format('h:i A') . ')'
                    ],
                    'yesterday' => [
                        'revenue' => $yesterdayRevenue,
                        'orders' => $yesterdayOrders,
                        'label' => 'Yesterday (' . $now->format('h:i A') . ')'
                    ],
                    'change' => $todayVsYesterdayChange
                ],
                'last_7_vs_previous_7' => [
                    'last_7' => [
                        'revenue' => $last7DaysRevenue,
                        'orders' => $last7DaysOrders,
                        'label' => 'Last 7 Days'
                    ],
                    'previous_7' => [
                        'revenue' => $previous7DaysRevenue,
                        'orders' => $previous7DaysOrders,
                        'label' => 'Days 8-14 Ago'
                    ],
                    'change' => $last7DaysChange
                ],
                'this_month_vs_last_month' => [
                    'this_month' => [
                        'revenue' => $thisMonthRevenue,
                        'orders' => $thisMonthOrders,
                        'label' => 'This Month'
                    ],
                    'last_month' => [
                        'revenue' => $lastMonthRevenue,
                        'orders' => $lastMonthOrders,
                        'label' => 'Last Month'
                    ],
                    'change' => $monthChange
                ]
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Revenue Comparison Error: ' . $e->getMessage());
            
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function source()
    {
        return $this->belongsTo(OrderSource::class, 'source_id');
    }

}

// conversions/visitors * 100