<x-layouts.app>
    <div class="mb-6">
        <a href="{{ route('owner.reports') }}" class="text-sm text-slate-500 hover:text-indigo-600 transition-colors">← Kembali ke Laporan</a>
    </div>

    <div class="max-w-2xl">
        <div class="mb-6">
            <h1 class="text-xl font-bold text-slate-900">Detail Transaksi #{{ $transaction->id }}</h1>
            <p class="text-sm text-slate-500 mt-0.5">{{ $transaction->created_at->format('d M Y, H:i') }}</p>
        </div>

        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 mb-4">
            <div class="grid grid-cols-2 gap-4 text-sm mb-6">
                <div>
                    <p class="text-xs text-slate-400 mb-1">Kasir</p>
                    <p class="font-medium text-slate-900">{{ $transaction->cashier?->name ?? '—' }}</p>
                </div>
                <div>
                    <p class="text-xs text-slate-400 mb-1">Tanggal</p>
                    <p class="font-medium text-slate-900">{{ $transaction->created_at->format('d M Y, H:i') }}</p>
                </div>
            </div>

            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-slate-100">
                        <th class="text-left py-2 text-xs font-semibold text-slate-500 uppercase">Produk</th>
                        <th class="text-center py-2 text-xs font-semibold text-slate-500 uppercase">Qty</th>
                        <th class="text-right py-2 text-xs font-semibold text-slate-500 uppercase">Harga</th>
                        <th class="text-right py-2 text-xs font-semibold text-slate-500 uppercase">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($transaction->items as $item)
                    <tr>
                        <td class="py-3 text-slate-900">{{ $item->product?->name ?? '—' }}</td>
                        <td class="py-3 text-center text-slate-600">{{ $item->qty }}</td>
                        <td class="py-3 text-right text-slate-600">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                        <td class="py-3 text-right font-medium text-slate-900">Rp {{ number_format($item->price * $item->qty, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="border-t border-slate-200">
                        <td colspan="3" class="pt-4 text-sm font-semibold text-slate-700 text-right pr-4">Total</td>
                        <td class="pt-4 text-right font-bold text-emerald-600 text-base">Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</x-layouts.app>
