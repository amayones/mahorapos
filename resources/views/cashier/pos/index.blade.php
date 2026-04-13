<x-layouts.app>
    <x-page-header title="Point of Sale" subtitle="Pilih produk untuk ditambahkan ke keranjang" />

    <div class="flex gap-5 items-start">

        {{-- Product Grid --}}
        <div class="flex-1 min-w-0">
            @if($products->isEmpty())
            <div class="bg-white rounded-2xl border border-slate-100 p-16 text-center shadow-sm">
                <div class="w-12 h-12 rounded-2xl bg-slate-100 flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <p class="text-slate-500 text-sm font-medium">Tidak ada produk tersedia</p>
                <p class="text-slate-400 text-xs mt-1">Minta pemilik untuk menambahkan produk terlebih dahulu</p>
            </div>
            @else
            <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-3">
                @foreach($products as $product)
                <button onclick="addToCart({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->price }})"
                    class="bg-white rounded-2xl border border-slate-100 p-4 text-left hover:border-indigo-300 hover:shadow-md transition-all duration-150 group active:scale-95">
                    <div class="w-full h-16 bg-indigo-50 rounded-xl mb-3 flex items-center justify-center group-hover:bg-indigo-100 transition-colors">
                        <svg class="w-7 h-7 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <p class="font-semibold text-slate-900 text-sm truncate">{{ $product->name }}</p>
                    <p class="text-indigo-600 font-bold text-sm mt-0.5">Rp {{ number_format($product->price, 2) }}</p>
                    <p class="text-xs text-slate-400 mt-0.5">{{ $product->stock }} tersisa</p>
                </button>
                @endforeach
            </div>
            @endif
        </div>

        {{-- Cart Panel --}}
        <div class="w-72 shrink-0">
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm sticky top-6 overflow-hidden">

                {{-- Cart header --}}
                <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <h2 class="font-semibold text-slate-800 text-sm">Keranjang</h2>
                    </div>
                    <span id="cart-count" class="text-xs bg-indigo-100 text-indigo-600 font-bold px-2 py-0.5 rounded-full hidden">0</span>
                </div>

                {{-- Cart items --}}
                <div id="cart-items" class="px-5 py-4 min-h-36 max-h-80 overflow-y-auto space-y-3">
                    <div id="cart-empty" class="flex flex-col items-center justify-center py-8 text-center">
                        <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center mb-2">
                            <svg class="w-5 h-5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <p class="text-xs text-slate-400">Keranjang kosong</p>
                    </div>
                </div>

                {{-- Cart footer --}}
                <div class="px-5 py-4 border-t border-slate-100 bg-slate-50/50">
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-sm font-semibold text-slate-700">Total</span>
                        <span id="cart-total" class="text-lg font-bold text-indigo-600">Rp 0,00</span>
                    </div>
                    <button onclick="checkout()"
                        class="w-full py-2.5 bg-indigo-600 text-white font-semibold rounded-xl hover:bg-indigo-700 active:bg-indigo-800 transition-colors text-sm shadow-sm">
                        Bayar
                    </button>
                    <button onclick="clearCart()"
                        class="w-full mt-2 py-2 text-xs text-slate-400 hover:text-red-500 transition-colors font-medium">
                        Kosongkan Keranjang
                    </button>
                </div>
            </div>
        </div>

    </div>

    <script>
        let cart = {};

        function addToCart(id, name, price) {
            cart[id] ? cart[id].qty++ : (cart[id] = { name, price, qty: 1 });
            renderCart();
        }

        function changeQty(id, delta) {
            cart[id].qty += delta;
            if (cart[id].qty <= 0) delete cart[id];
            renderCart();
        }

        function clearCart() { cart = {}; renderCart(); }

        function renderCart() {
            const container = document.getElementById('cart-items');
            const emptyEl   = document.getElementById('cart-empty');
            const totalEl   = document.getElementById('cart-total');
            const countEl   = document.getElementById('cart-count');
            const keys      = Object.keys(cart);

            if (keys.length === 0) {
                container.innerHTML = `<div id="cart-empty" class="flex flex-col items-center justify-center py-8 text-center">
                    <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center mb-2">
                        <svg class="w-5 h-5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <p class="text-xs text-slate-400">Keranjang kosong</p>
                </div>`;
                totalEl.textContent = 'Rp 0,00';
                countEl.classList.add('hidden');
                return;
            }

            let total = 0, html = '';
            keys.forEach(id => {
                const item = cart[id];
                total += item.price * item.qty;
                html += `<div class="flex items-center justify-between gap-2">
                    <div class="flex-1 min-w-0">
                        <p class="font-medium text-slate-800 text-xs truncate">${item.name}</p>
                        <p class="text-slate-400 text-xs">Rp ${item.price.toFixed(2)}</p>
                    </div>
                    <div class="flex items-center gap-1.5 shrink-0">
                        <button onclick="changeQty(${id}, -1)" class="w-5 h-5 rounded-md bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-bold flex items-center justify-center transition-colors">−</button>
                        <span class="font-bold text-slate-800 text-xs w-4 text-center">${item.qty}</span>
                        <button onclick="changeQty(${id}, 1)"  class="w-5 h-5 rounded-md bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-bold flex items-center justify-center transition-colors">+</button>
                    </div>
                </div>`;
            });

            container.innerHTML = html;
            totalEl.textContent = 'Rp ' + total.toFixed(2);
            countEl.textContent = keys.length;
            countEl.classList.remove('hidden');
        }

        function checkout() {
            if (!Object.keys(cart).length) return alert('Keranjang masih kosong!');
            alert('Fitur pembayaran segera hadir!');
        }
    </script>
</x-layouts.app>
