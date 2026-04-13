<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shop;

class ShopController extends Controller
{
    public function index()
    {
        $shops = Shop::with('owner')->latest()->get();
        return view('admin.shops.index', compact('shops'));
    }
}
