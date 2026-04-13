<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('shop_id', auth()->user()->shop_id)->latest()->get();
        return view('owner.products.index', compact('products'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'  => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create(array_merge($data, ['shop_id' => auth()->user()->shop_id]));

        return redirect()->route('owner.products')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        abort_if($product->shop_id !== auth()->user()->shop_id, 403);
        return view('owner.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        abort_if($product->shop_id !== auth()->user()->shop_id, 403);

        $data = $request->validate([
            'name'  => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) \Storage::disk('public')->delete($product->image);
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('owner.products')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        abort_if($product->shop_id !== auth()->user()->shop_id, 403);
        if ($product->image) \Storage::disk('public')->delete($product->image);
        $product->delete();
        return redirect()->route('owner.products')->with('success', 'Produk berhasil dihapus.');
    }
}
