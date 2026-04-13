<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::where('shop_id', auth()->user()->shop_id)->latest()->get();
        return view('owner.coupons.index', compact('coupons'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'code'        => 'required|string|max:50|unique:coupons,code',
            'description' => 'nullable|string|max:100',
            'type'        => 'required|in:fixed,percent',
            'value'       => 'required|numeric|min:0',
            'max_uses'    => 'nullable|integer|min:1',
            'expires_at'  => 'nullable|date|after:today',
        ]);

        Coupon::create(array_merge($data, ['shop_id' => auth()->user()->shop_id]));

        return redirect()->route('owner.coupons')->with('success', 'Kupon berhasil dibuat.');
    }

    public function toggle(Coupon $coupon)
    {
        abort_if($coupon->shop_id !== auth()->user()->shop_id, 403);
        $coupon->update(['is_active' => !$coupon->is_active]);
        return back()->with('success', 'Status kupon diperbarui.');
    }

    public function destroy(Coupon $coupon)
    {
        abort_if($coupon->shop_id !== auth()->user()->shop_id, 403);
        $coupon->delete();
        return back()->with('success', 'Kupon berhasil dihapus.');
    }
}
