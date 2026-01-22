<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $room->name }} - Kos Bu Linda</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Outfit', sans-serif; }
        
        .fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
            opacity: 0;
            transform: translateY(20px);
        }
        
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body class="antialiased bg-gray-50 text-slate-800">
    
    <!-- Navbar -->
    <nav class="fixed w-full z-50 bg-white/90 backdrop-blur-md border-b border-gray-200 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 bg-indigo-50 rounded-xl flex items-center justify-center text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-300 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </div>
                    <span class="font-bold text-slate-900 group-hover:text-indigo-600 transition-colors">Kembali ke Beranda</span>
                </a>
                <div class="font-bold text-xl tracking-tight text-slate-900 hidden sm:block">Kos Bu Linda</div>
            </div>
        </div>
    </nav>

    <main class="pt-32 pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Left Column: Images & Info -->
                <div class="lg:col-span-2 space-y-10">
                    
                    <!-- Image Gallery -->
                    <div class="space-y-4 fade-in-up">
                        <div class="aspect-w-16 aspect-h-9 rounded-3xl overflow-hidden shadow-2xl bg-gray-200 relative group">
                             @if($room->images->count() > 0)
                                <img src="{{ asset($room->images->first()->image_path) }}" alt="{{ $room->name }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                             @else
                                <div class="w-full h-full bg-gradient-to-br from-indigo-100 to-purple-100 flex items-center justify-center text-indigo-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                             @endif
                        </div>
                        
                        <!-- Thumbnail Grid (Only if more than 1 image) -->
                        @if($room->images->count() > 1)
                        <div class="grid grid-cols-4 gap-4">
                            @foreach($room->images->skip(1)->take(4) as $image)
                            <div class="aspect-w-1 aspect-h-1 rounded-xl overflow-hidden cursor-pointer hover:opacity-80 transition bg-gray-100 border border-gray-100">
                                <img src="{{ asset($image->image_path) }}" class="w-full h-full object-cover">
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>

                    <!-- Room Info -->
                    <div class="fade-in-up delay-100">
                        <div class="flex flex-wrap items-center gap-3 mb-6">
                            <span class="bg-indigo-50 border border-indigo-100 text-indigo-700 px-4 py-1.5 rounded-full text-sm font-semibold tracking-wide uppercase flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                {{ $room->location }}
                            </span>
                            
                            @if($room->status === 'available')
                                <span class="bg-emerald-50 border border-emerald-100 text-emerald-700 px-4 py-1.5 rounded-full text-sm font-semibold tracking-wide uppercase flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                    Tersedia
                                </span>
                            @else
                                <span class="bg-red-50 border border-red-100 text-red-700 px-4 py-1.5 rounded-full text-sm font-semibold tracking-wide uppercase flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-red-500"></span>
                                    Penuh
                                </span>
                            @endif
                        </div>
                        
                        <h1 class="text-4xl md:text-5xl font-bold text-slate-900 mb-8 leading-tight">{{ $room->name }}</h1>
                        
                        <div class="prose prose-lg text-slate-600 max-w-none fade-in-up delay-200">
                            <h3 class="text-xl font-bold text-slate-900 mb-4 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 011.414.586l4 4a1 1 0 01.586 1.414V19a2 2 0 01-2 2z" />
                                </svg>
                                Deskripsi
                            </h3>
                            <p class="leading-relaxed bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">{{ $room->description }}</p>
                        </div>
                    </div>

                    <!-- Facilities -->
                    <div class="bg-white rounded-[2rem] p-8 border border-gray-100 shadow-lg fade-in-up delay-300 relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-50 rounded-full mix-blend-multiply filter blur-3xl opacity-50 -mr-16 -mt-16"></div>
                        
                        <h3 class="text-xl font-bold text-slate-900 mb-8 flex items-center gap-2 relative z-10">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                            </svg>
                            Fasilitas Unggulan
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 relative z-10">
                            @foreach(explode(',', $room->facilities) as $facility)
                            <div class="group flex items-center gap-4 p-4 rounded-2xl bg-gray-50 hover:bg-indigo-50 border border-gray-100 hover:border-indigo-100 transition-all duration-300">
                                <div class="w-10 h-10 rounded-full bg-white text-indigo-600 flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <span class="font-medium text-slate-700 group-hover:text-indigo-900">{{ trim($facility) }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>

                <!-- Right Column: Booking Card (Sticky) -->
                <div class="lg:col-span-1">
                    <div class="sticky top-32 space-y-6 fade-in-up delay-200">
                        <div class="bg-white rounded-[2.5rem] p-8 shadow-2xl border border-gray-100 relative overflow-hidden">
                            <!-- Premium decorative bg -->
                            <div class="absolute top-0 right-0 w-40 h-40 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-bl-[100%] -mr-10 -mt-10 opacity-10"></div>
                            
                            <div class="relative z-10">
                                <p class="text-slate-500 font-medium mb-2 uppercase text-xs tracking-wider">Harga Sewa</p>
                                <div class="flex items-baseline mb-8">
                                    <span class="text-5xl font-extrabold text-slate-900 tracking-tight">
                                        Rp {{ number_format($room->price, 0, ',', '.') }}
                                    </span>
                                    <span class="text-slate-500 ml-2 font-medium">/bulan</span>
                                </div>

                                <div class="space-y-4">
                                    <!-- WhatsApp Button -->
                                    <a href="https://wa.me/6281234567890?text=Halo%2C%20saya%20tertarik%20dengan%20{{ urlencode($room->name) }}%20yang%20ada%20di%20website%20Kos%20Bu%20Linda." target="_blank" class="block w-full group relative overflow-hidden rounded-2xl bg-slate-900 text-white shadow-xl transition-all duration-300 hover:shadow-2xl hover:scale-[1.02]">
                                        <div class="absolute inset-0 bg-gradient-to-r from-indigo-600 to-purple-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                        <div class="relative flex items-center justify-center gap-3 py-4 font-bold text-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.664-.698c.969.499 1.936.736 2.796.736 3.19 0 5.775-2.586 5.775-5.766 0-3.18-2.587-5.767-5.775-5.767zm-9.031 5.767c0-5.28 4.053-9.567 9.031-9.567 5.28 0 9.569 4.287 9.569 9.567 0 5.279-4.288 9.566-9.569 9.566-1.503 0-2.825-.333-3.876-.877l-5.155 1.349 1.373-5.018c-.808-1.129-1.373-2.613-1.373-4.453zm8.397 5.29c-.2-.1-1.186-.585-1.37-.652-.183-.067-.316-.1-.448.1-.133.2-.518.652-.634.785-.118.134-.234.151-.434.051-.2-.1-.844-.311-1.608-.992-.596-.531-.998-1.187-1.115-1.387-.117-.2-.012-.307.087-.406.09-.09.2-.234.301-.351.1-.117.133-.2.2-.334.067-.134.034-.251-.017-.351-.05-.1-.449-1.083-.615-1.483-.162-.39-.326-.337-.449-.344l-.382-.007c-.133 0-.35.051-.533.251-.183.2-1.018.636-1.018 1.485s1.049 2.023 1.199 2.224c.149.201 2.067 3.155 5.013 4.426.702.302 1.248.483 1.678.618 1.055.334 2.016.287 2.766.175.836-.124 1.719-.702 1.961-1.379.244-.676.244-1.256.171-1.379-.073-.122-.267-.196-.566-.346z"/>
                                            </svg>
                                            Pesan Sekarang
                                        </div>
                                    </a>
                                    
                                    <button class="w-full bg-white text-slate-700 border-2 border-slate-100 py-4 rounded-2xl font-bold text-lg hover:border-indigo-600 hover:text-indigo-600 transition-all duration-300">
                                        Hubungi Admin
                                    </button>
                                </div>
                                
                                <div class="mt-8 pt-8 border-t border-slate-100">
                                    <div class="flex items-center gap-3 text-sm text-slate-500 mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Bebas biaya pemeliharaan
                                    </div>
                                    <div class="flex items-center gap-3 text-sm text-slate-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Pembersihan kamar berkala
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            
        </div>
    </main>

    <footer class="bg-white border-t border-gray-100 py-12 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
             <div class="w-12 h-12 bg-indigo-600 rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-indigo-200 mx-auto mb-6">K</div>
            <p class="text-slate-500 mb-2">&copy; {{ date('Y') }} Kos Bu Linda.</p>
            <p class="text-slate-400 text-sm">Hunian Nyaman & Premium</p>
        </div>
    </footer>
</body>
</html>