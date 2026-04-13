<x-layouts.app>
    <x-page-header title="Admin Dashboard" subtitle="System-wide overview" />

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

        <div class="bg-white rounded-2xl border border-slate-100 p-5 shadow-sm">
            <div class="w-9 h-9 rounded-xl bg-indigo-50 flex items-center justify-center mb-4">
                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </div>
            <p class="text-2xl font-bold text-slate-900">{{ $stats['shops'] }}</p>
            <p class="text-xs text-slate-400 mt-1">Total Shops</p>
        </div>

        <div class="bg-white rounded-2xl border border-slate-100 p-5 shadow-sm">
            <div class="w-9 h-9 rounded-xl bg-violet-50 flex items-center justify-center mb-4">
                <svg class="w-5 h-5 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
            <p class="text-2xl font-bold text-slate-900">{{ $stats['users'] }}</p>
            <p class="text-xs text-slate-400 mt-1">Total Users</p>
        </div>

        <div class="bg-white rounded-2xl border border-slate-100 p-5 shadow-sm">
            <div class="w-9 h-9 rounded-xl bg-emerald-50 flex items-center justify-center mb-4">
                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <p class="text-2xl font-bold text-emerald-600">{{ $stats['active'] }}</p>
            <p class="text-xs text-slate-400 mt-1">Active Shops</p>
        </div>

        <div class="bg-white rounded-2xl border border-slate-100 p-5 shadow-sm">
            <div class="w-9 h-9 rounded-xl bg-red-50 flex items-center justify-center mb-4">
                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                </svg>
            </div>
            <p class="text-2xl font-bold text-red-500">{{ $stats['suspended'] }}</p>
            <p class="text-xs text-slate-400 mt-1">Suspended Shops</p>
        </div>

    </div>

    <div class="bg-white rounded-2xl border border-slate-100 p-6 shadow-sm">
        <h2 class="text-sm font-semibold text-slate-700 mb-4">Quick Actions</h2>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('admin.shops') }}"
               class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                Manage Shops
            </a>
            <a href="{{ route('admin.subscriptions') }}"
               class="inline-flex items-center gap-2 px-4 py-2 bg-violet-600 text-white text-sm font-medium rounded-lg hover:bg-violet-700 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                </svg>
                Subscriptions
            </a>
        </div>
    </div>
</x-layouts.app>
