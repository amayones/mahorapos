<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Transaction;

class ReportController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('cashier')
            ->where('shop_id', auth()->user()->shop_id)
            ->latest()
            ->get();

        return view('owner.reports.index', compact('transactions'));
    }
}
