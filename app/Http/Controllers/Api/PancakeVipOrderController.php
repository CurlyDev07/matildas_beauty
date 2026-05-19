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

    public function updateWorkflowStage(Request $request, $id)
    {
        $request->validate([
            'workflow_stage' => 'required|in:sales,production,packing,shipped',
        ]);

        $order = JTPancakeVipOrders::find($id);
        if (!$order) {
            return response()->json([
                'message' => 'Order not found.',
            ], 404);
        }

        $order->workflow_stage = $request->workflow_stage;
        $order->save();

        return response()->json([
            'message' => 'Workflow stage updated successfully.',
            'order' => [
                'id' => $order->id,
                'tracking_number' => $order->tracking_number,
                'workflow_stage' => $order->workflow_stage,
                'status' => $order->status,
                'updated_at' => optional($order->updated_at)->toDateTimeString(),
            ],
        ]);
    }

    public function bulkUpdateWorkflowStage(Request $request)
    {
        $request->validate([
            'workflow_stage' => 'required|string',
            'tracking_numbers' => 'required|array|min:1',
            'tracking_numbers.*' => 'required|string',
            'from_workflow_stage' => 'nullable|string',
        ]);

        $targetStage = $this->normalizeWorkflowStageInput($request->workflow_stage);
        if (!$targetStage) {
            return response()->json([
                'message' => 'Invalid target workflow stage.',
                'allowed_stages' => ['sales', 'production', 'packing', 'shipped'],
            ], 422);
        }

        $fromStage = null;
        if ($request->filled('from_workflow_stage')) {
            $fromStage = $this->normalizeWorkflowStageInput($request->from_workflow_stage);
            if (!$fromStage) {
                return response()->json([
                    'message' => 'Invalid from_workflow_stage.',
                    'allowed_stages' => ['sales', 'production', 'packing', 'shipped'],
                ], 422);
            }
        }

        $trackingNumbers = collect($request->tracking_numbers)
            ->map(function ($v) {
                return trim((string) $v);
            })
            ->filter()
            ->unique()
            ->values();

        if ($trackingNumbers->isEmpty()) {
            return response()->json([
                'message' => 'No valid tracking numbers provided.',
            ], 422);
        }

        $query = JTPancakeVipOrders::query()->whereIn('tracking_number', $trackingNumbers->all());
        if ($fromStage) {
            $query->where('workflow_stage', $fromStage);
        }

        $matchedOrders = $query->get(['id', 'tracking_number', 'workflow_stage']);

        $matchedTracking = $matchedOrders->pluck('tracking_number')->filter()->values();
        $notFound = $trackingNumbers->diff($matchedTracking)->values();

        $updatedCount = 0;
        if ($matchedOrders->isNotEmpty()) {
            $updateQuery = JTPancakeVipOrders::query()->whereIn('id', $matchedOrders->pluck('id')->all());
            $updatedCount = $updateQuery->update(['workflow_stage' => $targetStage]);
        }

        return response()->json([
            'message' => 'Bulk workflow stage update processed.',
            'target_workflow_stage' => $targetStage,
            'from_workflow_stage' => $fromStage,
            'requested_count' => $trackingNumbers->count(),
            'matched_count' => $matchedOrders->count(),
            'updated_count' => $updatedCount,
            'not_found_or_filtered_count' => $notFound->count(),
            'not_found_or_filtered_tracking_numbers' => $notFound->values(),
        ]);
    }

    private function normalizeWorkflowStageInput($value)
    {
        $normalized = strtolower(trim((string) $value));

        if ($normalized === 'packer') {
            $normalized = 'packing';
        }

        $allowed = ['sales', 'production', 'packing', 'shipped'];

        return in_array($normalized, $allowed, true) ? $normalized : null;
    }
}
