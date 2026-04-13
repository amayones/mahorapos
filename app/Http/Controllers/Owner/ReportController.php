<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $shopId = auth()->user()->shop_id;

        $query = Transaction::with('cashier')
            ->where('shop_id', $shopId)
            ->latest();

        if ($request->filled('from')) {
            $query->whereDate('created_at', '>=', $request->from);
        }
        if ($request->filled('to')) {
            $query->whereDate('created_at', '<=', $request->to);
        }

        $transactions = $query->get();

        return view('owner.reports.index', compact('transactions'));
    }

    public function show(Transaction $transaction)
    {
        abort_if($transaction->shop_id !== auth()->user()->shop_id, 403);
        $transaction->load('cashier', 'items.product');
        return view('owner.reports.show', compact('transaction'));
    }
}
