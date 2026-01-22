<x-app-layout>
    <x-slot name="header">
        Admin Dashboard
    </x-slot>

    <div class="space-y-8">

        <!-- Hero Welcome Section -->
        <div
            class="bg-indigo-600 rounded-3xl p-10 shadow-xl relative overflow-hidden text-center md:text-left flex flex-col md:flex-row items-center justify-between gap-6">
            <!-- Background decoration -->
            <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 bg-white opacity-10 rounded-full blur-2xl"></div>
            <div
                class="absolute bottom-0 left-0 -ml-16 -mb-16 w-48 h-48 bg-purple-500 opacity-20 rounded-full blur-2xl">
            </div>

            <div class="relative z-10 text-white">
                <h1 class="text-3xl md:text-4xl font-bold mb-3">
                    Halo, {{ Auth::user()->name }} 👋
                </h1>
                <p class="text-indigo-100 text-lg max-w-xl">
                    Pantau kondisi bisnis kost Anda hari ini.
                </p>
            </div>

            <div class="relative z-10 flex flex-wrap gap-3 justify-center md:justify-end">
                <a href="{{ route('home') }}" target="_blank"
                    class="px-6 py-3 bg-white text-indigo-700 font-semibold rounded-xl hover:bg-gray-100 transition shadow-lg flex items-center gap-2">
                    <span>Lihat Website</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                </a>
            </div>
        </div>

        @if($overdueBookings->count() > 0)
            <div class="bg-red-50 border-l-4 border-red-500 p-6 rounded-r-xl shadow-sm mb-6 animate-pulse">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-500 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <div>
                            <h3 class="text-red-800 font-bold text-lg">Perhatian: {{ $overdueBookings->count() }} Pembayaran Jatuh Tempo</h3>
                            <p class="text-red-600 text-sm mt-1">
                                Berikut pelanggan yang belum membayar tagihan lebih dari 5 hari:
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mt-4 overflow-x-auto">
                    <table class="w-full text-sm text-left text-red-700">
                        <thead class="text-xs uppercase bg-red-100/50">
                            <tr>
                                <th class="px-4 py-2">Pelanggan</th>
                                <th class="px-4 py-2">Kamar</th>
                                <th class="px-4 py-2">Tanggal Mulai</th>
                                <th class="px-4 py-2">Tagihan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($overdueBookings as $booking)
                                <tr class="border-b border-red-100">
                                    <td class="px-4 py-2 font-bold">{{ $booking->user->name }}</td>
                                    <td class="px-4 py-2">{{ $booking->room->name }}</td>
                                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($booking->start_date)->format('d M Y') }}</td>
                                    <td class="px-4 py-2">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        <!-- Dashboard Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Stat Card 1 -->
            <div
                class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 flex items-center gap-6 hover:shadow-md transition-shadow">
                <div class="w-16 h-16 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-4xl font-extrabold text-slate-800">{{ $totalRooms }}</h3>
                    <p class="text-slate-500 font-medium text-sm mt-1">Total Kamar</p>
                    <span
                        class="inline-block mt-2 px-2 py-0.5 bg-emerald-100 text-emerald-700 rounded text-xs font-bold">
                        {{ $availableRooms }} Tersedia
                    </span>
                </div>
            </div>

            <!-- Stat Card 2 (Revenue) -->
            <div
                class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 flex items-center gap-6 hover:shadow-md transition-shadow">
                <div class="w-16 h-16 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-3xl font-extrabold text-slate-800">Rp
                        {{ number_format($monthlyRevenue / 1000000, 1, ',', '.') }}M
                    </h3>
                    <p class="text-slate-500 font-medium text-sm mt-1">Pendapatan (Bulan Ini)</p>
                    <span
                        class="inline-block mt-2 px-2 py-0.5 bg-emerald-100 text-emerald-700 rounded text-xs font-bold">
                        {{ $activeBookings }} Sewa Aktif
                    </span>
                </div>
            </div>

            <!-- Stat Card 3 (Action) -->
            <a href="{{ route('admin.rooms.create') }}"
                class="bg-white p-6 rounded-3xl shadow-sm border-2 border-dashed border-indigo-200 flex items-center justify-center gap-4 hover:border-indigo-500 hover:bg-indigo-50 transition-all cursor-pointer group h-full">
                <div
                    class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600 group-hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                </div>
                <div class="text-left">
                    <h3 class="text-lg font-bold text-slate-800">Tambah Kamar</h3>
                    <p class="text-slate-500 text-xs">Upload properti baru</p>
                </div>
            </a>

        </div>

        <!-- Charts / Activity Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Recent Bookings Table -->
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="font-bold text-lg text-slate-800">Sewa Terbaru</h3>
                    <a href="#" class="text-indigo-600 text-sm font-semibold hover:underline">Lihat Semua</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th class="px-4 py-2">Penghuni</th>
                                <th class="px-4 py-2">Kamar</th>
                                <th class="px-4 py-2">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentBookings as $booking)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-4 py-3 font-medium text-gray-900">{{ $booking->user->name }}</td>
                                    <td class="px-4 py-3">{{ $booking->room->name }}</td>
                                    <td class="px-4 py-3">
                                        <span
                                            class="bg-{{ $booking->payment_status == 'paid' ? 'emerald' : 'yellow' }}-100 text-{{ $booking->payment_status == 'paid' ? 'emerald' : 'yellow' }}-800 text-xs font-bold px-2.5 py-0.5 rounded">
                                            {{ ucfirst($booking->payment_status) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-4">Belum ada booking.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Occupancy Rate Circular Chart -->
            @php
                $occupancyRate = $totalRooms > 0 ? round(($activeBookings / $totalRooms) * 100) : 0;
                $strokeDash = ($occupancyRate / 100) * 100; // Simplified for 0-100 mapping to dasharray
            @endphp
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100">
                <h3 class="font-bold text-lg text-slate-800 mb-6">Status Okupansi</h3>
                <div class="flex items-center justify-center h-64">
                    <div class="relative w-48 h-48">
                        <svg class="w-full h-full transform -rotate-90" viewBox="0 0 36 36">
                            <!-- Background Circle -->
                            <path class="text-slate-100"
                                d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                                fill="none" stroke="currentColor" stroke-width="4" />
                            <!-- Fill Circle -->
                            <path class="text-indigo-600 transition-all duration-1000 ease-out"
                                stroke-dasharray="{{ $strokeDash }}, 100"
                                d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                                fill="none" stroke="currentColor" stroke-width="4" />
                        </svg>
                        <div class="absolute inset-0 flex items-center justify-center flex-col">
                            <span class="text-4xl font-extrabold text-slate-800">{{ $occupancyRate }}%</span>
                            <span class="text-xs text-slate-500 uppercase tracking-wide">Terisi</span>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center gap-6 text-sm">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-indigo-600"></span>
                        <span class="text-slate-600">Terisi ({{ $activeBookings }})</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-slate-200"></span>
                        <span class="text-slate-600">Kosong ({{ $availableRooms }})</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>