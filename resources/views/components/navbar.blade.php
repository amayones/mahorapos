<header class="bg-white border-b border-slate-200 px-6 py-3.5 flex items-center justify-between shrink-0">

    {{-- Left: shop name --}}
    <div class="flex items-center gap-2">
        <div class="w-2 h-2 rounded-full bg-emerald-400"></div>
        <span class="text-sm font-medium text-slate-600">
            {{ auth()->user()->shop?->name ?? 'MahoraPOS System' }}
        </span>
    </div>

    {{-- Right: user + logout --}}
    <div class="flex items-center gap-4">
        <div class="flex items-center gap-2.5">
            <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center">
                <span class="text-indigo-600 text-xs font-bold uppercase">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </span>
            </div>
            <div class="hidden sm:block text-right">
                <p class="text-sm font-semibold text-slate-800 leading-none">{{ auth()->user()->name }}</p>
                <p class="text-xs text-slate-400 capitalize mt-0.5">{{ auth()->user()->role }}</p>
            </div>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="flex items-center gap-1.5 text-xs font-medium px-3 py-1.5 rounded-lg text-slate-500 hover:text-red-600 hover:bg-red-50 border border-slate-200 hover:border-red-200 transition-all">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                Logout
            </button>
        </form>
    </div>

</header>
