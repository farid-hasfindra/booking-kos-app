<x-app-layout>
    <x-slot name="header">
        Dashboard Pelanggan
    </x-slot>

    <div class="space-y-8">
        <!-- Welcome Hero -->
        <div
            class="bg-gradient-to-r from-emerald-500 to-teal-500 rounded-3xl p-10 shadow-lg text-white relative overflow-hidden">
            <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 bg-white opacity-10 rounded-full blur-2xl"></div>
            <div class="relative z-10">
                <h1 class="text-3xl font-bold mb-2">Halo, {{ Auth::user()->name }}! 👋</h1>
                <p class="text-emerald-50">Selamat datang di area penghuni. Cek tagihan dan status kamarmu di sini.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Payment Status Card -->
            <div class="lg:col-span-2 bg-white rounded-3xl shadow-sm border border-slate-100 p-8">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-slate-800 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-emerald-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Status Pembayaran
                    </h3>
                    @if ($activeBooking && $activeBooking->payment_status == 'paid')
                        <span
                            class="bg-emerald-100 text-emerald-700 font-bold px-4 py-1.5 rounded-full text-sm">LUNAS</span>
                    @elseif($activeBooking)
                        <span
                            class="bg-yellow-100 text-yellow-700 font-bold px-4 py-1.5 rounded-full text-sm">{{ strtoupper($activeBooking->payment_status) }}</span>
                    @else
                        <span class="bg-gray-100 text-gray-700 font-bold px-4 py-1.5 rounded-full text-sm">-</span>
                    @endif
                </div>

                @if ($activeBooking)
                    <div class="space-y-6">
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                            <div>
                                <p class="text-sm text-slate-500">Periode</p>
                                <p class="font-bold text-slate-800">
                                    {{ $activeBooking->start_date->format('d M') }} -
                                    {{ $activeBooking->end_date->format('d M Y') }}
                                </p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm text-slate-500">Jatuh Tempo</p>
                                <p class="font-bold text-slate-800">
                                    {{ $activeBooking->start_date->addDays(5)->format('d F Y') }}</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                            <div>
                                <p class="text-sm text-slate-500">Total Tagihan</p>
                                <p class="font-bold text-xl text-slate-800">Rp
                                    {{ number_format($activeBooking->total_price, 0, ',', '.') }}</p>
                            </div>
                            <button
                                class="bg-slate-200 text-slate-500 px-4 py-2 rounded-lg text-sm font-semibold cursor-not-allowed">
                                {{ $activeBooking->payment_status == 'paid' ? 'Sudah Dibayar' : 'Tagihan Belum Lunas' }}
                            </button>
                        </div>
                    </div>
                @else
                    <div class="text-center py-8 text-slate-400">
                        <p>Belum ada sewa aktif saat ini.</p>
                    </div>
                @endif

                <div class="mt-8 pt-6 border-t border-gray-100">
                    <h4 class="font-bold text-slate-800 mb-4">Riwayat Sewa</h4>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2">Kamar</th>
                                    <th class="px-4 py-2">Periode</th>
                                    <th class="px-4 py-2">Nominal</th>
                                    <th class="px-4 py-2">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bookings as $booking)
                                    <tr class="bg-white border-b hover:bg-gray-50 transition">
                                        <td class="px-4 py-3 font-medium text-gray-900">
                                            {{ $booking->room->name }}
                                        </td>
                                        <td class="px-4 py-3">
                                            {{ $booking->start_date->format('M Y') }}
                                        </td>
                                        <td class="px-4 py-3">Rp
                                            {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3">
                                            @if ($booking->payment_status == 'paid')
                                                <span class="text-emerald-600 font-bold">Lunas</span>
                                            @elseif($booking->payment_status == 'pending')
                                                <span class="text-yellow-600 font-bold">Pending</span>
                                            @else
                                                <span class="text-red-600 font-bold">Failed</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-4 py-3 text-center">Belum ada riwayat sewa.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Room Info Card -->
            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-8 flex flex-col h-full">
                <h3 class="text-xl font-bold text-slate-800 mb-6 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Kamar Saya
                </h3>

                @if ($activeBooking)
                    <div class="bg-indigo-50 rounded-2xl p-6 mb-6 flex-grow">
                        <h4 class="text-lg font-bold text-indigo-900 mb-2">{{ $activeBooking->room->name }}</h4>
                        <p class="text-indigo-600 text-sm mb-4">{{ $activeBooking->room->location }}</p>

                        <div class="text-sm text-slate-600">
                            <p class="mb-2 font-semibold">Fasilitas:</p>
                            <p>{{ $activeBooking->room->facilities }}</p>
                        </div>
                    </div>
                @else
                    <div class="bg-indigo-50 rounded-2xl p-6 mb-6 flex-grow flex items-center justify-center">
                        <p class="text-indigo-400">Tidak ada kamar aktif</p>
                    </div>
                @endif

                <div class="text-center">
                    <p class="text-xs text-slate-400 mb-2">Butuh bantuan?</p>
                    <a href="https://wa.me/6281234567890" target="_blank"
                        class="block w-full bg-slate-900 text-white py-3 rounded-xl font-semibold hover:bg-slate-800 transition shadow-lg">
                        Hubungi Penjaga
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>