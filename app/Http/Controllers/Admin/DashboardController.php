<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'shops'     => Shop::count(),
            'users'     => User::count(),
            'active'    => Shop::where('subscription_status', 'active')->count(),
            'suspended' => Shop::where('subscription_status', 'suspended')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
