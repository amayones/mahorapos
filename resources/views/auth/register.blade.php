<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar — MahoraPOS</title>
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

            {{-- Content --}}
            <div class="relative z-10 max-w-sm">
                <p class="text-xs font-semibold text-indigo-400 uppercase tracking-widest mb-5">Mulai dalam 30 detik</p>
                <h2 class="text-3xl font-bold text-white leading-snug mb-6">
                    Bisnis lebih rapi,<br>penjualan lebih<br>terpantau.
                </h2>

                {{-- Pricing teaser --}}
                <div class="space-y-2.5">
                    @foreach([
                        ['Gratis 30 hari',          'Tanpa kartu kredit'],
                        ['Setup kurang dari 1 jam', 'Langsung bisa dipakai'],
                        ['Batalkan kapan saja',     'Tanpa biaya tersembunyi'],
                    ] as [$main, $sub])
                    <div class="flex items-start gap-3 p-3 rounded-xl bg-white/5 border border-white/10">
                        <svg class="w-4 h-4 text-indigo-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                        <div>
                            <p class="text-sm font-medium text-white">{{ $main }}</p>
                            <p class="text-xs text-slate-500 mt-0.5">{{ $sub }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Footer --}}
            <p class="relative z-10 text-xs text-slate-600">© {{ date('Y') }} MahoraPOS</p>
        </div>

        {{-- ===== KANAN — FORM ===== --}}
        <div class="flex flex-col justify-center px-6 sm:px-12 lg:px-16 py-12 bg-white overflow-y-auto">

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
                    <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Buat akun gratis</h1>
                    <p class="text-sm text-slate-500 mt-1.5">Siapkan toko dan mulai berjualan hari ini</p>
                </div>

                {{-- Error --}}
                @if($errors->any())
                <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200">
                    <ul class="space-y-1.5">
                        @foreach($errors->all() as $error)
                        <li class="flex items-center gap-2 text-sm text-red-600">
                            <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            {{ $error }}
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {{-- Form --}}
                <form method="POST" action="/register" class="space-y-4">
                    @csrf

                    <div class="grid grid-cols-2 gap-3">
                        <div class="space-y-1.5">
                            <label class="text-sm font-medium text-slate-700">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-900 placeholder-slate-400 bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
                                placeholder="Nama Anda">
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-sm font-medium text-slate-700">Nama Toko</label>
                            <input type="text" name="shop_name" value="{{ old('shop_name') }}" required
                                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-900 placeholder-slate-400 bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
                                placeholder="Nama Toko">
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-sm font-medium text-slate-700">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm text-slate-900 placeholder-slate-400 bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
                            placeholder="anda@contoh.com">
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div class="space-y-1.5">
                            <label class="text-sm font-medium text-slate-700">Kata Sandi</label>
                            <div class="relative">
                                <input id="password" type="password" name="password" required
                                    class="w-full px-3.5 py-2.5 pr-10 rounded-xl border border-slate-200 text-sm text-slate-900 placeholder-slate-400 bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
                                    placeholder="Min. 6 karakter">
                                <button type="button" onclick="togglePassword('password', 'eye-pass')"
                                    class="absolute inset-y-0 right-0 flex items-center px-3 text-slate-400 hover:text-slate-600 transition-colors">
                                    <svg id="eye-pass" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-sm font-medium text-slate-700">Konfirmasi</label>
                            <div class="relative">
                                <input id="password_confirmation" type="password" name="password_confirmation" required
                                    oninput="checkMatch()"
                                    class="w-full px-3.5 py-2.5 pr-10 rounded-xl border border-slate-200 text-sm text-slate-900 placeholder-slate-400 bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
                                    placeholder="Ulangi sandi">
                                <button type="button" onclick="togglePassword('password_confirmation', 'eye-confirm')"
                                    class="absolute inset-y-0 right-0 flex items-center px-3 text-slate-400 hover:text-slate-600 transition-colors">
                                    <svg id="eye-confirm" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                            </div>
                            <p id="match-msg" class="hidden text-xs font-medium"></p>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-xl transition-colors shadow-sm mt-1">
                        Buat Akun Gratis
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

                    function checkMatch() {
                        const pass    = document.getElementById('password').value;
                        const confirm = document.getElementById('password_confirmation').value;
                        const msg     = document.getElementById('match-msg');
                        if (!confirm) { msg.classList.add('hidden'); return; }
                        const matched = pass === confirm;
                        msg.classList.remove('hidden', 'text-emerald-600', 'text-red-500');
                        msg.classList.add(matched ? 'text-emerald-600' : 'text-red-500');
                        msg.textContent = matched ? '✓ Password cocok' : '✗ Password tidak cocok';
                    }
                </script>

                {{-- Footer --}}
                <p class="text-center text-sm text-slate-500 mt-8">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-indigo-600 font-semibold hover:underline ml-1">Masuk</a>
                </p>
                <p class="text-center text-xs text-slate-400 mt-3">
                    <a href="/" class="hover:text-slate-600 transition-colors">← Kembali ke beranda</a>
                </p>

            </div>
        </div>

    </div>

</body>
</html>
