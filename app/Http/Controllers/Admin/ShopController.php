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

    public function activate(Shop $shop)
    {
        $shop->update(['subscription_status' => 'active']);
        return back()->with('success', "Toko \"{$shop->name}\" berhasil diaktifkan.");
    }

    public function suspend(Shop $shop)
    {
        $shop->update(['subscription_status' => 'suspended']);
        return back()->with('success', "Toko \"{$shop->name}\" berhasil ditangguhkan.");
    }

    public function destroy(Shop $shop)
    {
        $shop->delete();
        return back()->with('success', "Toko \"{$shop->name}\" berhasil dihapus.");
    }
}
