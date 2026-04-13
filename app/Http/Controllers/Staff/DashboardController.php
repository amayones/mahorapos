<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $shopId = auth()->user()->shop_id;

        $stats = [
            'total'        => Product::where('shop_id', $shopId)->count(),
            'low_stock'    => Product::where('shop_id', $shopId)->where('stock', '>', 0)->where('stock', '<', 10)->count(),
            'out_of_stock' => Product::where('shop_id', $shopId)->where('stock', 0)->count(),
        ];

        return view('staff.dashboard', compact('stats'));
    }
}
