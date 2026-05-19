<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\JTPancakeVipOrders;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PancakeVipOrderController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'date' => 'nullable|date_format:Y-m-d',
        ]);

        $targetDate = $request->filled('date')
            ? Carbon::createFromFormat('Y-m-d', $request->date)->toDateString()
            : Carbon::today('Asia/Manila')->toDateString();

        $orders = JTPancakeVipOrders::query()
            ->whereDate('created_at', $targetDate)
            ->orderBy('id', 'desc')
            ->get([
                'id',
                'tracking_number',
                'phone_number',
                'customer',
                'product_list',
                'workflow_stage',
                'status',
                'created_at',
            ]);

        return response()->json([
            'date' => $targetDate,
            'total' => $orders->count(),
            'orders' => $orders,
        ]);
    }
}

