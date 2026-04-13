@php $role = auth()->user()->role; @endphp

<aside class="w-64 shrink-0 flex flex-col bg-gray-900 min-h-screen">

    {{-- Brand --}}
    <div class="flex items-center gap-3 px-6 h-16 shrink-0">
        <div class="w-7 h-7 rounded-lg bg-indigo-500 flex items-center justify-center shrink-0">
            <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
            </svg>
        </div>
        <span class="text-white font-semibold text-sm tracking-tight">MahoraPOS</span>
    </div>

    {{-- Role label --}}
    <div class="px-6 pb-3">
        <span class="text-xs font-medium text-gray-500 uppercase tracking-widest">{{ $role }}</span>
    </div>

    {{-- Nav --}}
    <nav class="flex-1 px-3 space-y-0.5 overflow-y-auto">

        @if($role === 'owner')
            @include('components.sidebar-link', ['route' => 'owner.dashboard', 'label' => 'Dasbor',    'icon' => 'home'])
            @include('components.sidebar-link', ['route' => 'owner.users',     'label' => 'Pengguna',  'icon' => 'users'])
            @include('components.sidebar-link', ['route' => 'owner.products',  'label' => 'Produk',    'icon' => 'box'])
            @include('components.sidebar-link', ['route' => 'owner.coupons',   'label' => 'Kupon',     'icon' => 'tag'])
            @include('components.sidebar-link', ['route' => 'owner.reports',   'label' => 'Laporan',   'icon' => 'chart'])

        @elseif($role === 'cashier')
            @include('components.sidebar-link', ['route' => 'cashier.dashboard', 'label' => 'Dasbor',  'icon' => 'home'])
            @include('components.sidebar-link', ['route' => 'cashier.pos',       'label' => 'POS',     'icon' => 'cart'])
            @include('components.sidebar-link', ['route' => 'cashier.history',   'label' => 'Riwayat', 'icon' => 'clipboard'])
            @include('components.sidebar-link', ['route' => 'cashier.shift',     'label' => 'Shift',   'icon' => 'clock'])

        @elseif($role === 'staff')
            @include('components.sidebar-link', ['route' => 'staff.dashboard',  'label' => 'Dasbor',    'icon' => 'home'])
            @include('components.sidebar-link', ['route' => 'staff.inventory',  'label' => 'Inventaris','icon' => 'clipboard'])

        @elseif($role === 'admin')
            @include('components.sidebar-link', ['route' => 'admin.dashboard',     'label' => 'Dasbor',    'icon' => 'home'])
            @include('components.sidebar-link', ['route' => 'admin.shops',         'label' => 'Toko',      'icon' => 'shop'])
            @include('components.sidebar-link', ['route' => 'admin.subscriptions', 'label' => 'Langganan', 'icon' => 'credit'])
        @endif

    </nav>

    {{-- User footer --}}
    <div class="px-3 py-4 mt-auto">
        <div class="flex items-center gap-3 px-3 py-2.5 rounded-lg bg-gray-800/60">
            <div class="w-8 h-8 rounded-full bg-indigo-600 flex items-center justify-center shrink-0">
                <span class="text-white text-xs font-bold uppercase">{{ substr(auth()->user()->name, 0, 1) }}</span>
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-gray-200 text-xs font-semibold truncate">{{ auth()->user()->name }}</p>
                <p class="text-gray-500 text-xs truncate">{{ auth()->user()->email }}</p>
            </div>
        </div>
    </div>

</aside>
