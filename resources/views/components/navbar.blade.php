<header class="h-16 bg-white border-b border-gray-200 px-8 flex items-center justify-between shrink-0">

    {{-- Kiri: breadcrumb / nama toko --}}
    <div class="flex items-center gap-2.5">
        <div class="w-2 h-2 rounded-full bg-emerald-400"></div>
        <span class="text-sm font-medium text-gray-700">
            {{ auth()->user()->shop?->name ?? 'MahoraPOS' }}
        </span>
    </div>

    {{-- Kanan --}}
    <div class="flex items-center gap-4">

        {{-- User info --}}
        <div class="hidden sm:flex items-center gap-3">
            <div class="text-right">
                <p class="text-sm font-semibold text-gray-800 leading-none">{{ auth()->user()->name }}</p>
                <p class="text-xs text-gray-400 mt-0.5 capitalize">{{ auth()->user()->role }}</p>
            </div>
            <div class="w-8 h-8 rounded-full bg-indigo-600 flex items-center justify-center shrink-0">
                <span class="text-white text-xs font-bold uppercase">{{ substr(auth()->user()->name, 0, 1) }}</span>
            </div>
        </div>

        {{-- Divider --}}
        <div class="hidden sm:block w-px h-5 bg-gray-200"></div>

        {{-- Logout --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="flex items-center gap-1.5 text-xs font-medium text-gray-500 hover:text-red-600 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                Keluar
            </button>
        </form>
    </div>

</header>
