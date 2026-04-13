<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SubscriptionController extends Controller
{
    public function index()
    {
        $shops = Shop::with('owner')->latest()->get();
        return view('admin.subscriptions.index', compact('shops'));
    }

    public function extend(Request $request, Shop $shop)
    {
        $data = $request->validate([
            'days' => 'required|integer|min:1|max:365',
        ]);

        $base = $shop->subscription_end_date && Carbon::parse($shop->subscription_end_date)->isFuture()
            ? Carbon::parse($shop->subscription_end_date)
            : now();

        $shop->update([
            'subscription_end_date' => $base->addDays((int) $data['days']),
            'subscription_status'   => 'active',
        ]);

        return back()->with('success', "Langganan \"{$shop->name}\" diperpanjang {$data['days']} hari.");
    }
}
