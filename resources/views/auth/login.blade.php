<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — MahoraPOS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-full bg-slate-50 antialiased">

    <div class="min-h-screen flex">

        {{-- Left branding panel (hidden on mobile) --}}
        <div class="hidden lg:flex lg:w-1/2 bg-slate-900 flex-col justify-between p-12 relative overflow-hidden">
            {{-- Background decoration --}}
            <div class="absolute top-0 right-0 w-96 h-96 bg-indigo-600/20 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-violet-600/20 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2"></div>

            {{-- Logo --}}
            <div class="flex items-center gap-3 relative z-10">
                <div class="w-9 h-9 rounded-xl bg-indigo-500 flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <span class="text-white font-bold text-xl">MahoraPOS</span>
            </div>

            {{-- Center content --}}
            <div class="relative z-10">
                <h2 class="text-3xl font-bold text-white mb-4 leading-snug">
                    Manage your business<br>with confidence
                </h2>
                <p class="text-slate-400 text-sm leading-relaxed mb-8">
                    A complete POS solution for cafes, shops, and restaurants. Fast, simple, and built for your team.
                </p>
                <div class="space-y-3">
                    @foreach(['Role-based access control', 'Multi-tenant shop isolation', 'Real-time inventory tracking'] as $feat)
                    <div class="flex items-center gap-3">
                        <div class="w-5 h-5 rounded-full bg-indigo-500/20 flex items-center justify-center shrink-0">
                            <svg class="w-3 h-3 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <span class="text-slate-300 text-sm">{{ $feat }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Footer --}}
            <p class="text-slate-600 text-xs relative z-10">© {{ date('Y') }} MahoraPOS</p>
        </div>

        {{-- Right form panel --}}
        <div class="flex-1 flex items-center justify-center px-6 py-12">
            <div class="w-full max-w-sm">

                {{-- Mobile logo --}}
                <div class="lg:hidden flex items-center gap-2 mb-8">
                    <div class="w-7 h-7 rounded-lg bg-indigo-600 flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <span class="font-bold text-slate-900">MahoraPOS</span>
                </div>

                <div class="mb-8">
                    <h1 class="text-2xl font-bold text-slate-900">Welcome back</h1>
                    <p class="text-slate-500 text-sm mt-1">Sign in to your account to continue</p>
                </div>

                @if($errors->any())
                <div class="mb-5 flex items-start gap-3 p-4 bg-red-50 border border-red-200 rounded-xl text-sm text-red-700">
                    <svg class="w-4 h-4 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ $errors->first() }}
                </div>
                @endif

                <form method="POST" action="/login" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Email address</label>
                        <input type="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-white text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-shadow"
                            placeholder="you@example.com">
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label class="block text-sm font-medium text-slate-700">Password</label>
                        </div>
                        <input type="password" name="password" required autocomplete="current-password"
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-white text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-shadow"
                            placeholder="••••••••">
                    </div>

                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="remember" id="remember"
                            class="w-4 h-4 text-indigo-600 rounded border-slate-300 focus:ring-indigo-500">
                        <label for="remember" class="text-sm text-slate-600">Remember me for 30 days</label>
                    </div>

                    <button type="submit"
                        class="w-full py-2.5 bg-indigo-600 text-white font-semibold rounded-xl hover:bg-indigo-700 active:bg-indigo-800 transition-colors text-sm shadow-sm shadow-indigo-200 mt-2">
                        Sign In
                    </button>
                </form>

                <p class="text-center text-sm text-slate-500 mt-6">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="text-indigo-600 font-semibold hover:underline">Create one free</a>
                </p>

                {{-- Demo credentials --}}
                <div class="mt-6 p-4 bg-slate-50 border border-slate-200 rounded-xl">
                    <p class="text-xs font-semibold text-slate-600 mb-2.5">Demo accounts (password: <code class="bg-slate-200 px-1 rounded">password</code>)</p>
                    <div class="space-y-1.5">
                        @foreach([
                            ['👑', 'Owner',   'owner@democafe.com'],
                            ['🛒', 'Cashier', 'cashier@democafe.com'],
                            ['📋', 'Staff',   'staff@democafe.com'],
                            ['🔧', 'Admin',   'admin@mahorapos.com'],
                        ] as [$icon, $role, $email])
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-slate-500">{{ $icon }} {{ $role }}</span>
                            <code class="text-slate-600 bg-white border border-slate-200 px-1.5 py-0.5 rounded">{{ $email }}</code>
                        </div>
                        @endforeach
                    </div>
                </div>

                <p class="text-center text-xs text-slate-400 mt-5">
                    <a href="/" class="hover:text-indigo-600 transition-colors">← Back to home</a>
                </p>
            </div>
        </div>
    </div>

</body>
</html>
