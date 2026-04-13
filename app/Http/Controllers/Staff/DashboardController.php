<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $lowStock = Product::where('shop_id', auth()->user()->shop_id)
            ->where('stock', '<', 10)
            ->count();

        return view('staff.dashboard', compact('lowStock'));
    }
}
