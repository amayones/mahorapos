<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('shop_id', auth()->user()->shop_id)->get();
        return view('owner.products.index', compact('products'));
    }
}
