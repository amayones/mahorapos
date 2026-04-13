<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        $products = Product::where('shop_id', auth()->user()->shop_id)->latest()->get();
        return view('staff.inventory.index', compact('products'));
    }

    public function updateStock(Request $request, Product $product)
    {
        abort_if($product->shop_id !== auth()->user()->shop_id, 403);

        $data = $request->validate([
            'action' => 'required|in:add,subtract,set',
            'amount' => 'required|integer|min:0',
        ]);

        $product->stock = match ($data['action']) {
            'add'      => $product->stock + $data['amount'],
            'subtract' => max(0, $product->stock - $data['amount']),
            'set'      => $data['amount'],
        };

        $product->save();

        return redirect()->route('staff.inventory')->with('success', "Stok \"{$product->name}\" berhasil diperbarui.");
    }
}
