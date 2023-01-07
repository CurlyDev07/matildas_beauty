<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReturnRefundCon extends Controller
{
    public function index(){
        return view('admin.return_refund.index');
    }
}
