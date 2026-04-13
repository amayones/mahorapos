<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $shopId = auth()->user()->shop_id;

        $stats = [
            'products'     => Product::where('shop_id', $shopId)->count(),
            'users'        => User::where('shop_id', $shopId)->count(),
            'transactions' => Transaction::where('shop_id', $shopId)->count(),
            'revenue'      => Transaction::where('shop_id', $shopId)->sum('total'),
        ];

        return view('owner.dashboard', compact('stats'));
    }
}
