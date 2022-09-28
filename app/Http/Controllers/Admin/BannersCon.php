<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Transaction;
use App\TransactionPayment;
use App\Banner;

class BannersCon extends Controller
{
    public function index(Request $request){
        return view('admin.banners.index');
    }

    public function add(Request $request){
        return view('admin.banners.add');
    }

    public function store(Request $request){
        foreach ($request->banner as $sequence => $banner) {
            $img = '/images/banners/'.uuid().'.jpg';
            s3_upload_image($img, $banner['image']);
            Banner::create([
                "url" => $banner['url'],
                "image" => $img,
                "alt" => $banner['alt'],
                "size" => $banner['size'],
                "sequence" => $sequence,
            ]);
        }
        return view('admin.banners.index');
    }
}
