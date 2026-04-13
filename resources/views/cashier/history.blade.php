<x-layouts.app>
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-xl font-bold text-slate-900">Riwayat Transaksi</h1>
            <p class="text-sm text-slate-500 mt-0.5">Transaksi yang Anda proses</p>
        </div>
        <a href="{{ route('cashier.pos') }}" class="text-sm text-slate-500 hover:text-indigo-600 font-medium transition-colors">← Kembali ke POS</a>
    </div>

    @if(session('success'))
    <div class="mb-4 px-4 py-3 bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm rounded-xl">{{ session('success') }}</div>
    @endif

    {{-- Filter --}}
    <form method="GET" class="flex flex-wrap gap-3 mb-5">
        <input type="date" name="date" value="{{ request('date', today()->toDateString()) }}"
            class="px-3 py-2 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
        <input type="number" name="search" value="{{ request('search') }}" placeholder="Cari ID transaksi..."
            class="px-3 py-2 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 w-48">
        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-xl hover:bg-indigo-700 transition-colors">Cari</button>
    </form>

    {{-- Summary --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-5">
        @php
            $completed = $transactions->where('status', 'completed');
            $refunded  = $transactions->where('status', 'refunded');
        @endphp
        <div class="bg-white rounded-xl border border-slate-100 p-4 shadow-sm">
            <p class="text-xs text-slate-400">Transaksi</p>
            <p class="text-xl font-bold text-slate-900">{{ $completed->count() }}</p>
        </div>
        <div class="bg-white rounded-xl border border-slate-100 p-4 shadow-sm">
            <p class="text-xs text-slate-400">Pendapatan</p>
            <p class="text-xl font-bold text-emerald-600">Rp {{ number_format($completed->sum('total'), 0, ',', '.') }}</p>
        </div>
        <div class="bg-white rounded-xl border border-slate-100 p-4 shadow-sm">
            <p class="text-xs text-slate-400">Refund</p>
            <p class="text-xl font-bold text-red-500">{{ $refunded->count() }}</p>
        </div>
        <div class="bg-white rounded-xl border border-slate-100 p-4 shadow-sm">
            <p class="text-xs text-slate-400">Rata-rata</p>
            <p class="text-xl font-bold text-slate-900">Rp {{ $completed->count() ? number_format($completed->avg('total'), 0, ',', '.') : 0 }}</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">#ID</th>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">Items</th>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">Total</th>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">Bayar</th>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">Status</th>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">Waktu</th>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($transactions as $tx)
                    <tr class="hover:bg-slate-50/50 transition-colors {{ $tx->status === 'refunded' ? 'opacity-60' : '' }}">
                        <td class="px-5 py-3 font-mono text-xs text-slate-500">#{{ $tx->id }}</td>
                        <td class="px-5 py-3 text-slate-600 text-xs">
                            {{ $tx->items->map(fn($i) => ($i->product?->name ?? '?').' x'.$i->qty)->join(', ') }}
                        </td>
                        <td class="px-5 py-3 font-semibold text-slate-900">Rp {{ number_format($tx->total, 0, ',', '.') }}</td>
                        <td class="px-5 py-3 text-xs text-slate-500 capitalize">{{ $tx->payment_method }}</td>
                        <td class="px-5 py-3">
                            @if($tx->status === 'completed')
                                <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">Selesai</span>
                            @else
                                <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-600">Refund</span>
                            @endif
                        </td>
                        <td class="px-5 py-3 text-xs text-slate-500">{{ $tx->created_at->format('H:i') }}</td>
                        <td class="px-5 py-3">
                            <div class="flex items-center gap-3">
                                <button onclick="showReceipt({{ $tx->id }})"
                                    class="text-xs text-indigo-500 hover:text-indigo-700 font-medium">Struk</button>
                                @if($tx->status === 'completed')
                                <form method="POST" action="{{ route('cashier.refund', $tx) }}"
                                      onsubmit="return confirm('Refund transaksi #{{ $tx->id }}? Stok akan dikembalikan.')">
                                    @csrf
                                    <button type="submit" class="text-xs text-red-400 hover:text-red-600 font-medium">Refund</button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="px-5 py-16 text-center text-slate-400 text-sm">Belum ada transaksi.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Receipt Modal --}}
    <div id="modal-receipt" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/40 px-4">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-sm overflow-hidden">
            <div class="bg-indigo-600 px-6 py-4 text-center">
                <h3 class="text-white font-bold">Struk Transaksi</h3>
                <p id="r-id" class="text-indigo-200 text-xs mt-0.5"></p>
            </div>
            <div id="r-body" class="px-6 py-4 text-sm space-y-1 max-h-72 overflow-y-auto"></div>
            <div class="px-6 py-4 border-t border-slate-100 flex gap-2">
                <button onclick="doPrint()" class="flex-1 py-2 border border-slate-200 text-slate-700 text-sm font-medium rounded-xl hover:bg-slate-50">🖨 Cetak</button>
                <button onclick="document.getElementById('modal-receipt').classList.add('hidden')"
                    class="flex-1 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-xl hover:bg-indigo-700">Tutup</button>
            </div>
        </div>
    </div>

    <script>
        const txData = @json($transactions->keyBy('id'));

        function fmt(n) { return 'Rp ' + Math.round(n).toLocaleString('id-ID'); }

        function showReceipt(id) {
            const tx = txData[id];
            if (!tx) return;
            document.getElementById('r-id').textContent = `#${tx.id} · ${new Date(tx.created_at).toLocaleString('id-ID')}`;

            let html = tx.items.map(i =>
                `<div class="flex justify-between text-xs text-slate-600">
                    <span>${i.product?.name ?? '—'} x${i.qty}</span>
                    <span>${fmt((i.price - i.discount) * i.qty)}</span>
                </div>`
            ).join('');

            html += `<div class="border-t border-dashed border-slate-200 my-2"></div>
                <div class="flex justify-between text-xs text-slate-500"><span>Subtotal</span><span>${fmt(tx.subtotal)}</span></div>
                ${tx.discount_amount > 0 ? `<div class="flex justify-between text-xs text-red-500"><span>Diskon</span><span>- ${fmt(tx.discount_amount)}</span></div>` : ''}
                ${tx.tax_amount > 0 ? `<div class="flex justify-between text-xs text-slate-500"><span>Pajak</span><span>+ ${fmt(tx.tax_amount)}</span></div>` : ''}
                <div class="flex justify-between font-bold text-sm"><span>Total</span><span>${fmt(tx.total)}</span></div>
                ${tx.payment_method === 'cash' ? `
                <div class="flex justify-between text-xs text-slate-500 mt-1"><span>Tunai</span><span>${fmt(tx.cash_paid)}</span></div>
                <div class="flex justify-between text-xs font-semibold text-emerald-600"><span>Kembalian</span><span>${fmt(tx.change_amount)}</span></div>` : ''}`;

            document.getElementById('r-body').innerHTML = html;
            document.getElementById('modal-receipt').classList.remove('hidden');
        }

        function doPrint() {
            const body = document.getElementById('r-body').innerHTML;
            const id   = document.getElementById('r-id').textContent;
            const win  = window.open('', '_blank', 'width=300,height=500');
            win.document.write(`<html><head><title>Struk</title>
                <style>body{font-family:monospace;font-size:12px;padding:16px;width:280px}
                .flex{display:flex;justify-content:space-between}</style></head>
                <body><h3 style="text-align:center">MahoraPOS</h3>
                <p style="text-align:center;font-size:10px">${id}</p><hr>${body}</body></html>`);
            win.document.close(); win.print();
        }
    </script>
</x-layouts.app>
