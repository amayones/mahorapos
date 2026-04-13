<x-layouts.app>
    <x-page-header title="Langganan" subtitle="Pantau status langganan semua toko" />

    @php
        $active    = $shops->where('subscription_status', 'active')->count();
        $suspended = $shops->where('subscription_status', 'suspended')->count();
        $expired   = $shops->where('subscription_status', 'expired')->count();
    @endphp

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-2xl border border-slate-100 p-5 shadow-sm">
            <div class="flex items-center gap-2 mb-3">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                <span class="text-xs font-medium text-slate-500">Aktif</span>
            </div>
            <p class="text-3xl font-bold text-emerald-600">{{ $active }}</p>
        </div>
        <div class="bg-white rounded-2xl border border-slate-100 p-5 shadow-sm">
            <div class="flex items-center gap-2 mb-3">
                <span class="w-2 h-2 rounded-full bg-red-500"></span>
                <span class="text-xs font-medium text-slate-500">Ditangguhkan</span>
            </div>
            <p class="text-3xl font-bold text-red-500">{{ $suspended }}</p>
        </div>
        <div class="bg-white rounded-2xl border border-slate-100 p-5 shadow-sm">
            <div class="flex items-center gap-2 mb-3">
                <span class="w-2 h-2 rounded-full bg-slate-400"></span>
                <span class="text-xs font-medium text-slate-500">Kedaluwarsa</span>
            </div>
            <p class="text-3xl font-bold text-slate-400">{{ $expired }}</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100">
            <h2 class="text-sm font-semibold text-slate-700">Semua Langganan</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide">Toko</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide">Pemilik</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide">Status</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide">Berakhir</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($shops as $shop)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4 font-semibold text-slate-900">{{ $shop->name }}</td>
                        <td class="px-6 py-4 text-slate-500">{{ $shop->owner?->name ?? '—' }}</td>
                        <td class="px-6 py-4">
                            @if($shop->subscription_status === 'active')
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Aktif
                                </span>
                            @elseif($shop->subscription_status === 'suspended')
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-600">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Ditangguhkan
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-500">
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span> Kedaluwarsa
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-slate-500">
                            {{ $shop->subscription_end_date ? \Carbon\Carbon::parse($shop->subscription_end_date)->format('d M Y') : '—' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-16 text-center">
                            <p class="text-slate-400 text-sm">Tidak ada langganan ditemukan.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.app>
