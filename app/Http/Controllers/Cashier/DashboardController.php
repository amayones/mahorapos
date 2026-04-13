<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        $shopId     = auth()->user()->shop_id;
        $todayTotal = Transaction::where('shop_id', $shopId)->whereDate('created_at', today())->sum('total');
        $todayCount = Transaction::where('shop_id', $shopId)->whereDate('created_at', today())->count();

        return view('cashier.dashboard', compact('todayTotal', 'todayCount'));
    }
}
