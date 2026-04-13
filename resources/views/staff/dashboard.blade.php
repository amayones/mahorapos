<x-layouts.app>
    <x-page-header title="Dasbor" subtitle="Ringkasan inventaris hari ini" />

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
        <div class="bg-white rounded-2xl border border-slate-100 p-6 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div class="w-9 h-9 rounded-xl bg-amber-50 flex items-center justify-center">
                    <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <span class="text-xs text-amber-600 bg-amber-50 px-2 py-0.5 rounded-full font-medium">Peringatan</span>
            </div>
            <p class="text-3xl font-bold {{ $lowStock > 0 ? 'text-red-500' : 'text-emerald-600' }}">{{ $lowStock }}</p>
            <p class="text-sm text-slate-500 mt-1">Produk stok menipis (di bawah 10)</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 p-6 shadow-sm">
        <h2 class="text-sm font-semibold text-slate-700 mb-4">Aksi Cepat</h2>
        <a href="{{ route('staff.inventory') }}"
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-violet-600 text-white font-semibold rounded-xl hover:bg-violet-700 transition-colors shadow-sm text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
            </svg>
            Kelola Inventaris
        </a>
    </div>
</x-layouts.app>
