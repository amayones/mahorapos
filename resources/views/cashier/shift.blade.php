<x-layouts.app>
    <div class="mb-6">
        <h1 class="text-xl font-bold text-slate-900">Manajemen Shift</h1>
        <p class="text-sm text-slate-500 mt-0.5">Buka dan tutup shift kasir Anda</p>
    </div>

    @if(session('success'))
    <div class="mb-4 px-4 py-3 bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm rounded-xl">{{ session('success') }}</div>
    @endif
    @if(session('warning'))
    <div class="mb-4 flex items-center gap-3 px-4 py-3 bg-amber-50 border border-amber-200 text-amber-800 text-sm rounded-xl">
        <svg class="w-4 h-4 shrink-0 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
        </svg>
        {{ session('warning') }}
    </div>
    @endif
    @if($errors->any())
    <div class="mb-4 px-4 py-3 bg-red-50 border border-red-200 text-red-700 text-sm rounded-xl">{{ $errors->first() }}</div>
    @endif

    @if($shift)
    {{-- Shift Aktif --}}
    <div class="bg-emerald-50 border border-emerald-200 rounded-2xl p-6 mb-6">
        <div class="flex items-center gap-3 mb-4">
            <span class="w-3 h-3 rounded-full bg-emerald-500 animate-pulse"></span>
            <h2 class="font-bold text-emerald-800">Shift Sedang Berjalan</h2>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 text-sm mb-5">
            <div>
                <p class="text-xs text-emerald-600">Dibuka</p>
                <p class="font-semibold text-emerald-900">{{ \Carbon\Carbon::parse($shift->opened_at)->format('d M Y, H:i') }}</p>
            </div>
            <div>
                <p class="text-xs text-emerald-600">Kas Awal</p>
                <p class="font-semibold text-emerald-900">Rp {{ number_format($shift->opening_cash, 0, ',', '.') }}</p>
            </div>
            <div>
                <p class="text-xs text-emerald-600">Transaksi</p>
                <p class="font-semibold text-emerald-900">{{ $shift->transactions()->where('status','completed')->count() }}</p>
            </div>
        </div>

        <form method="POST" action="{{ route('cashier.shift.close') }}" class="space-y-3 max-w-sm">
            @csrf
            <div>
                <label class="block text-sm font-medium text-emerald-800 mb-1.5">Uang Kas Akhir (Rp)</label>
                <input type="number" name="closing_cash" min="0" required
                    class="w-full px-3.5 py-2.5 rounded-xl border border-emerald-300 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 bg-white"
                    placeholder="0">
            </div>
            <div>
                <label class="block text-sm font-medium text-emerald-800 mb-1.5">Catatan (opsional)</label>
                <input type="text" name="note"
                    class="w-full px-3.5 py-2.5 rounded-xl border border-emerald-300 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 bg-white"
                    placeholder="Catatan penutupan shift...">
            </div>
            <button type="button" onclick="openModal()"
                class="px-5 py-2.5 bg-emerald-600 text-white text-sm font-semibold rounded-xl hover:bg-emerald-700 transition-colors">
                Tutup Shift
            </button>
        </form>
    </div>
    @else
    {{-- Buka Shift --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 mb-6 max-w-sm">
        <h2 class="font-bold text-slate-900 mb-4">Buka Shift Baru</h2>
        <form method="POST" action="{{ route('cashier.shift.open') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Uang Kas Awal (Rp)</label>
                <input type="number" name="opening_cash" min="0" required
                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    placeholder="Contoh: 500000">
            </div>
            <button type="submit"
                class="w-full py-2.5 bg-indigo-600 text-white text-sm font-semibold rounded-xl hover:bg-indigo-700 transition-colors">
                Buka Shift
            </button>
        </form>
    </div>
    @endif

    {{-- Riwayat Shift --}}
    @if($lastShifts->count())
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100">
            <h2 class="text-sm font-semibold text-slate-700">Riwayat Shift Terakhir</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">Dibuka</th>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">Ditutup</th>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">Kas Awal</th>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">Kas Akhir</th>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">Ekspektasi</th>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">Selisih</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($lastShifts as $s)
                    <tr class="hover:bg-slate-50/50">
                        <td class="px-5 py-3 text-xs text-slate-600">{{ \Carbon\Carbon::parse($s->opened_at)->format('d M, H:i') }}</td>
                        <td class="px-5 py-3 text-xs text-slate-600">{{ \Carbon\Carbon::parse($s->closed_at)->format('d M, H:i') }}</td>
                        <td class="px-5 py-3 text-xs">Rp {{ number_format($s->opening_cash, 0, ',', '.') }}</td>
                        <td class="px-5 py-3 text-xs">Rp {{ number_format($s->closing_cash, 0, ',', '.') }}</td>
                        <td class="px-5 py-3 text-xs">Rp {{ number_format($s->expected_cash, 0, ',', '.') }}</td>
                        <td class="px-5 py-3 text-xs font-semibold {{ $s->cash_difference >= 0 ? 'text-emerald-600' : 'text-red-500' }}">
                            {{ $s->cash_difference >= 0 ? '+' : '' }}Rp {{ number_format($s->cash_difference, 0, ',', '.') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <div id="modalCloseShift" class="fixed inset-0 z-50 hidden items-center justify-center">
    <div id="modalOverlay" class="absolute inset-0 bg-black/40 opacity-0 transition-opacity duration-200"></div>

    <div id="modalContent"
        class="relative bg-white rounded-2xl p-6 w-full max-w-sm
        opacity-0 scale-95 transition-all duration-200">
        
        <h3 class="text-lg font-semibold text-slate-900 mb-2">Tutup Shift</h3>
        <p class="text-sm text-slate-500 mb-5">Yakin mau tutup shift sekarang?</p>

        <div class="flex justify-end gap-2">
            <button onclick="closeModal()"
                class="px-4 py-2 text-sm rounded-xl border border-slate-200">
                Batal
            </button>
            <button onclick="submitCloseShift()"
                class="px-4 py-2 text-sm rounded-xl bg-emerald-600 text-white">
                Ya, Tutup
            </button>
        </div>
    </div>
</div>

<script>
const modal = document.getElementById('modalCloseShift');
const overlay = document.getElementById('modalOverlay');
const content = document.getElementById('modalContent');

function openModal() {
    modal.classList.remove('hidden');
    modal.classList.add('flex');

    setTimeout(() => {
        overlay.classList.remove('opacity-0');
        content.classList.remove('opacity-0', 'scale-95');
    }, 10);
}

function closeModal() {
    overlay.classList.add('opacity-0');
    content.classList.add('opacity-0', 'scale-95');

    setTimeout(() => {
        modal.classList.add('hidden');
    }, 200);
}

function submitCloseShift() {
    document.querySelector('form[action="{{ route('cashier.shift.close') }}"]').submit();
}

// klik luar
overlay.addEventListener('click', closeModal);

// esc key
document.addEventListener('keydown', function(e) {
    if (e.key === "Escape") {
        closeModal();
    }
});
</script>
</x-layouts.app>
