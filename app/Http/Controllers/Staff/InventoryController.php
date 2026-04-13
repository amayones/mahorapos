<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Product;

class InventoryController extends Controller
{
    public function index()
    {
        $products = Product::where('shop_id', auth()->user()->shop_id)->get();
        return view('staff.inventory.index', compact('products'));
    }
}
