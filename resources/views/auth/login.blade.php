<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk — MahoraPOS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-white antialiased">

    <div class="min-h-screen grid lg:grid-cols-2">

        {{-- ===== KIRI — BRANDING ===== --}}
        <div class="hidden lg:flex flex-col justify-between bg-slate-950 p-12 relative overflow-hidden">

            {{-- Noise texture overlay --}}
            <div class="absolute inset-0 opacity-[0.03]"
                 style="background-image: url('data:image/svg+xml,%3Csvg viewBox=%220 0 256 256%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cfilter id=%22noise%22%3E%3CfeTurbulence type=%22fractalNoise%22 baseFrequency=%220.9%22 numOctaves=%224%22 stitchTiles=%22stitch%22/%3E%3C/filter%3E%3Crect width=%22100%25%22 height=%22100%25%22 filter=%22url(%23noise)%22/%3E%3C/svg%3E');"></div>

            {{-- Glow --}}
            <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-indigo-600/20 rounded-full blur-[120px] -translate-x-1/2 -translate-y-1/2 pointer-events-none"></div>
            <div class="absolute bottom-0 right-0 w-[400px] h-[400px] bg-violet-600/15 rounded-full blur-[100px] translate-x-1/3 translate-y-1/3 pointer-events-none"></div>

            {{-- Logo --}}
            <a href="/" class="relative z-10 flex items-center gap-2.5 w-fit">
                <div class="w-8 h-8 rounded-xl bg-indigo-500 flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <span class="text-white font-semibold text-sm tracking-tight">MahoraPOS</span>
            </a>

            {{-- Quote / Content --}}
            <div class="relative z-10 max-w-sm">
                <p class="text-xs font-semibold text-indigo-400 uppercase tracking-widest mb-5">Sistem Kasir Modern</p>
                <h2 class="text-3xl font-bold text-white leading-snug mb-6">
                    Kelola penjualan,<br>stok, dan tim Anda<br>dalam satu tempat.
                </h2>
                <div class="space-y-3.5">
                    @foreach([
                        ['Kasir cepat & mudah digunakan',       'M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z'],
                        ['Laporan penjualan real-time',          'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z'],
                        ['Kontrol akses berbasis peran',         'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z'],
                    ] as [$label, $icon])
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="{{ $icon }}"/>
                            </svg>
                        </div>
                        <span class="text-sm text-slate-300">{{ $label }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Footer --}}
            <p class="relative z-10 text-xs text-slate-600">© {{ date('Y') }} MahoraPOS</p>
        </div>

        {{-- ===== KANAN — FORM ===== --}}
        <div class="flex flex-col justify-center px-6 sm:px-12 lg:px-16 py-12 bg-white">

            <div class="w-full max-w-sm mx-auto">

                {{-- Mobile logo --}}
                <a href="/" class="lg:hidden flex items-center gap-2 mb-10">
                    <div class="w-8 h-8 rounded-xl bg-indigo-600 flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <span class="font-semibold text-slate-900 text-sm">MahoraPOS</span>
                </a>

                {{-- Heading --}}
                <div class="mb-8">
                    <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Selamat datang kembali</h1>
                    <p class="text-sm text-slate-500 mt-1.5">Masuk untuk melanjutkan ke dasbor Anda</p>
                </div>

                {{-- Error --}}
                @if($errors->any())
                <div class="mb-6 flex items-center gap-2.5 px-4 py-3 rounded-xl bg-red-50 border border-red-200 text-sm text-red-600">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ $errors->first() }}
                </div>
                @endif

                {{-- Form --}}
                <form method="POST" action="/login" class="space-y-5">
                    @csrf

                    <div class="space-y-1.5">
                        <label class="text-sm font-medium text-slate-700">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-900 placeholder-slate-400 bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
                            placeholder="anda@contoh.com">
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-sm font-medium text-slate-700">Kata Sandi</label>
                        <div class="relative">
                            <input id="password" type="password" name="password" required autocomplete="current-password"
                                class="w-full px-3.5 py-2.5 pr-10 rounded-xl border border-slate-200 text-sm text-slate-900 placeholder-slate-400 bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
                                placeholder="••••••••">
                            <button type="button" onclick="togglePassword('password', 'eye-login')"
                                class="absolute inset-y-0 right-0 flex items-center px-3 text-slate-400 hover:text-slate-600 transition-colors">
                                <svg id="eye-login" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2 cursor-pointer select-none">
                            <input type="checkbox" name="remember"
                                class="w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                            <span class="text-sm text-slate-500">Ingat saya</span>
                        </label>
                    </div>

                    <button type="submit"
                        class="w-full py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-xl transition-colors shadow-sm">
                        Masuk
                    </button>
                </form>

                <script>
                    function togglePassword(inputId, iconId) {
                        const input = document.getElementById(inputId);
                        const icon  = document.getElementById(iconId);
                        const show  = input.type === 'password';
                        input.type  = show ? 'text' : 'password';
                        icon.innerHTML = show
                            ? `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>`
                            : `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>`;
                    }
                </script>

                {{-- Divider --}}
                <div class="my-6 flex items-center gap-3">
                    <div class="flex-1 h-px bg-slate-100"></div>
                    <span class="text-xs text-slate-400">atau coba akun demo</span>
                    <div class="flex-1 h-px bg-slate-100"></div>
                </div>

                {{-- Demo accounts --}}
                <div class="grid grid-cols-2 gap-2">
                    @foreach([
                        ['Pemilik', 'owner@democafe.com',   'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'],
                        ['Kasir',   'cashier@democafe.com', 'M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z'],
                        ['Staf',    'staff@democafe.com',   'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'],
                        ['Admin',   'admin@mahorapos.com',  'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z'],
                    ] as [$role, $email, $path])
                    <button type="button"
                        onclick="document.querySelector('[name=email]').value='{{ $email }}'; document.querySelector('[name=password]').value='password';"
                        class="text-left px-3 py-2.5 rounded-xl border border-slate-200 hover:border-indigo-300 hover:bg-indigo-50/50 transition-all group flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-slate-100 group-hover:bg-indigo-100 flex items-center justify-center shrink-0 transition-colors">
                            <svg class="w-3.5 h-3.5 text-slate-400 group-hover:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="{{ $path }}"/>
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs font-semibold text-slate-700 group-hover:text-indigo-700 transition-colors">{{ $role }}</p>
                            <p class="text-xs text-slate-400 truncate">{{ $email }}</p>
                        </div>
                    </button>
                    @endforeach
                </div>
                <p class="text-xs text-slate-400 text-center mt-2">Klik kartu untuk mengisi otomatis · sandi: <code class="font-mono">password</code></p>

                {{-- Footer --}}
                <p class="text-center text-sm text-slate-500 mt-8">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-indigo-600 font-semibold hover:underline ml-1">Daftar gratis</a>
                </p>
                <p class="text-center text-xs text-slate-400 mt-3">
                    <a href="/" class="hover:text-slate-600 transition-colors">← Kembali ke beranda</a>
                </p>

            </div>
        </div>

    </div>

</body>
</html>
