<x-layouts.app>
    <div class="flex items-start justify-between mb-6">
        <div>
            <h1 class="text-xl font-bold text-slate-900">Kupon</h1>
            <p class="text-sm text-slate-500 mt-0.5">Kelola kode diskon untuk toko Anda</p>
        </div>
        <button onclick="document.getElementById('modal-add').classList.remove('hidden')"
            class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700 transition-colors shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Buat Kupon
        </button>
    </div>

    @if(session('success'))
    <div class="mb-4 px-4 py-3 bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm rounded-xl">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">Kode</th>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">Deskripsi</th>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">Nilai</th>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">Penggunaan</th>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">Kadaluarsa</th>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">Status</th>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($coupons as $coupon)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-5 py-3 font-mono font-bold text-slate-900">{{ $coupon->code }}</td>
                        <td class="px-5 py-3 text-slate-500 text-xs">{{ $coupon->description ?? '—' }}</td>
                        <td class="px-5 py-3 font-semibold text-indigo-600">
                            {{ $coupon->type === 'percent' ? $coupon->value.'%' : 'Rp '.number_format($coupon->value, 0, ',', '.') }}
                        </td>
                        <td class="px-5 py-3 text-slate-600 text-xs">{{ $coupon->used_count }} / {{ $coupon->max_uses ?? '∞' }}</td>
                        <td class="px-5 py-3 text-slate-500 text-xs">{{ $coupon->expires_at ? $coupon->expires_at->format('d M Y') : '—' }}</td>
                        <td class="px-5 py-3">
                            @if($coupon->isValid())
                                <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">Aktif</span>
                            @else
                                <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-500">Nonaktif</span>
                            @endif
                        </td>
                        <td class="px-5 py-3">
                            <div class="flex items-center gap-3">
                                <form method="POST" action="{{ route('owner.coupons.toggle', $coupon) }}">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="text-xs text-indigo-500 hover:text-indigo-700 font-medium">
                                        {{ $coupon->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('owner.coupons.destroy', $coupon) }}"
                                      onsubmit="return confirm('Hapus kupon ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-xs text-red-400 hover:text-red-600 font-medium">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="px-5 py-16 text-center text-slate-400 text-sm">Belum ada kupon.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal --}}
    <div id="modal-add" class="{{ $errors->any() ? '' : 'hidden' }} fixed inset-0 z-50 flex items-center justify-center bg-black/40 px-4">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6">
            <div class="flex items-center justify-between mb-5">
                <h3 class="text-base font-bold text-slate-900">Buat Kupon Baru</h3>
                <button onclick="document.getElementById('modal-add').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            @if($errors->any())
            <div class="mb-4 px-3 py-2 bg-red-50 border border-red-200 text-red-600 text-xs rounded-xl">{{ $errors->first() }}</div>
            @endif
            <form method="POST" action="{{ route('owner.coupons.store') }}" class="space-y-3">
                @csrf
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-medium text-slate-700 mb-1">Kode Kupon</label>
                        <input type="text" name="code" value="{{ old('code') }}" required
                            class="w-full px-3 py-2 rounded-xl border border-slate-200 text-sm uppercase focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            placeholder="DISKON10" oninput="this.value=this.value.toUpperCase()">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-700 mb-1">Tipe</label>
                        <select name="type" required class="w-full px-3 py-2 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="fixed" {{ old('type') === 'fixed' ? 'selected' : '' }}>Nominal (Rp)</option>
                            <option value="percent" {{ old('type') === 'percent' ? 'selected' : '' }}>Persen (%)</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-slate-700 mb-1">Nilai Diskon</label>
                    <input type="number" name="value" value="{{ old('value') }}" min="0" required
                        class="w-full px-3 py-2 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        placeholder="10000 atau 10">
                </div>
                <div>
                    <label class="block text-xs font-medium text-slate-700 mb-1">Deskripsi (opsional)</label>
                    <input type="text" name="description" value="{{ old('description') }}"
                        class="w-full px-3 py-2 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        placeholder="Diskon pelanggan baru">
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-medium text-slate-700 mb-1">Maks. Penggunaan</label>
                        <input type="number" name="max_uses" value="{{ old('max_uses') }}" min="1"
                            class="w-full px-3 py-2 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            placeholder="Kosong = tak terbatas">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-700 mb-1">Kadaluarsa</label>
                        <input type="date" name="expires_at" value="{{ old('expires_at') }}"
                            class="w-full px-3 py-2 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                </div>
                <div class="flex gap-3 pt-1">
                    <button type="button" onclick="document.getElementById('modal-add').classList.add('hidden')"
                        class="flex-1 py-2.5 border border-slate-200 text-slate-600 text-sm font-medium rounded-xl hover:bg-slate-50">Batal</button>
                    <button type="submit"
                        class="flex-1 py-2.5 bg-indigo-600 text-white text-sm font-semibold rounded-xl hover:bg-indigo-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
