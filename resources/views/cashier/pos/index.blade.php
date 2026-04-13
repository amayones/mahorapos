<x-layouts.app>
    <div class="mb-4 flex items-center justify-between">
        <div>
            <h1 class="text-xl font-bold text-slate-900">Point of Sale</h1>
            <p class="text-sm text-slate-500 mt-0.5">{{ now()->format('d M Y, H:i') }}</p>
        </div>
        <div class="flex items-center gap-3">
            @if($shift)
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-semibold rounded-full">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Shift Aktif
            </span>
            @else
            <a href="{{ route('cashier.shift') }}"
               class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-amber-50 border border-amber-200 text-amber-700 text-xs font-semibold rounded-full hover:bg-amber-100 transition-colors">
                ⚠ Buka Shift Dulu
            </a>
            @endif
            <a href="{{ route('cashier.history') }}" class="text-sm text-slate-500 hover:text-indigo-600 transition-colors font-medium">Riwayat →</a>
        </div>
    </div>

    <div class="flex gap-5 items-start">

        {{-- Product Grid --}}
        <div class="flex-1 min-w-0">
            @if($products->isEmpty())
            <div class="bg-white rounded-2xl border border-slate-100 p-16 text-center shadow-sm">
                <p class="text-slate-500 text-sm font-medium">Tidak ada produk tersedia</p>
            </div>
            @else
            <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-3">
                @foreach($products as $product)
                <button onclick="addToCart({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->price }}, {{ $product->stock }})"
                    class="bg-white rounded-2xl border border-slate-100 p-4 text-left hover:border-indigo-300 hover:shadow-md transition-all duration-150 group active:scale-95">
                    <div class="w-full h-14 bg-indigo-50 rounded-xl mb-3 flex items-center justify-center group-hover:bg-indigo-100 transition-colors">
                        <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <p class="font-semibold text-slate-900 text-sm truncate">{{ $product->name }}</p>
                    <p class="text-indigo-600 font-bold text-sm mt-0.5">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    <p class="text-xs text-slate-400 mt-0.5">{{ $product->stock }} tersisa</p>
                </button>
                @endforeach
            </div>
            @endif
        </div>

        {{-- Cart Panel --}}
        <div class="w-80 shrink-0">
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm sticky top-6 overflow-hidden">

                {{-- Header --}}
                <div class="px-5 py-3.5 border-b border-slate-100 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <h2 class="font-semibold text-slate-800 text-sm">Keranjang</h2>
                    </div>
                    <span id="cart-count" class="text-xs bg-indigo-100 text-indigo-600 font-bold px-2 py-0.5 rounded-full hidden">0</span>
                </div>

                {{-- Items --}}
                <div id="cart-items" class="px-4 py-3 max-h-52 overflow-y-auto space-y-2">
                    <div class="flex flex-col items-center justify-center py-6 text-center">
                        <p class="text-xs text-slate-400">Keranjang kosong</p>
                    </div>
                </div>

                {{-- Coupon --}}
                <div class="px-4 py-3 border-t border-slate-100">
                    <div class="flex gap-2">
                        <input type="text" id="coupon-input" placeholder="Kode kupon"
                            class="flex-1 px-3 py-2 rounded-xl border border-slate-200 text-xs uppercase focus:outline-none focus:ring-2 focus:ring-indigo-400"
                            oninput="this.value = this.value.toUpperCase()">
                        <button onclick="applyCoupon()"
                            class="px-3 py-2 bg-slate-800 text-white text-xs font-semibold rounded-xl hover:bg-slate-700 transition-colors">
                            Pakai
                        </button>
                    </div>
                    <div id="coupon-info" class="hidden mt-2 px-3 py-2 bg-emerald-50 border border-emerald-200 rounded-xl">
                        <div class="flex items-center justify-between">
                            <div>
                                <p id="coupon-label" class="text-xs font-semibold text-emerald-700"></p>
                                <p id="coupon-desc" class="text-xs text-emerald-600"></p>
                            </div>
                            <button onclick="removeCoupon()" class="text-xs text-red-400 hover:text-red-600 font-medium">✕</button>
                        </div>
                    </div>
                    <p id="coupon-error" class="hidden mt-1.5 text-xs text-red-500"></p>
                </div>

                {{-- Summary --}}
                <div class="px-4 py-3 border-t border-slate-100 bg-slate-50/50 space-y-1.5 text-xs">
                    <div class="flex justify-between text-slate-500">
                        <span>Subtotal</span><span id="sum-subtotal">Rp 0</span>
                    </div>
                    <div class="flex justify-between text-slate-500">
                        <span>Diskon Item</span><span id="sum-item-discount" class="text-red-400">- Rp 0</span>
                    </div>
                    <div id="sum-coupon-row" class="hidden flex justify-between text-emerald-600">
                        <span id="sum-coupon-label">Kupon</span><span id="sum-coupon-val">- Rp 0</span>
                    </div>
                    <div class="flex justify-between text-slate-500">
                        <span>PPN 11%</span><span id="sum-tax">+ Rp 0</span>
                    </div>
                    <div class="flex justify-between font-bold text-slate-900 text-sm pt-1 border-t border-slate-200">
                        <span>Total</span><span id="sum-total" class="text-indigo-600">Rp 0</span>
                    </div>
                </div>

                {{-- Payment --}}
                <div class="px-4 py-3 border-t border-slate-100 space-y-2">
                    <div class="flex gap-1.5">
                        @foreach(['cash' => 'Tunai', 'ewallet' => 'E-Wallet', 'transfer' => 'Transfer'] as $val => $label)
                        <button onclick="setPayment('{{ $val }}')" id="pay-{{ $val }}"
                            class="flex-1 py-1.5 text-xs font-medium rounded-lg border transition-colors
                                   {{ $val === 'cash' ? 'bg-indigo-600 text-white border-indigo-600' : 'border-slate-200 text-slate-600 hover:bg-slate-50' }}">
                            {{ $label }}
                        </button>
                        @endforeach
                    </div>
                    <div id="cash-section">
                        <div class="flex items-center gap-2">
                            <label class="text-xs text-slate-500 w-28 shrink-0">Uang Diterima</label>
                            <input type="number" id="cash-paid" min="0" value="0" oninput="renderChange()"
                                class="flex-1 px-2.5 py-1.5 rounded-lg border border-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        </div>
                        <div class="flex justify-between text-xs mt-1.5 px-0.5">
                            <span class="text-slate-500">Kembalian</span>
                            <span id="change-amount" class="font-bold text-emerald-600">Rp 0</span>
                        </div>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="px-4 pb-4 space-y-2">
                    <button onclick="checkout()"
                        class="w-full py-2.5 bg-indigo-600 text-white font-semibold rounded-xl hover:bg-indigo-700 active:bg-indigo-800 transition-colors text-sm shadow-sm">
                        Bayar
                    </button>
                    <button onclick="clearCart()"
                        class="w-full py-1.5 text-xs text-slate-400 hover:text-red-500 transition-colors font-medium">
                        Kosongkan Keranjang
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Receipt Modal --}}
    <div id="modal-receipt" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50 px-4">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-sm overflow-hidden">
            <div class="bg-indigo-600 px-6 py-4 text-center">
                <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center mx-auto mb-2">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <h3 class="text-white font-bold text-base">Transaksi Berhasil</h3>
                <p id="receipt-id" class="text-indigo-200 text-xs mt-0.5"></p>
            </div>
            <div id="receipt-body" class="px-6 py-4 text-sm space-y-1 max-h-64 overflow-y-auto"></div>
            <div class="px-6 py-4 border-t border-slate-100 space-y-2">
                <button onclick="printReceipt()"
                    class="w-full py-2 border border-slate-200 text-slate-700 text-sm font-medium rounded-xl hover:bg-slate-50 transition-colors">
                    🖨 Cetak Struk
                </button>
                <button onclick="closeReceipt()"
                    class="w-full py-2 bg-indigo-600 text-white text-sm font-semibold rounded-xl hover:bg-indigo-700 transition-colors">
                    Transaksi Baru
                </button>
            </div>
        </div>
    </div>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        const TAX = 11;
        let cart          = {};
        let paymentMethod = 'cash';
        let appliedCoupon = null;

        function fmt(n) { return 'Rp ' + Math.round(n).toLocaleString('id-ID'); }

        function addToCart(id, name, price, stock) {
            if (!cart[id]) cart[id] = { name, price, qty: 0, stock, discount: 0 };
            if (cart[id].qty >= stock) return alert(`Stok "${name}" hanya tersisa ${stock}.`);
            cart[id].qty++;
            renderCart();
        }

        function changeQty(id, delta) {
            cart[id].qty += delta;
            if (cart[id].qty <= 0) delete cart[id];
            renderCart();
        }

        function setItemDiscount(id, val) {
            if (cart[id]) { cart[id].discount = parseFloat(val) || 0; renderSummary(); }
        }

        function clearCart() { cart = {}; removeCoupon(); renderCart(); }

        function setPayment(method) {
            paymentMethod = method;
            ['cash','ewallet','transfer'].forEach(m => {
                const btn = document.getElementById('pay-' + m);
                btn.className = btn.className
                    .replace('bg-indigo-600 text-white border-indigo-600', '')
                    .replace('border-slate-200 text-slate-600 hover:bg-slate-50', '')
                    .trim();
                btn.className += ' ' + (m === method
                    ? 'bg-indigo-600 text-white border-indigo-600'
                    : 'border-slate-200 text-slate-600 hover:bg-slate-50');
            });
            document.getElementById('cash-section').style.display = method === 'cash' ? '' : 'none';
        }

        function getSubtotal() {
            return Object.values(cart).reduce((s, i) => s + (i.price - i.discount) * i.qty, 0);
        }

        function getItemDiscountTotal() {
            return Object.values(cart).reduce((s, i) => s + i.discount * i.qty, 0);
        }

        function getAmounts() {
            const grossSubtotal = Object.values(cart).reduce((s, i) => s + i.price * i.qty, 0);
            const itemDisc      = getItemDiscountTotal();
            const subtotal      = grossSubtotal - itemDisc;
            const couponDisc    = appliedCoupon
                ? (appliedCoupon.type === 'percent'
                    ? Math.round(subtotal * appliedCoupon.value / 100)
                    : Math.min(appliedCoupon.value, subtotal))
                : 0;
            const afterDisc     = subtotal - couponDisc;
            const tax           = Math.round(afterDisc * TAX / 100);
            const total         = afterDisc + tax;
            return { grossSubtotal, itemDisc, subtotal, couponDisc, tax, total };
        }

        function renderCart() {
            const container = document.getElementById('cart-items');
            const countEl   = document.getElementById('cart-count');
            const keys      = Object.keys(cart);

            if (!keys.length) {
                container.innerHTML = `<div class="flex flex-col items-center justify-center py-6 text-center">
                    <p class="text-xs text-slate-400">Keranjang kosong</p></div>`;
                countEl.classList.add('hidden');
                renderSummary();
                return;
            }

            let html = '';
            keys.forEach(id => {
                const item = cart[id];
                html += `<div class="flex items-start gap-2 py-1.5">
                    <div class="flex-1 min-w-0">
                        <p class="font-medium text-slate-800 text-xs truncate">${item.name}</p>
                        <p class="text-slate-400 text-xs">${fmt(item.price)}</p>
                        <div class="flex items-center gap-1 mt-1">
                            <span class="text-xs text-slate-400">Diskon:</span>
                            <input type="number" min="0" value="${item.discount}"
                                onchange="setItemDiscount(${id}, this.value)"
                                class="w-20 px-1.5 py-0.5 text-xs border border-slate-200 rounded-md focus:outline-none focus:ring-1 focus:ring-indigo-400">
                        </div>
                    </div>
                    <div class="flex items-center gap-1 shrink-0 mt-1">
                        <button onclick="changeQty(${id}, -1)" class="w-5 h-5 rounded-md bg-slate-100 hover:bg-slate-200 text-xs font-bold flex items-center justify-center">−</button>
                        <span class="font-bold text-slate-800 text-xs w-5 text-center">${item.qty}</span>
                        <button onclick="changeQty(${id}, 1)"  class="w-5 h-5 rounded-md bg-slate-100 hover:bg-slate-200 text-xs font-bold flex items-center justify-center">+</button>
                    </div>
                </div>`;
            });

            container.innerHTML = html;
            countEl.textContent = keys.length;
            countEl.classList.remove('hidden');
            renderSummary();
        }

        function renderSummary() {
            const { grossSubtotal, itemDisc, subtotal, couponDisc, tax, total } = getAmounts();
            document.getElementById('sum-subtotal').textContent      = fmt(grossSubtotal);
            document.getElementById('sum-item-discount').textContent = '- ' + fmt(itemDisc);
            document.getElementById('sum-tax').textContent           = '+ ' + fmt(tax);
            document.getElementById('sum-total').textContent         = fmt(total);

            const couponRow = document.getElementById('sum-coupon-row');
            if (appliedCoupon && couponDisc > 0) {
                document.getElementById('sum-coupon-label').textContent = `Kupon (${appliedCoupon.code})`;
                document.getElementById('sum-coupon-val').textContent   = '- ' + fmt(couponDisc);
                couponRow.classList.remove('hidden');
            } else {
                couponRow.classList.add('hidden');
            }
            renderChange();
        }

        function renderChange() {
            const { total } = getAmounts();
            const paid      = parseFloat(document.getElementById('cash-paid').value) || 0;
            document.getElementById('change-amount').textContent = fmt(Math.max(0, paid - total));
        }

        async function applyCoupon() {
            const code = document.getElementById('coupon-input').value.trim();
            if (!code) return;

            const errEl  = document.getElementById('coupon-error');
            const infoEl = document.getElementById('coupon-info');
            errEl.classList.add('hidden');

            try {
                const res  = await fetch('{{ route("cashier.pos.validate-coupon") }}', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
                    body: JSON.stringify({ code }),
                });
                const data = await res.json();

                if (!res.ok) {
                    errEl.textContent = data.message;
                    errEl.classList.remove('hidden');
                    return;
                }

                appliedCoupon = data;
                document.getElementById('coupon-label').textContent = `✓ ${data.code} — ${data.type === 'percent' ? data.value + '%' : fmt(data.value)} off`;
                document.getElementById('coupon-desc').textContent  = data.description ?? '';
                infoEl.classList.remove('hidden');
                renderSummary();
            } catch (e) {
                errEl.textContent = 'Gagal memvalidasi kupon.';
                errEl.classList.remove('hidden');
            }
        }

        function removeCoupon() {
            appliedCoupon = null;
            document.getElementById('coupon-input').value = '';
            document.getElementById('coupon-info').classList.add('hidden');
            document.getElementById('coupon-error').classList.add('hidden');
            renderSummary();
        }

        async function checkout() {
            const keys = Object.keys(cart);
            if (!keys.length) return alert('Keranjang masih kosong!');

            const { total } = getAmounts();
            const cashPaid  = parseFloat(document.getElementById('cash-paid').value) || total;

            if (paymentMethod === 'cash' && cashPaid < total) return alert('Uang yang diterima kurang dari total!');

            const items = keys.map(id => ({ id: parseInt(id), qty: cart[id].qty, discount: cart[id].discount }));

            try {
                const res  = await fetch('{{ route("cashier.pos.checkout") }}', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
                    body: JSON.stringify({ items, coupon_id: appliedCoupon?.id ?? null, payment_method: paymentMethod, cash_paid: cashPaid }),
                });
                const data = await res.json();
                if (!res.ok) return alert(data.message ?? 'Terjadi kesalahan.');

                showReceipt(data.transaction, total, cashPaid, Math.max(0, cashPaid - total));
                clearCart();
            } catch (e) {
                alert('Gagal terhubung ke server.');
            }
        }

        function showReceipt(tx, total, paid, change) {
            document.getElementById('receipt-id').textContent = `#${tx.id} · ${new Date().toLocaleString('id-ID')}`;

            let html = tx.items.map(i =>
                `<div class="flex justify-between text-xs text-slate-600">
                    <span>${i.product?.name ?? '—'} x${i.qty}${i.discount > 0 ? ` <span class="text-red-400">(-${fmt(i.discount)})</span>` : ''}</span>
                    <span>${fmt((i.price - i.discount) * i.qty)}</span>
                </div>`
            ).join('');

            html += `<div class="border-t border-dashed border-slate-200 my-2"></div>
                <div class="flex justify-between text-xs text-slate-500"><span>Subtotal</span><span>${fmt(tx.subtotal)}</span></div>
                ${tx.discount_amount > 0 ? `<div class="flex justify-between text-xs text-emerald-600"><span>Kupon${tx.coupon ? ' (' + tx.coupon.code + ')' : ''}</span><span>- ${fmt(tx.discount_amount)}</span></div>` : ''}
                <div class="flex justify-between text-xs text-slate-500"><span>PPN 11%</span><span>+ ${fmt(tx.tax_amount)}</span></div>
                <div class="flex justify-between font-bold text-sm text-slate-900 mt-1"><span>Total</span><span>${fmt(total)}</span></div>
                ${tx.payment_method === 'cash' ? `
                <div class="flex justify-between text-xs text-slate-500 mt-1"><span>Tunai</span><span>${fmt(paid)}</span></div>
                <div class="flex justify-between text-xs font-semibold text-emerald-600"><span>Kembalian</span><span>${fmt(change)}</span></div>` : ''}`;

            document.getElementById('receipt-body').innerHTML = html;
            document.getElementById('modal-receipt').classList.remove('hidden');
        }

        function printReceipt() {
            const body = document.getElementById('receipt-body').innerHTML;
            const id   = document.getElementById('receipt-id').textContent;
            const win  = window.open('', '_blank', 'width=300,height=500');
            win.document.write(`<html><head><title>Struk</title>
                <style>body{font-family:monospace;font-size:12px;padding:16px;width:280px}
                .flex{display:flex;justify-content:space-between}</style></head>
                <body><h3 style="text-align:center">MahoraPOS</h3>
                <p style="text-align:center;font-size:10px">${id}</p><hr>${body}</body></html>`);
            win.document.close(); win.print();
        }

        function closeReceipt() {
            document.getElementById('modal-receipt').classList.add('hidden');
            location.reload();
        }

        setPayment('cash');
    </script>
</x-layouts.app>
