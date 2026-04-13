<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar — MahoraPOS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-full bg-slate-50 antialiased">

    <div class="min-h-screen flex">

        {{-- Left branding panel --}}
        <div class="hidden lg:flex lg:w-1/2 bg-slate-900 flex-col justify-between p-12 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-96 h-96 bg-indigo-600/20 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-violet-600/20 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2"></div>

            <div class="flex items-center gap-3 relative z-10">
                <div class="w-9 h-9 rounded-xl bg-indigo-500 flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <span class="text-white font-bold text-xl">MahoraPOS</span>
            </div>

            <div class="relative z-10">
                <h2 class="text-3xl font-bold text-white mb-4 leading-snug">
                    Mulai uji coba gratis<br>dalam 30 detik
                </h2>
                <p class="text-slate-400 text-sm leading-relaxed mb-8">
                    Buat akun toko Anda dan dapatkan akses langsung ke sistem POS lengkap. Tanpa kartu kredit.
                </p>
                <div class="space-y-3">
                    @foreach(['Uji coba gratis 30 hari', 'Tanpa kartu kredit', 'Batalkan kapan saja'] as $feat)
                    <div class="flex items-center gap-3">
                        <div class="w-5 h-5 rounded-full bg-emerald-500/20 flex items-center justify-center shrink-0">
                            <svg class="w-3 h-3 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <span class="text-slate-300 text-sm">{{ $feat }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

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
                    <h1 class="text-2xl font-bold text-slate-900">Buat akun Anda</h1>
                    <p class="text-slate-500 text-sm mt-1">Siapkan toko Anda dan mulai berjualan hari ini</p>
                </div>

                @if($errors->any())
                <div class="mb-5 p-4 bg-red-50 border border-red-200 rounded-xl text-sm text-red-700">
                    <ul class="space-y-1">
                        @foreach($errors->all() as $error)
                            <li class="flex items-start gap-2">
                                <span class="mt-0.5">•</span> {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form method="POST" action="/register" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Nama Anda</label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-white text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                            placeholder="Nama Lengkap">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Nama Toko</label>
                        <input type="text" name="shop_name" value="{{ old('shop_name') }}" required
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-white text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                            placeholder="Kafe Saya">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Alamat Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-white text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                            placeholder="you@example.com">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Kata Sandi</label>
                        <input type="password" name="password" required
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-white text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                            placeholder="Min. 6 karakter">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Konfirmasi Kata Sandi</label>
                        <input type="password" name="password_confirmation" required
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 bg-white text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                            placeholder="Ulangi kata sandi">
                    </div>

                    <button type="submit"
                        class="w-full py-2.5 bg-indigo-600 text-white font-semibold rounded-xl hover:bg-indigo-700 active:bg-indigo-800 transition-colors text-sm shadow-sm shadow-indigo-200 mt-2">
                        Buat Akun
                    </button>
                </form>

                <p class="text-center text-sm text-slate-500 mt-6">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-indigo-600 font-semibold hover:underline">Masuk</a>
                </p>

                <p class="text-center text-xs text-slate-400 mt-4">
                    <a href="/" class="hover:text-indigo-600 transition-colors">← Kembali ke beranda</a>
                </p>
            </div>
        </div>
    </div>

</body>
</html>
