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


class FbAdsCon extends Controller
{

    public function index(Request $request){

        // Get grouped counts
        $grouped = FbAds::select('status', DB::raw('count(*) as total'))
            ->when(!$request->date, function($q){ // Show DEFAULT DATA For TODAY
                return $q->whereDate('created_at', now());
            })->when($request->date, function($q){
                $date = explode(" - ",request()->date);
                $from = carbon($date[0]);
                $to = carbon($date[1]);

                if ($from == $to) {
                    return $q->whereDate('created_at', $from);
                }

                return $q->whereBetween('created_at', [$from, $to]);
            })// FILTER DATE
            ->groupBy('status')
            ->get();

        // Get total count of all records
        $overallTotal = $grouped->sum('total');

        // Map into array with percentage
        $statusCounts = $grouped->mapWithKeys(function ($item) use ($overallTotal) {
            $percentage = $overallTotal > 0 ? round(($item->total / $overallTotal) * 100, 2) : 0;
            return [
                $item->status => [
                    'count' => $item->total,
                    'percent' => $percentage
                ]
            ];
        });
        
        // dd($statusCounts);

        // ======================== STATUS COUNT ========================


        $stores = Store::all();

        $orders = FbAds::orderBy('created_at', 'desc')
        ->when(!$request->date, function($q){
            return $q->whereDate('created_at', now());
        })// Show DEFAULT DATA For TODAY
        ->when($request->date, function($q){
            $date = explode(" - ",request()->date);
            $from = carbon($date[0]);
            $to = carbon($date[1]);

            if ($from == $to) {
                return $q->whereDate('created_at', $from);
            }

            return $q->whereBetween('created_at', [$from, $to]);
        })// FILTER DATE
        ->when($request->status, function($q){
            return $q->where('status', request()->status);
        })// Filter by STATUS
        ->get();

        return view('admin.fbads.index', [
            'orders' => $orders,
            'stores' => $stores,
            'statusCounts' => $statusCounts
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