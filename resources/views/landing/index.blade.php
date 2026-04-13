<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MahoraPOS — Modern POS for Your Business</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-slate-800 antialiased">

    {{-- Navbar --}}
    <nav class="fixed top-0 inset-x-0 z-50 bg-white/90 backdrop-blur-md border-b border-slate-100">
        <div class="max-w-6xl mx-auto px-6 h-16 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <div class="w-7 h-7 rounded-lg bg-indigo-600 flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <span class="font-bold text-slate-900 text-lg">MahoraPOS</span>
            </div>
            <div class="hidden md:flex items-center gap-8 text-sm font-medium text-slate-500">
                <a href="#features" class="hover:text-indigo-600 transition-colors">Features</a>
                <a href="#pricing"  class="hover:text-indigo-600 transition-colors">Pricing</a>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('login') }}"
                   class="text-sm font-medium text-slate-600 hover:text-indigo-600 px-3 py-2 transition-colors">
                    Login
                </a>
                <a href="{{ route('register') }}"
                   class="text-sm font-semibold px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors shadow-sm">
                    Get Started
                </a>
            </div>
        </div>
    </nav>

    {{-- Hero --}}
    <section class="pt-32 pb-28 px-6 relative overflow-hidden">
        {{-- Background decoration --}}
        <div class="absolute inset-0 bg-gradient-to-br from-indigo-50 via-white to-violet-50 -z-10"></div>
        <div class="absolute top-20 left-1/2 -translate-x-1/2 w-[600px] h-[600px] bg-indigo-100/40 rounded-full blur-3xl -z-10"></div>

        <div class="max-w-3xl mx-auto text-center">
            <div class="inline-flex items-center gap-2 text-xs font-semibold tracking-widest text-indigo-600 uppercase bg-indigo-50 border border-indigo-100 px-4 py-1.5 rounded-full mb-6">
                <span class="w-1.5 h-1.5 rounded-full bg-indigo-500 animate-pulse"></span>
                Point of Sale System
            </div>
            <h1 class="text-5xl sm:text-6xl font-extrabold text-slate-900 leading-[1.1] tracking-tight mb-6">
                The Modern POS<br>
                <span class="text-indigo-600">for Your Business</span>
            </h1>
            <p class="text-lg text-slate-500 mb-10 max-w-xl mx-auto leading-relaxed">
                MahoraPOS helps cafes, shops, and restaurants manage sales, inventory, and staff — all in one clean, fast dashboard.
            </p>
            <div class="flex justify-center gap-3 flex-wrap">
                <a href="{{ route('register') }}"
                   class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 text-white font-semibold rounded-xl hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-200 hover:shadow-indigo-300 hover:-translate-y-0.5">
                    Start Free Trial
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
                <a href="{{ route('login') }}"
                   class="inline-flex items-center gap-2 px-6 py-3 border border-slate-200 text-slate-700 font-semibold rounded-xl hover:bg-slate-50 hover:border-slate-300 transition-all">
                    Login to Dashboard
                </a>
            </div>

            {{-- Social proof --}}
            <p class="text-xs text-slate-400 mt-8">No credit card required · Free 30-day trial · Cancel anytime</p>
        </div>
    </section>

    {{-- Features --}}
    <section class="py-24 px-6 bg-white" id="features">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-slate-900 mb-3">Everything you need to run your business</h2>
                <p class="text-slate-500 max-w-lg mx-auto">Simple, powerful tools built for small businesses. No complexity, just results.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
                @foreach([
                    ['bg-indigo-50', 'text-indigo-600', 'M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z', 'Fast POS', 'Process transactions in seconds with a clean, intuitive cashier interface.'],
                    ['bg-violet-50', 'text-violet-600', 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4', 'Inventory', 'Track stock levels in real-time and get instant low-stock alerts.'],
                    ['bg-sky-50',    'text-sky-600',    'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z', 'Reports', 'View daily sales, revenue trends, and cashier performance at a glance.'],
                    ['bg-emerald-50','text-emerald-600','M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z', 'Team Roles', 'Add cashiers and staff with role-based access. Everyone sees only what they need.'],
                ] as [$bg, $tc, $path, $title, $desc])
                <div class="group p-6 rounded-2xl border border-slate-100 hover:border-indigo-200 hover:shadow-lg hover:shadow-indigo-50 transition-all duration-200 hover:-translate-y-1">
                    <div class="w-10 h-10 rounded-xl {{ $bg }} flex items-center justify-center mb-4">
                        <svg class="w-5 h-5 {{ $tc }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $path }}"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-slate-900 mb-2">{{ $title }}</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">{{ $desc }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Pricing --}}
    <section class="py-24 px-6 bg-slate-50" id="pricing">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-slate-900 mb-3">Simple, transparent pricing</h2>
                <p class="text-slate-500">No hidden fees. No surprises. Cancel anytime.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">
                @foreach([
                    ['Starter', 'Free', 'forever', ['1 cashier account', 'Basic POS', 'Up to 50 products', 'Email support'], false],
                    ['Pro',     'RM 49', '/month',  ['Unlimited cashiers', 'Full reports & analytics', 'Inventory management', 'Priority support'], true],
                    ['Business','RM 99', '/month',  ['Everything in Pro', 'Multi-branch support', 'API access', 'Dedicated support'], false],
                ] as [$plan, $price, $period, $feats, $popular])
                <div class="relative bg-white rounded-2xl border {{ $popular ? 'border-indigo-500 shadow-xl shadow-indigo-100/50' : 'border-slate-200' }} p-6">
                    @if($popular)
                    <div class="absolute -top-3.5 left-1/2 -translate-x-1/2">
                        <span class="text-xs font-bold bg-indigo-600 text-white px-3 py-1 rounded-full shadow-sm">
                            Most Popular
                        </span>
                    </div>
                    @endif
                    <div class="mb-5">
                        <h3 class="font-bold text-slate-900 text-base mb-3">{{ $plan }}</h3>
                        <div class="flex items-end gap-1">
                            <span class="text-4xl font-extrabold text-slate-900">{{ $price }}</span>
                            <span class="text-slate-400 text-sm mb-1">{{ $period }}</span>
                        </div>
                    </div>
                    <ul class="space-y-2.5 mb-6">
                        @foreach($feats as $feat)
                        <li class="flex items-center gap-2 text-sm text-slate-600">
                            <svg class="w-4 h-4 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ $feat }}
                        </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('register') }}"
                       class="block text-center py-2.5 rounded-xl text-sm font-semibold transition-all
                              {{ $popular
                                  ? 'bg-indigo-600 text-white hover:bg-indigo-700 shadow-sm'
                                  : 'border border-slate-200 text-slate-700 hover:bg-slate-50 hover:border-slate-300' }}">
                        Get Started
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="py-12 px-6 bg-white border-t border-slate-100">
        <div class="max-w-6xl mx-auto">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="flex items-center gap-2.5">
                    <div class="w-6 h-6 rounded-md bg-indigo-600 flex items-center justify-center">
                        <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <span class="font-bold text-slate-900">MahoraPOS</span>
                </div>
                <p class="text-sm text-slate-400">© {{ date('Y') }} MahoraPOS. All rights reserved.</p>
                <div class="flex gap-6 text-sm text-slate-400">
                    <a href="#features" class="hover:text-indigo-600 transition-colors">Features</a>
                    <a href="#pricing"  class="hover:text-indigo-600 transition-colors">Pricing</a>
                    <a href="{{ route('login') }}" class="hover:text-indigo-600 transition-colors">Login</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
