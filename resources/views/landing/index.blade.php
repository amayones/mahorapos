<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MahoraPOS — Sistem Kasir Modern untuk Bisnis Anda</title>
    <meta name="description" content="MahoraPOS membantu kafe, toko, dan restoran mengelola penjualan, stok, dan tim dalam satu dasbor yang cepat dan mudah.">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-slate-800 antialiased">

    {{-- ===== NAVBAR ===== --}}
    <header class="fixed top-0 inset-x-0 z-50 bg-white/80 backdrop-blur-xl border-b border-slate-100/80">
        <div class="max-w-6xl mx-auto px-5 sm:px-8 h-16 flex items-center justify-between">

            {{-- Logo --}}
            <a href="/" class="flex items-center gap-2.5 shrink-0">
                <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-indigo-500 to-indigo-700 flex items-center justify-center shadow-sm shadow-indigo-200">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <span class="font-bold text-slate-900 text-base tracking-tight">MahoraPOS</span>
            </a>

            {{-- Nav links --}}
            <nav class="hidden md:flex items-center gap-1">
                <a href="#fitur"  class="text-sm font-medium text-slate-500 hover:text-slate-900 px-3 py-2 rounded-lg hover:bg-slate-50 transition-all">Fitur</a>
                <a href="#harga" class="text-sm font-medium text-slate-500 hover:text-slate-900 px-3 py-2 rounded-lg hover:bg-slate-50 transition-all">Harga</a>
            </nav>

            {{-- CTA --}}
            <div class="flex items-center gap-2">
                <a href="{{ route('login') }}"
                   class="hidden sm:inline-flex text-sm font-medium text-slate-600 hover:text-slate-900 px-3 py-2 rounded-lg hover:bg-slate-50 transition-all">
                    Masuk
                </a>
                <a href="{{ route('register') }}"
                   class="inline-flex items-center gap-1.5 text-sm font-semibold px-4 py-2 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 transition-all shadow-sm shadow-indigo-200">
                    Coba Gratis
                </a>
            </div>
        </div>
    </header>

    <main>

        {{-- ===== HERO ===== --}}
        <section class="relative pt-32 pb-24 px-5 sm:px-8 overflow-hidden">
            {{-- BG --}}
            <div class="absolute inset-0 -z-10">
                <div class="absolute inset-0 bg-[radial-gradient(ellipse_80%_50%_at_50%_-10%,rgba(99,102,241,0.12),transparent)]"></div>
                <div class="absolute inset-0 bg-[linear-gradient(to_bottom,white_0%,#f8f9ff_100%)]"></div>
            </div>

            <div class="max-w-4xl mx-auto text-center">
                {{-- Badge --}}
                <div class="inline-flex items-center gap-2 text-xs font-semibold text-indigo-600 bg-indigo-50 border border-indigo-100 px-3.5 py-1.5 rounded-full mb-8">
                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-500 animate-pulse"></span>
                    Sistem Point of Sale #1 untuk UMKM
                </div>

                {{-- Headline --}}
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-slate-900 leading-[1.1] tracking-tight mb-6">
                    Kelola Bisnis Anda<br>
                    <span class="bg-gradient-to-r from-indigo-600 to-violet-600 bg-clip-text text-transparent">
                        Lebih Cepat & Mudah
                    </span>
                </h1>

                <p class="text-base sm:text-lg text-slate-500 mb-10 max-w-2xl mx-auto leading-relaxed">
                    MahoraPOS adalah sistem kasir modern untuk kafe, toko, dan restoran.
                    Kelola penjualan, stok, dan tim Anda — semua dalam satu tempat.
                </p>

                {{-- CTA Buttons --}}
                <div class="flex flex-col sm:flex-row justify-center gap-3 mb-10">
                    <a href="{{ route('register') }}"
                       class="inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-indigo-600 text-white font-semibold rounded-xl hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-200/60 hover:-translate-y-0.5 text-sm">
                        Mulai Gratis Sekarang
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                    <a href="{{ route('login') }}"
                       class="inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-white border border-slate-200 text-slate-700 font-semibold rounded-xl hover:border-slate-300 hover:bg-slate-50 transition-all text-sm shadow-sm">
                        Masuk ke Dasbor
                    </a>
                </div>

                {{-- Trust badges --}}
                <div class="flex flex-wrap justify-center items-center gap-x-6 gap-y-2 text-xs text-slate-400">
                    @foreach(['✓ Gratis 30 hari', '✓ Tanpa kartu kredit', '✓ Batalkan kapan saja'] as $t)
                    <span>{{ $t }}</span>
                    @endforeach
                </div>
            </div>

            {{-- Dashboard mockup --}}
            <div class="max-w-5xl mx-auto mt-16 px-2 sm:px-0">
                <div class="relative rounded-2xl overflow-hidden border border-slate-200/80 shadow-2xl shadow-slate-200/60">
                    {{-- Fake browser bar --}}
                    <div class="bg-slate-100 border-b border-slate-200 px-4 py-3 flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-red-400"></span>
                        <span class="w-3 h-3 rounded-full bg-amber-400"></span>
                        <span class="w-3 h-3 rounded-full bg-emerald-400"></span>
                        <div class="flex-1 mx-4 bg-white rounded-md px-3 py-1 text-xs text-slate-400 border border-slate-200">
                            app.mahorapos.com/dashboard
                        </div>
                    </div>
                    {{-- Dashboard preview --}}
                    <div class="bg-slate-50 p-4 sm:p-6">
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-4">
                            @foreach([
                                ['Produk', '48', 'text-indigo-600', 'bg-indigo-50'],
                                ['Tim', '6', 'text-violet-600', 'bg-violet-50'],
                                ['Transaksi', '312', 'text-sky-600', 'bg-sky-50'],
                                ['Pendapatan', 'Rp 4,2jt', 'text-emerald-600', 'bg-emerald-50'],
                            ] as [$label, $val, $tc, $bg])
                            <div class="bg-white rounded-xl border border-slate-100 p-3 sm:p-4 shadow-sm">
                                <div class="w-7 h-7 rounded-lg {{ $bg }} mb-2.5"></div>
                                <p class="text-lg sm:text-xl font-bold text-slate-900">{{ $val }}</p>
                                <p class="text-xs text-slate-400 mt-0.5">{{ $label }}</p>
                            </div>
                            @endforeach
                        </div>
                        <div class="bg-white rounded-xl border border-slate-100 p-4 shadow-sm">
                            <div class="flex items-center justify-between mb-3">
                                <p class="text-xs font-semibold text-slate-600">Transaksi Terbaru</p>
                                <span class="text-xs text-indigo-500 font-medium">Lihat semua</span>
                            </div>
                            <div class="space-y-2">
                                @foreach([
                                    ['Kopi Susu', 'Rp 25.000', '10:32'],
                                    ['Nasi Goreng', 'Rp 35.000', '10:18'],
                                    ['Es Teh Manis', 'Rp 8.000', '09:55'],
                                ] as [$item, $price, $time])
                                <div class="flex items-center justify-between py-1.5 border-b border-slate-50 last:border-0">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-6 h-6 rounded-lg bg-indigo-50 flex items-center justify-center shrink-0">
                                            <svg class="w-3 h-3 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4"/>
                                            </svg>
                                        </div>
                                        <span class="text-xs font-medium text-slate-700">{{ $item }}</span>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-xs font-semibold text-emerald-600">{{ $price }}</p>
                                        <p class="text-xs text-slate-400">{{ $time }}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ===== LOGO STRIP ===== --}}
        <section class="py-10 px-5 sm:px-8 border-y border-slate-100 bg-white">
            <div class="max-w-4xl mx-auto text-center">
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-widest mb-6">Dipercaya oleh berbagai jenis usaha</p>
                <div class="flex flex-wrap justify-center items-center gap-6 sm:gap-10">
                    @foreach(['Kafe & Kedai', 'Toko Retail', 'Restoran', 'Warung Makan', 'Minimarket'] as $biz)
                    <span class="text-sm font-semibold text-slate-300">{{ $biz }}</span>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- ===== FITUR ===== --}}
        <section class="py-24 px-5 sm:px-8 bg-white" id="fitur">
            <div class="max-w-6xl mx-auto">

                {{-- Section header --}}
                <div class="max-w-xl mb-16">
                    <p class="text-xs font-bold text-indigo-600 uppercase tracking-widest mb-3">Fitur Unggulan</p>
                    <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 leading-tight mb-4">
                        Semua yang Anda butuhkan, dalam satu sistem
                    </h2>
                    <p class="text-slate-500 leading-relaxed">
                        Dirancang khusus untuk UMKM Indonesia. Mudah digunakan, tanpa perlu pelatihan panjang.
                    </p>
                </div>

                {{-- Feature grid --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                    @foreach([
                        [
                            'M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z',
                            'Kasir Cepat',
                            'Proses transaksi dalam hitungan detik. Antarmuka kasir yang bersih dan intuitif, cocok untuk jam sibuk.'
                        ],
                        [
                            'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4',
                            'Manajemen Stok',
                            'Pantau stok produk secara real-time. Dapatkan notifikasi otomatis saat stok hampir habis.'
                        ],
                        [
                            'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z',
                            'Laporan Penjualan',
                            'Lihat ringkasan penjualan harian, mingguan, dan bulanan. Analisis tren pendapatan bisnis Anda.'
                        ],
                        [
                            'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z',
                            'Manajemen Tim',
                            'Tambah kasir dan staf dengan akses berbasis peran. Setiap anggota hanya melihat yang mereka butuhkan.'
                        ],
                        [
                            'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
                            'Multi-Peran',
                            'Pemilik, kasir, dan staf memiliki tampilan berbeda. Keamanan data terjaga dengan kontrol akses penuh.'
                        ],
                        [
                            'M13 10V3L4 14h7v7l9-11h-7z',
                            'Performa Tinggi',
                            'Dibangun dengan teknologi modern. Cepat, ringan, dan bisa diakses dari perangkat apa pun.'
                        ],
                    ] as [$path, $title, $desc])
                    <div class="group p-6 rounded-2xl border border-slate-100 hover:border-indigo-100 hover:shadow-md hover:shadow-indigo-50/50 transition-all duration-200 bg-white">
                        <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center mb-5">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="{{ $path }}"/>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-slate-900 mb-2 text-base">{{ $title }}</h3>
                        <p class="text-sm text-slate-500 leading-relaxed">{{ $desc }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- ===== STATS ===== --}}
        <section class="py-20 px-5 sm:px-8 bg-slate-900">
            <div class="max-w-5xl mx-auto">
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 text-center">
                    @foreach([
                        ['500+', 'Bisnis Aktif'],
                        ['50rb+', 'Transaksi/Bulan'],
                        ['99.9%', 'Uptime'],
                        ['< 1 jam', 'Waktu Setup'],
                    ] as [$num, $label])
                    <div>
                        <p class="text-3xl sm:text-4xl font-extrabold text-white mb-1">{{ $num }}</p>
                        <p class="text-sm text-slate-400">{{ $label }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- ===== HARGA ===== --}}
        {{-- <section class="py-24 px-5 sm:px-8 bg-white" id="harga">
            <div class="max-w-5xl mx-auto">

                <div class="text-center mb-16">
                    <p class="text-xs font-bold text-indigo-600 uppercase tracking-widest mb-3">Harga</p>
                    <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 mb-4">Harga yang jujur dan transparan</h2>
                    <p class="text-slate-500 max-w-md mx-auto">Tanpa biaya tersembunyi. Pilih paket yang sesuai kebutuhan bisnis Anda.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-stretch">
                    @foreach([
                        [
                            'Pemula',
                            'Gratis',
                            'selamanya',
                            'Cocok untuk bisnis yang baru mulai.',
                            ['1 akun kasir', 'POS dasar', 'Hingga 50 produk', 'Dukungan email'],
                            false
                        ],
                        [
                            'Pro',
                            'Rp 49.000',
                            '/ bulan',
                            'Untuk bisnis yang sedang berkembang.',
                            ['Kasir tak terbatas', 'Laporan & analitik lengkap', 'Manajemen inventaris', 'Dukungan prioritas'],
                            true
                        ],
                        [
                            'Bisnis',
                            'Rp 99.000',
                            '/ bulan',
                            'Untuk bisnis dengan banyak cabang.',
                            ['Semua fitur Pro', 'Dukungan multi-cabang', 'Akses API', 'Manajer akun khusus'],
                            false
                        ],
                    ] as [$plan, $price, $period, $tagline, $feats, $popular])
                    <div class="relative flex flex-col rounded-2xl border p-7
                        {{ $popular
                            ? 'border-indigo-500 bg-indigo-600 shadow-2xl shadow-indigo-200/50 scale-[1.02]'
                            : 'border-slate-200 bg-white shadow-sm' }}">

                        @if($popular)
                        <div class="absolute -top-4 left-1/2 -translate-x-1/2">
                            <span class="text-xs font-bold bg-white text-indigo-600 px-4 py-1.5 rounded-full shadow-md border border-indigo-100">
                                Paling Populer
                            </span>
                        </div>
                        @endif

                        <div class="mb-6">
                            <h3 class="font-bold text-base mb-1 {{ $popular ? 'text-indigo-100' : 'text-slate-900' }}">{{ $plan }}</h3>
                            <p class="text-xs mb-5 {{ $popular ? 'text-indigo-300' : 'text-slate-400' }}">{{ $tagline }}</p>
                            <div class="flex items-end gap-1.5">
                                <span class="text-3xl font-extrabold {{ $popular ? 'text-white' : 'text-slate-900' }}">{{ $price }}</span>
                                <span class="text-sm mb-1 {{ $popular ? 'text-indigo-300' : 'text-slate-400' }}">{{ $period }}</span>
                            </div>
                        </div>

                        <ul class="space-y-3 mb-8 flex-1">
                            @foreach($feats as $feat)
                            <li class="flex items-center gap-2.5 text-sm {{ $popular ? 'text-indigo-100' : 'text-slate-600' }}">
                                <div class="w-4 h-4 rounded-full flex items-center justify-center shrink-0
                                    {{ $popular ? 'bg-indigo-500' : 'bg-emerald-100' }}">
                                    <svg class="w-2.5 h-2.5 {{ $popular ? 'text-white' : 'text-emerald-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                {{ $feat }}
                            </li>
                            @endforeach
                        </ul>

                        <a href="{{ route('register') }}"
                           class="block text-center py-3 rounded-xl text-sm font-semibold transition-all
                               {{ $popular
                                   ? 'bg-white text-indigo-600 hover:bg-indigo-50 shadow-sm'
                                   : 'bg-slate-900 text-white hover:bg-slate-800 shadow-sm' }}">
                            Mulai Sekarang
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </section> --}}

        {{-- ===== CTA BANNER ===== --}}
        <section class="py-20 px-5 sm:px-8 bg-gradient-to-br from-indigo-600 to-violet-700">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-3xl sm:text-4xl font-extrabold text-white mb-4 leading-tight">
                    Siap memulai bisnis yang lebih terorganisir?
                </h2>
                <p class="text-indigo-200 mb-8 text-base">
                    Bergabung dengan ratusan pemilik usaha yang sudah menggunakan MahoraPOS.
                </p>
                <a href="{{ route('register') }}"
                   class="inline-flex items-center gap-2 px-7 py-3.5 bg-white text-indigo-700 font-bold rounded-xl hover:bg-indigo-50 transition-all shadow-lg text-sm">
                    Daftar Gratis — Tanpa Kartu Kredit
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </section>

    </main>

    {{-- ===== FOOTER ===== --}}
    <footer class="bg-slate-900 py-12 px-5 sm:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">

                {{-- Brand --}}
                <div class="flex items-center gap-2.5">
                    <div class="w-7 h-7 rounded-lg bg-indigo-500 flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <span class="font-bold text-white">MahoraPOS</span>
                </div>

                <p class="text-sm text-slate-500">© {{ date('Y') }} MahoraPOS. Hak cipta dilindungi.</p>

                {{-- Links --}}
                <div class="flex gap-6 text-sm text-slate-500">
                    <a href="#fitur"  class="hover:text-white transition-colors">Fitur</a>
                    <a href="#harga"  class="hover:text-white transition-colors">Harga</a>
                    <a href="{{ route('login') }}" class="hover:text-white transition-colors">Masuk</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
