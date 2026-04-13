<x-layouts.app>
    <x-page-header title="Toko" subtitle="Semua toko terdaftar di MahoraPOS" />

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <h2 class="text-sm font-semibold text-slate-700">Semua Toko</h2>
            <span class="text-xs text-slate-400 bg-slate-50 border border-slate-100 px-2 py-0.5 rounded-full">
                {{ $shops->count() }} registered
            </span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide">#</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide">Toko</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide">Pemilik</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide">Status</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide">Berakhir</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($shops as $shop)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4 text-slate-400 text-xs">{{ $loop->iteration }}</td>
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
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <button class="text-xs text-indigo-500 hover:text-indigo-700 font-medium transition-colors">Aktifkan</button>
                                <button class="text-xs text-red-400 hover:text-red-600 font-medium transition-colors">Tangguhkan</button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center">
                            <p class="text-slate-400 text-sm">Belum ada toko terdaftar.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.app>
