<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kos Bu Linda - Hunian Nyaman & Premium</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>

<body class="antialiased bg-gray-50 text-slate-800">

    <!-- Navbar -->
    <nav class="fixed w-full z-50 bg-white/80 backdrop-blur-md border-b border-gray-100 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex-shrink-0 flex items-center gap-2">
                    <div
                        class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-indigo-200">
                        K</div>
                    <span class="font-bold text-2xl tracking-tight text-slate-900">Kos Bu Linda</span>
                </div>
                <div class="hidden md:flex space-x-8">
                    <a href="#home"
                        class="text-slate-600 hover:text-indigo-600 font-medium transition-colors">Beranda</a>
                    <a href="#kamar" class="text-slate-600 hover:text-indigo-600 font-medium transition-colors">Pilihan
                        Kamar</a>
                    <a href="#fasilitas"
                        class="text-slate-600 hover:text-indigo-600 font-medium transition-colors">Fasilitas</a>
                    <a href="#lokasi"
                        class="text-slate-600 hover:text-indigo-600 font-medium transition-colors">Lokasi</a>
                </div>
                <div class="flex items-center gap-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="font-medium text-slate-600 hover:text-indigo-600 transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}"
                                class="font-medium text-slate-600 hover:text-indigo-600 transition">Masuk</a>
                        @endauth
                    @endif

                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header id="home" class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div
                class="absolute top-0 right-0 -mr-64 -mt-64 w-[600px] h-[600px] bg-indigo-50 rounded-full blur-3xl opacity-60">
            </div>
            <div
                class="absolute bottom-0 left-0 -ml-64 -mb-64 w-[600px] h-[600px] bg-purple-50 rounded-full blur-3xl opacity-60">
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto">
                <span
                    class="inline-block py-1 px-3 rounded-full bg-indigo-50 text-indigo-600 text-sm font-semibold mb-6 tracking-wide uppercase">Hunian
                    Kost Premium</span>
                <h1 class="text-5xl md:text-7xl font-extrabold text-slate-900 tracking-tight leading-tight mb-8">
                    Temukan Kenyamanan <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">Seperti
                        di Rumah</span>
                </h1>
                <p class="text-lg md:text-xl text-slate-600 mb-10 leading-relaxed">
                    Kos Bu Linda menawarkan hunian kost eksklusif dengan fasilitas lengkap, lingkungan aman, dan lokasi
                    strategis untuk mendukung produktivitas Anda.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#kamar"
                        class="bg-indigo-600 text-white px-8 py-4 rounded-full font-semibold text-lg shadow-xl shadow-indigo-200 hover:bg-indigo-700 hover:shadow-indigo-300 transition-all transform hover:-translate-y-1">
                        Lihat Kamar
                    </a>
                    <a href="#fasilitas"
                        class="bg-white text-slate-700 border border-slate-200 px-8 py-4 rounded-full font-semibold text-lg hover:border-indigo-600 hover:text-indigo-600 transition-all">
                        Pelajari Fasilitas
                    </a>
                </div>
            </div>

            <!-- Hero Image/Stats -->
            <div class="mt-20 relative">
                <div
                    class="bg-white rounded-3xl shadow-2xl p-4 md:p-6 grid grid-cols-2 md:grid-cols-4 gap-6 divide-x divide-gray-100 max-w-5xl mx-auto border border-gray-100">
                    @forelse($landingInfos as $info)
                        <div class="text-center p-4">
                            <div class="text-3xl font-bold text-indigo-600 mb-1">{{ $info->value }}</div>
                            <div class="text-sm text-slate-500 font-medium">{{ $info->text }}</div>
                        </div>
                    @empty
                        <!-- Fallback if no data -->
                        <div class="text-center p-4">
                            <div class="text-3xl font-bold text-indigo-600 mb-1">20+</div>
                            <div class="text-sm text-slate-500 font-medium">Kamar Eksklusif</div>
                        </div>
                        <div class="text-center p-4">
                            <div class="text-3xl font-bold text-indigo-600 mb-1">24/7</div>
                            <div class="text-sm text-slate-500 font-medium">Keamanan & CCTV</div>
                        </div>
                        <div class="text-center p-4">
                            <div class="text-3xl font-bold text-indigo-600 mb-1">Full</div>
                            <div class="text-sm text-slate-500 font-medium">Fasilitas Lengkap</div>
                        </div>
                        <div class="text-center p-4">
                            <div class="text-3xl font-bold text-indigo-600 mb-1">100%</div>
                            <div class="text-sm text-slate-500 font-medium">Bebas Banjir</div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </header>

    <!-- Rooms Section -->
    <section id="kamar" class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">Pilihan Kamar Terbaik</h2>
                <div class="w-24 h-1.5 bg-indigo-600 mx-auto rounded-full"></div>
                <p class="mt-4 text-slate-600 max-w-2xl mx-auto">Pilih tipe kamar yang sesuai dengan kebutuhan dan
                    budget Anda. Semua kamar didesain untuk kenyamanan maksimal.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach($rooms as $room)
                    <div
                        class="group bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-2xl hover:border-indigo-100 transition-all duration-300 transform hover:-translate-y-2 flex flex-col h-full">
                        <div class="relative h-64 overflow-hidden">
                            @php
                                $primaryImage = $room->images->where('is_primary', true)->first() ?? $room->images->first();
                                if ($primaryImage) {
                                    if (Str::startsWith($primaryImage->image_path, 'storage/')) {
                                        $imageSrc = asset($primaryImage->image_path);
                                    } else {
                                        $imageSrc = asset('storage/' . $primaryImage->image_path);
                                    }
                                } else {
                                    $imageSrc = 'https://placehold.co/600x400?text=No+Image';
                                }
                            @endphp
                            <img src="{{ $imageSrc }}" alt="{{ $room->name }}"
                                onerror="this.src='https://placehold.co/600x400?text=Error+Loading+Image'"
                                class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                            <div
                                class="absolute top-4 right-4 px-4 py-1.5 rounded-full font-bold text-sm shadow-sm {{ $room->status == 'available' ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
                                {{ $room->status == 'available' ? 'Masih Kosong!' : 'Sudah Penuh' }}
                            </div>
                            <div
                                class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-6 pt-20">
                                <h3 class="text-white text-xl font-bold">{{ $room->name }}</h3>
                            </div>
                        </div>

                        <div class="p-8 flex-grow flex flex-col">
                            <div class="flex items-baseline mb-4">
                                <span class="text-2xl font-bold text-indigo-600">Rp
                                    {{ number_format($room->price, 0, ',', '.') }}</span>
                                <span class="text-slate-500 ml-1">/bulan</span>
                            </div>

                            <p class="text-slate-600 mb-6 line-clamp-3 text-sm leading-relaxed flex-grow">
                                {{ $room->description }}
                            </p>

                            <div class="flex flex-wrap gap-2 mb-8">
                                <!-- Simple tags for key facilities (first 3 usually) -->
                                @foreach(explode(',', $room->facilities) as $facility)
                                    @if($loop->iteration <= 3)
                                        <span
                                            class="px-3 py-1 bg-indigo-50 text-indigo-600 text-xs font-semibold rounded-lg">{{ trim($facility) }}</span>
                                    @endif
                                @endforeach
                                @if(count(explode(',', $room->facilities)) > 3)
                                    <span
                                        class="px-3 py-1 bg-gray-50 text-gray-500 text-xs font-semibold rounded-lg">+{{ count(explode(',', $room->facilities)) - 3 }}
                                        Lainnya</span>
                                @endif
                            </div>

                            <a href="{{ route('rooms.show', $room) }}"
                                class="block w-full text-center bg-slate-900 text-white py-3.5 rounded-xl font-semibold hover:bg-slate-800 transition-colors shadow-lg shadow-slate-200">
                                Lihat Detail Kamar
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($rooms->isEmpty())
                <div class="text-center py-12">
                    <p class="text-slate-500">Belum ada kamar yang tersedia saat ini.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-900 text-white py-12 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div>
                    <h3 class="text-2xl font-bold mb-4">Kos Bu Linda</h3>
                    <p class="text-slate-400 leading-relaxed">Hunian kost premium dengan standar kenyamanan tinggi.
                        Solusi tempat tinggal terbaik untuk Anda.</p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4 text-indigo-400">Hubungi Kami</h4>
                    <p class="text-slate-400 mb-2">WhatsApp: +62 812-3456-7890</p>
                    <p class="text-slate-400">Email: info@kosbulinda.com</p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4 text-indigo-400">Alamat</h4>
                    <p class="text-slate-400 leading-relaxed">Jl. Merpati Indah No. 45, Komplek Green Garden<br>Jakarta
                        Selatan, 12345</p>
                </div>
            </div>
            <div class="border-t border-slate-800 mt-12 pt-8 text-center text-slate-500 text-sm">
                &copy; {{ date('Y') }} Kos Bu Linda. All rights reserved.
            </div>
        </div>
    </footer>
</body>

</html>