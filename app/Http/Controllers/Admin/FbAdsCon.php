<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\FbAds;
use App\FbEventListener;
use Illuminate\Support\Facades\DB;
use App\Store;
use App\StatusReason;
use App\StatusDetail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\MetaCreativeMetric;
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

        // ... [Your existing grouped counts code remains exactly the same] ...
        $grouped = FbAds::select('status', DB::raw('count(*) as total'))
            ->when(!$request->date, function($q){
                return $q->whereDate('created_at', now());
            })->when($request->date, function($q){
                $date = explode(" - ",request()->date);
                $from = carbon($date[0]);
                $to = carbon($date[1]);
                if ($from == $to) {
                    return $q->whereDate('created_at', $from);
                }
                return $q->whereBetween('created_at', [$from, $to]);
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
        ->when(!$request->date, function($q){
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
        ->get();

        return view('admin.fbads.index', [
            'orders' => $orders,
            'stores' => $stores,
            'statusCounts' => $statusCounts
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
        $ordersPerDay = collect();

        $currentDate = $startOfMonth->copy();
        while ($currentDate <= $now) {
            $label = $currentDate->format('M d');
            $count = FbAds::whereDate('created_at', $currentDate->toDateString())->count();

            $days->push($label);
            $ordersPerDay->push($count);

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
            'ordersPerDay',
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
        return view('admin.fbads.create');
    }

    public function store(){
        $order = FbAds::create(request()->all() + ['province' => '', 'city' => '', 'barangay' => '']);

       return redirect()->route('fbads.index');
    }

    public function order($id){
        $order = FbAds::find($id);
        return view('admin.fbads.order', ['order' => $order]);
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
   
    public function events(Request $request){

        $contact_number = FbAds::select('phone_number')
        ->when(!$request->date, function($q){
            return $q->whereDate('created_at', now());
        })->when($request->date, function($q){
            $date = explode(" - ",request()->date);
            $from = carbon($date[0]);
            $to = carbon($date[1]);

            if ($from == $to) {
                return $q->whereDate('created_at', $from);
            }

            return $q->whereBetween('created_at', [$from, $to]);
        })->pluck('phone_number')->toArray();

        $events = FbEventListener::select('data', 'value', 'session_id', 'website')
        ->where('data', 'phone_number')
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
        ->orderBy('id', 'desc')
        ->get();
        return view('admin.fbads.events', ['events' => $events, 'contact_number' => $contact_number]);
    }

    public function change_status(){
        if (request()->status == "DELETE") {
            FbAds::find(request()->id)->delete();
        }else{
            FbAds::find(request()->id)->update([
                'status' => request()->status,
                'user_id' => auth()->user()->id
            ]);
        }

        return response(['success' => 'Success!']);
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

}

// conversions/visitors * 100