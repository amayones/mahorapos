<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Models\CashierShift;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PosController extends Controller
{
    const TAX_PERCENT = 11;

    public function index()
    {
        $user     = auth()->user();
        $products = Product::where('shop_id', $user->shop_id)->where('stock', '>', 0)->get();
        $shift    = CashierShift::where('cashier_id', $user->id)->whereNull('closed_at')->latest('opened_at')->first();

        return view('cashier.pos.index', compact('products', 'shift'));
    }

    public function validateCoupon(Request $request)
    {
        $request->validate(['code' => 'required|string']);

        $coupon = Coupon::where('code', strtoupper($request->code))
            ->where('shop_id', auth()->user()->shop_id)
            ->first();

        if (!$coupon || !$coupon->isValid()) {
            return response()->json(['valid' => false, 'message' => 'Kupon tidak valid atau sudah kadaluarsa.'], 422);
        }

        return response()->json([
            'valid'       => true,
            'id'          => $coupon->id,
            'code'        => $coupon->code,
            'description' => $coupon->description,
            'type'        => $coupon->type,
            'value'       => $coupon->value,
        ]);
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'items'            => 'required|array|min:1',
            'items.*.id'       => 'required|integer|exists:products,id',
            'items.*.qty'      => 'required|integer|min:1',
            'items.*.discount' => 'nullable|numeric|min:0',
            'coupon_id'        => 'nullable|integer|exists:coupons,id',
            'payment_method'   => 'required|in:cash,ewallet,transfer',
            'cash_paid'        => 'nullable|numeric|min:0',
        ]);

        $user   = auth()->user();
        $shopId = $user->shop_id;
        $shift  = CashierShift::where('cashier_id', $user->id)->whereNull('closed_at')->latest('opened_at')->first();

        $result = DB::transaction(function () use ($request, $user, $shopId, $shift) {
            $subtotal = 0;
            $lines    = [];

            foreach ($request->items as $item) {
                $product = Product::where('id', $item['id'])->where('shop_id', $shopId)->lockForUpdate()->firstOrFail();
                abort_if($product->stock < $item['qty'], 422, "Stok \"{$product->name}\" tidak mencukupi.");

                $itemDiscount = (float) ($item['discount'] ?? 0);
                $subtotal    += ($product->price - $itemDiscount) * $item['qty'];
                $lines[]      = ['product' => $product, 'qty' => $item['qty'], 'price' => $product->price, 'discount' => $itemDiscount];
            }

            // Coupon discount
            $couponDiscount = 0;
            $coupon         = null;
            if ($request->coupon_id) {
                $coupon = Coupon::where('id', $request->coupon_id)->where('shop_id', $shopId)->lockForUpdate()->first();
                if ($coupon && $coupon->isValid()) {
                    $couponDiscount = $coupon->calculateDiscount($subtotal);
                    $coupon->increment('used_count');
                }
            }

            $afterDiscount = $subtotal - $couponDiscount;
            $taxAmount     = round($afterDiscount * self::TAX_PERCENT / 100, 2);
            $total         = $afterDiscount + $taxAmount;
            $cashPaid      = (float) ($request->cash_paid ?? $total);
            $change        = max(0, $cashPaid - $total);

            $transaction = Transaction::create([
                'shop_id'         => $shopId,
                'cashier_id'      => $user->id,
                'shift_id'        => $shift?->id,
                'coupon_id'       => $coupon?->id,
                'subtotal'        => $subtotal,
                'discount_amount' => $couponDiscount,
                'tax_amount'      => $taxAmount,
                'total'           => $total,
                'cash_paid'       => $cashPaid,
                'change_amount'   => $change,
                'payment_method'  => $request->payment_method,
                'status'          => 'completed',
                'note'            => $request->note,
            ]);

            foreach ($lines as $line) {
                $transaction->items()->create([
                    'product_id' => $line['product']->id,
                    'qty'        => $line['qty'],
                    'price'      => $line['price'],
                    'discount'   => $line['discount'],
                ]);
                $line['product']->decrement('stock', $line['qty']);
            }

            return $transaction->load('items.product', 'cashier', 'coupon');
        });

        return response()->json(['message' => 'Transaksi berhasil.', 'transaction' => $result]);
    }

    public function history(Request $request)
    {
        $query = Transaction::with('cashier', 'items.product', 'coupon')
            ->where('shop_id', auth()->user()->shop_id)
            ->where('cashier_id', auth()->id())
            ->latest();

        if ($request->filled('search')) $query->where('id', $request->search);
        if ($request->filled('date'))   $query->whereDate('created_at', $request->date);
        else                            $query->whereDate('created_at', today());

        $transactions = $query->get();
        return view('cashier.history', compact('transactions'));
    }

    public function refund(Request $request, Transaction $transaction)
    {
        abort_if($transaction->shop_id !== auth()->user()->shop_id, 403);
        abort_if($transaction->status === 'refunded', 422, 'Transaksi sudah direfund.');

        DB::transaction(function () use ($transaction) {
            foreach ($transaction->items as $item) {
                $item->product?->increment('stock', $item->qty);
            }
            if ($transaction->coupon) {
                $transaction->coupon->decrement('used_count');
            }
            $transaction->update(['status' => 'refunded']);
        });

        return back()->with('success', "Transaksi #{$transaction->id} berhasil direfund.");
    }
}
