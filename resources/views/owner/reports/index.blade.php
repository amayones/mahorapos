<x-layouts.app>
    <x-page-header title="Reports" subtitle="Sales overview and transaction history" />

    {{-- Summary --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-2xl border border-slate-100 p-5 shadow-sm">
            <p class="text-xs text-slate-400 mb-1">Total Transactions</p>
            <p class="text-2xl font-bold text-slate-900">{{ $transactions->count() }}</p>
        </div>
        <div class="bg-white rounded-2xl border border-slate-100 p-5 shadow-sm">
            <p class="text-xs text-slate-400 mb-1">Total Revenue</p>
            <p class="text-2xl font-bold text-emerald-600">RM {{ number_format($transactions->sum('total'), 2) }}</p>
        </div>
        <div class="bg-white rounded-2xl border border-slate-100 p-5 shadow-sm">
            <p class="text-xs text-slate-400 mb-1">Avg. Transaction</p>
            <p class="text-2xl font-bold text-slate-900">
                RM {{ $transactions->count() ? number_format($transactions->avg('total'), 2) : '0.00' }}
            </p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <h2 class="text-sm font-semibold text-slate-700">Transaction History</h2>
            <span class="text-xs text-slate-400 bg-slate-50 border border-slate-100 px-2 py-0.5 rounded-full">
                {{ $transactions->count() }} records
            </span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide">#</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide">Cashier</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide">Total</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($transactions as $tx)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4 text-slate-400 text-xs">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 font-medium text-slate-900">{{ $tx->cashier?->name ?? '—' }}</td>
                        <td class="px-6 py-4">
                            <span class="font-semibold text-emerald-600">RM {{ number_format($tx->total, 2) }}</span>
                        </td>
                        <td class="px-6 py-4 text-slate-500">{{ $tx->created_at->format('d M Y, H:i') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-16 text-center">
                            <p class="text-slate-400 text-sm">No transactions yet.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.app>
