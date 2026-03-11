<?php

namespace App\Http\Controllers\Admin;

use App\BankTransaction;
use App\Http\Controllers\Controller;

class FinanceCon extends Controller
{
    public function bank_transactions()
    {
        $transactions = BankTransaction::orderBy('created_at', 'desc')->paginate(50);
        return view('admin.finance.bank_transactions', compact('transactions'));
    }
}
