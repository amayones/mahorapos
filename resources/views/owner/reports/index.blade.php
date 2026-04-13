<x-layouts.app>
    <div class="mb-6">
        <h1 class="text-xl font-bold text-slate-900">Laporan</h1>
        <p class="text-sm text-slate-500 mt-0.5">Ringkasan penjualan dan riwayat transaksi</p>
    </div>

    {{-- Filter --}}
    <form method="GET" action="{{ route('owner.reports') }}" class="flex flex-wrap gap-3 mb-6">
        <div class="flex items-center gap-2">
            <label class="text-sm text-slate-600 font-medium">Dari</label>
            <input type="date" name="from" value="{{ request('from') }}"
                class="px-3 py-2 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>
        <div class="flex items-center gap-2">
            <label class="text-sm text-slate-600 font-medium">Sampai</label>
            <input type="date" name="to" value="{{ request('to') }}"
                class="px-3 py-2 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>
        <button type="submit"
            class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-xl hover:bg-indigo-700 transition-colors">
            Filter
        </button>
        @if(request('from') || request('to'))
        <a href="{{ route('owner.reports') }}"
            class="px-4 py-2 border border-slate-200 text-slate-600 text-sm font-medium rounded-xl hover:bg-slate-50 transition-colors">
            Reset
        </a>
        @endif
    </form>

    {{-- Summary --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-2xl border border-slate-100 p-5 shadow-sm">
            <p class="text-xs text-slate-400 mb-1">Total Transaksi</p>
            <p class="text-2xl font-bold text-slate-900">{{ $transactions->count() }}</p>
        </div>
        <div class="bg-white rounded-2xl border border-slate-100 p-5 shadow-sm">
            <p class="text-xs text-slate-400 mb-1">Total Pendapatan</p>
            <p class="text-2xl font-bold text-emerald-600">Rp {{ number_format($transactions->sum('total'), 0, ',', '.') }}</p>
        </div>
        <div class="bg-white rounded-2xl border border-slate-100 p-5 shadow-sm">
            <p class="text-xs text-slate-400 mb-1">Rata-rata Transaksi</p>
            <p class="text-2xl font-bold text-slate-900">
                Rp {{ $transactions->count() ? number_format($transactions->avg('total'), 0, ',', '.') : '0' }}
            </p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <h2 class="text-sm font-semibold text-slate-700">Riwayat Transaksi</h2>
            <span class="text-xs text-slate-400 bg-slate-50 border border-slate-100 px-2 py-0.5 rounded-full">
                {{ $transactions->count() }} records
            </span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide">#</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide">Kasir</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide">Total</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide">Tanggal</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($transactions as $tx)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4 text-slate-400 text-xs">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 font-medium text-slate-900">{{ $tx->cashier?->name ?? '—' }}</td>
                        <td class="px-6 py-4">
                            <span class="font-semibold text-emerald-600">Rp {{ number_format($tx->total, 0, ',', '.') }}</span>
                        </td>
                        <td class="px-6 py-4 text-slate-500">{{ $tx->created_at->format('d M Y, H:i') }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ route('owner.reports.show', $tx) }}"
                               class="text-xs text-indigo-500 hover:text-indigo-700 font-medium transition-colors">Detail</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center">
                            <p class="text-slate-400 text-sm">Belum ada transaksi.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.app>
