<x-layouts.app>
    <x-page-header title="Dashboard" subtitle="Today's summary — {{ now()->format('d M Y') }}" />

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
        <div class="bg-white rounded-2xl border border-slate-100 p-6 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div class="w-9 h-9 rounded-xl bg-sky-50 flex items-center justify-center">
                    <svg class="w-5 h-5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <span class="text-xs text-sky-600 bg-sky-50 px-2 py-0.5 rounded-full font-medium">Today</span>
            </div>
            <p class="text-3xl font-bold text-slate-900">{{ $todayCount }}</p>
            <p class="text-sm text-slate-500 mt-1">Transactions</p>
        </div>

        <div class="bg-white rounded-2xl border border-slate-100 p-6 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div class="w-9 h-9 rounded-xl bg-emerald-50 flex items-center justify-center">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <span class="text-xs text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full font-medium">Today</span>
            </div>
            <p class="text-3xl font-bold text-emerald-600">RM {{ number_format($todayTotal, 2) }}</p>
            <p class="text-sm text-slate-500 mt-1">Revenue</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 p-6 shadow-sm">
        <h2 class="text-sm font-semibold text-slate-700 mb-4">Quick Actions</h2>
        <a href="{{ route('cashier.pos') }}"
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 text-white font-semibold rounded-xl hover:bg-indigo-700 transition-colors shadow-sm text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
            Open POS
        </a>
    </div>
</x-layouts.app>
