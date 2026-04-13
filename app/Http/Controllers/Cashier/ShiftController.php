<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Models\CashierShift;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    public function index()
    {
        $user  = auth()->user();
        $shift = CashierShift::where('cashier_id', $user->id)
            ->whereNull('closed_at')
            ->latest('opened_at')
            ->first();

        $lastShifts = CashierShift::where('cashier_id', $user->id)
            ->whereNotNull('closed_at')
            ->latest('opened_at')
            ->take(5)
            ->get();

        return view('cashier.shift', compact('shift', 'lastShifts'));
    }

    public function open(Request $request)
    {
        $user = auth()->user();

        abort_if(
            CashierShift::where('cashier_id', $user->id)->whereNull('closed_at')->exists(),
            422,
            'Shift masih terbuka.'
        );

        $request->validate(['opening_cash' => 'required|numeric|min:0']);

        CashierShift::create([
            'shop_id'      => $user->shop_id,
            'cashier_id'   => $user->id,
            'opening_cash' => $request->opening_cash,
            'opened_at'    => now(),
        ]);

        return redirect()->route('cashier.shift')->with('success', 'Shift berhasil dibuka.');
    }

    public function close(Request $request)
    {
        $user  = auth()->user();
        $shift = CashierShift::where('cashier_id', $user->id)
            ->whereNull('closed_at')
            ->firstOrFail();

        $request->validate([
            'closing_cash' => 'required|numeric|min:0',
            'note'         => 'nullable|string|max:255',
        ]);

        $cashFromSales = $shift->transactions()
            ->where('status', 'completed')
            ->where('payment_method', 'cash')
            ->sum('cash_paid') - $shift->transactions()
            ->where('status', 'completed')
            ->where('payment_method', 'cash')
            ->sum('change_amount');

        $expected   = $shift->opening_cash + $cashFromSales;
        $difference = $request->closing_cash - $expected;

        $shift->update([
            'closing_cash'    => $request->closing_cash,
            'expected_cash'   => $expected,
            'cash_difference' => $difference,
            'closed_at'       => now(),
            'note'            => $request->note,
        ]);

        return redirect()->route('cashier.shift')->with('success', 'Shift berhasil ditutup.');
    }
}
