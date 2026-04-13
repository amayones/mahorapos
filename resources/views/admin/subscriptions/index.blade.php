<x-layouts.app>
    <div class="mb-6">
        <h1 class="text-xl font-bold text-slate-900">Langganan</h1>
        <p class="text-sm text-slate-500 mt-0.5">Pantau dan kelola status langganan semua toko</p>
    </div>

    @if(session('success'))
    <div class="mb-4 px-4 py-3 bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm rounded-xl">
        {{ session('success') }}
    </div>
    @endif

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
                        <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide">Aksi</th>
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
                        <td class="px-6 py-4">
                            <button onclick="openExtendModal({{ $shop->id }}, '{{ addslashes($shop->name) }}')"
                                class="text-xs text-indigo-500 hover:text-indigo-700 font-medium transition-colors">
                                Perpanjang
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center">
                            <p class="text-slate-400 text-sm">Tidak ada langganan ditemukan.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Perpanjang Langganan --}}
    <div id="modal-extend" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/40 px-4">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-sm p-6">
            <div class="flex items-center justify-between mb-5">
                <div>
                    <h3 class="text-base font-bold text-slate-900">Perpanjang Langganan</h3>
                    <p id="modal-shop-name" class="text-sm text-slate-500 mt-0.5"></p>
                </div>
                <button onclick="document.getElementById('modal-extend').classList.add('hidden')"
                    class="text-slate-400 hover:text-slate-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <form id="modal-extend-form" method="POST" class="space-y-4">
                @csrf @method('PATCH')
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Perpanjang (hari)</label>
                    <div class="flex gap-2 mb-3">
                        @foreach([30, 90, 180, 365] as $d)
                        <button type="button" onclick="document.querySelector('[name=days]').value = {{ $d }}"
                            class="flex-1 py-1.5 text-xs font-medium border border-slate-200 rounded-lg hover:bg-indigo-50 hover:border-indigo-300 hover:text-indigo-600 transition-colors">
                            {{ $d }}h
                        </button>
                        @endforeach
                    </div>
                    <input type="number" name="days" min="1" max="365" required
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        placeholder="Jumlah hari">
                </div>
                <p class="text-xs text-slate-400">Jika langganan masih aktif, hari akan ditambahkan dari tanggal berakhir saat ini.</p>
                <div class="flex gap-3 pt-1">
                    <button type="button" onclick="document.getElementById('modal-extend').classList.add('hidden')"
                        class="flex-1 py-2.5 border border-slate-200 text-slate-600 text-sm font-medium rounded-xl hover:bg-slate-50 transition-colors">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 py-2.5 bg-indigo-600 text-white text-sm font-semibold rounded-xl hover:bg-indigo-700 transition-colors">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openExtendModal(id, name) {
            document.getElementById('modal-extend-form').action = `/admin/subscriptions/${id}/extend`;
            document.getElementById('modal-shop-name').textContent = name;
            document.getElementById('modal-extend').classList.remove('hidden');
        }
    </script>
</x-layouts.app>
