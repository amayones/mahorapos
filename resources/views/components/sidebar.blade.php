@php $role = auth()->user()->role; @endphp

<aside class="w-64 shrink-0 flex flex-col bg-slate-900 min-h-screen">

    {{-- Brand --}}
    <div class="flex items-center gap-3 px-5 py-5 border-b border-slate-700/60">
        <div class="w-8 h-8 rounded-lg bg-indigo-500 flex items-center justify-center shrink-0">
            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
            </svg>
        </div>
        <div>
            <p class="text-white font-bold text-sm leading-none">MahoraPOS</p>
            <p class="text-slate-400 text-xs mt-0.5 capitalize">{{ $role }} Panel</p>
        </div>
    </div>

    {{-- Nav --}}
    <nav class="flex-1 px-3 py-4 space-y-0.5 overflow-y-auto">

        @if($role === 'owner')
            @include('components.sidebar-link', ['route' => 'owner.dashboard', 'label' => 'Dashboard', 'icon' => 'home'])
            @include('components.sidebar-link', ['route' => 'owner.users',     'label' => 'Users',     'icon' => 'users'])
            @include('components.sidebar-link', ['route' => 'owner.products',  'label' => 'Products',  'icon' => 'box'])
            @include('components.sidebar-link', ['route' => 'owner.reports',   'label' => 'Reports',   'icon' => 'chart'])

        @elseif($role === 'cashier')
            @include('components.sidebar-link', ['route' => 'cashier.dashboard', 'label' => 'Dashboard', 'icon' => 'home'])
            @include('components.sidebar-link', ['route' => 'cashier.pos',       'label' => 'POS',       'icon' => 'cart'])

        @elseif($role === 'staff')
            @include('components.sidebar-link', ['route' => 'staff.dashboard',  'label' => 'Dashboard', 'icon' => 'home'])
            @include('components.sidebar-link', ['route' => 'staff.inventory',  'label' => 'Inventory', 'icon' => 'clipboard'])

        @elseif($role === 'admin')
            @include('components.sidebar-link', ['route' => 'admin.dashboard',     'label' => 'Dashboard',     'icon' => 'home'])
            @include('components.sidebar-link', ['route' => 'admin.shops',         'label' => 'Shops',         'icon' => 'shop'])
            @include('components.sidebar-link', ['route' => 'admin.subscriptions', 'label' => 'Subscriptions', 'icon' => 'credit'])
        @endif

    </nav>

    {{-- User footer --}}
    <div class="px-4 py-4 border-t border-slate-700/60">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-indigo-500/20 flex items-center justify-center shrink-0">
                <span class="text-indigo-300 text-xs font-bold uppercase">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </span>
            </div>
            <div class="min-w-0">
                <p class="text-slate-200 text-xs font-semibold truncate">{{ auth()->user()->name }}</p>
                <p class="text-slate-500 text-xs truncate">{{ auth()->user()->email }}</p>
            </div>
        </div>
    </div>

</aside>
