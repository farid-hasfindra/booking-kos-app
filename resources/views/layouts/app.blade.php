<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-50 text-slate-800" x-data="{ sidebarOpen: true }">
    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Main Content -->
        <div class="flex-1 flex flex-col h-full overflow-hidden transition-all duration-300 relative"
            :class="sidebarOpen ? 'ml-64' : 'ml-20'">

            <!-- Top Bar -->
            <header
                class="bg-white/80 backdrop-blur-sm h-16 border-b border-gray-100 flex items-center justify-between px-6 z-10 sticky top-0">
                <div class="flex items-center gap-4">
                    <!-- Mobile Toggle (Visible only on small screens) -->
                    <button @click="sidebarOpen = !sidebarOpen"
                        class="text-slate-500 hover:text-indigo-600 transition-colors md:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <h2 class="font-bold text-xl text-slate-800">
                        {{ $header ?? 'Dashboard' }}
                    </h2>
                </div>

                <div class="flex items-center gap-4">
                    <span class="text-sm font-medium text-slate-500 hidden md:block">{{ date('l, d F Y') }}</span>
                    <div
                        class="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <span class="text-sm font-semibold text-slate-800 hidden md:block">{{ Auth::user()->name }}</span>
                </div>
            </header>

            <!-- Scrollable Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>