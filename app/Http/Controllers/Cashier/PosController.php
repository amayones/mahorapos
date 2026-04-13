<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Models\Product;

class PosController extends Controller
{
    public function index()
    {
        $products = Product::where('shop_id', auth()->user()->shop_id)
            ->where('stock', '>', 0)
            ->get();

        return view('cashier.pos.index', compact('products'));
    }
}
