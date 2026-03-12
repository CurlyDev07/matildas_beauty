<?php

namespace App\Http\Controllers\Admin;

use App\BankTransaction;
use App\Http\Controllers\Controller;

class FinanceCon extends Controller
{
    public function bank_transactions(\Illuminate\Http\Request $request)
    {
        $filter   = $request->get('filter', 'all');
        $dateFrom = $request->get('date_from');
        $dateTo   = $request->get('date_to');

        $query = BankTransaction::orderBy('date', 'desc')->orderBy('time', 'desc');

        if ($filter === 'today') {
            $query->whereDate('date', today());
        } elseif ($filter === 'yesterday') {
            $query->whereDate('date', today()->subDay());
        } elseif ($filter === '7days') {
            $query->whereDate('date', '>=', today()->subDays(6));
        } elseif ($filter === '30days') {
            $query->whereDate('date', '>=', today()->subDays(29));
        } elseif ($filter === 'custom' && $dateFrom && $dateTo) {
            $query->whereDate('date', '>=', $dateFrom)->whereDate('date', '<=', $dateTo);
        }

        $transactions = $query->paginate(50)->appends($request->query());
        $total        = (clone $query)->sum('amount');

        return view('admin.finance.bank_transactions', compact('transactions', 'total', 'filter', 'dateFrom', 'dateTo'));
    }

    public function bank_transaction_update(\Illuminate\Http\Request $request, $id)
    {
        $t = BankTransaction::findOrFail($id);

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
        ]);

        $t->update($data);

        return redirect()->back()->with('success', 'Transaction updated.');
    }

    public function bank_transaction_destroy($id)
    {
        BankTransaction::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Transaction deleted.');
    }
}
