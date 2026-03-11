<?php

namespace App\Http\Controllers\Api;

use App\BankTransaction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BankTransactionController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'bank'             => 'required|string|max:255',
            'platform_type'    => 'nullable|string|max:100',
            'transaction_type' => 'required|string|max:100',
            'amount'           => 'required|numeric|min:0',
            'currency'         => 'nullable|string|max:10',
            'reference_number' => 'nullable|string|max:255',
            'date'             => 'nullable|date',
            'time'             => 'nullable|string|max:20',
            'sender_name'      => 'nullable|string|max:255',
            'receiver_name'    => 'nullable|string|max:255',
            'receiver_account' => 'nullable|string|max:255',
            'note'             => 'nullable|string',
            'status'           => 'nullable|string|max:50',
            'confidence_score' => 'nullable|numeric|min:0|max:1',
            'receipt_image'    => 'nullable',
        ]);

        $imagePath = null;

        if ($request->hasFile('receipt_image')) {
            $file = $request->file('receipt_image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/api/bank_transaction_image'), $filename);
            $imagePath = 'images/api/bank_transaction_image/' . $filename;
        } elseif ($request->filled('receipt_image')) {
            // Handle base64 encoded image from n8n
            $base64 = $request->input('receipt_image');

            if (preg_match('/^data:image\/(\w+);base64,/', $base64, $matches)) {
                $ext = $matches[1];
                $base64 = substr($base64, strpos($base64, ',') + 1);
            } else {
                $ext = 'jpg';
            }

            $decoded = base64_decode($base64);
            if ($decoded !== false) {
                $filename = time() . '_' . uniqid() . '.' . $ext;
                $dir = public_path('images/api/bank_transaction_image');
                if (!is_dir($dir)) {
                    mkdir($dir, 0755, true);
                }
                file_put_contents($dir . '/' . $filename, $decoded);
                $imagePath = 'images/api/bank_transaction_image/' . $filename;
            }
        }

        $transaction = BankTransaction::create([
            'bank'             => $data['bank'],
            'platform_type'    => $data['platform_type'] ?? 'bank',
            'transaction_type' => $data['transaction_type'],
            'amount'           => $data['amount'],
            'currency'         => $data['currency'] ?? 'PHP',
            'reference_number' => $data['reference_number'] ?? null,
            'date'             => $data['date'] ?? null,
            'time'             => $data['time'] ?? null,
            'sender_name'      => $data['sender_name'] ?? null,
            'receiver_name'    => $data['receiver_name'] ?? null,
            'receiver_account' => $data['receiver_account'] ?? null,
            'note'             => $data['note'] ?? null,
            'status'           => $data['status'] ?? 'pending',
            'confidence_score' => $data['confidence_score'] ?? null,
            'receipt_image'    => $imagePath,
        ]);

        return response()->json([
            'message' => 'Bank transaction saved',
            'id'      => $transaction->id,
        ], 201);
    }
}
