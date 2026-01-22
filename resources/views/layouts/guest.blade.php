<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div
        class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-indigo-50 to-purple-50 relative overflow-hidden">

        <!-- Background Decorations -->
        <div
            class="absolute top-0 left-0 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-indigo-200/50 rounded-full blur-3xl opacity-50 pointer-events-none">
        </div>
        <div
            class="absolute bottom-0 right-0 translate-x-1/2 translate-y-1/2 w-96 h-96 bg-purple-200/50 rounded-full blur-3xl opacity-50 pointer-events-none">
        </div>

        <div class="z-10 animate-fade-in-down mb-6 text-center">
            <a href="/" class="flex flex-col items-center gap-2 group">
                <div
                    class="w-14 h-14 bg-indigo-600 rounded-2xl flex items-center justify-center text-white font-bold text-2xl shadow-lg shadow-indigo-200 group-hover:scale-110 transition-transform duration-300">
                    K
                </div>
                <span
                    class="font-bold text-2xl tracking-tight text-slate-800 group-hover:text-indigo-600 transition-colors">Kos
                    Bu Linda</span>
            </a>
        </div>

        <div
            class="w-full sm:max-w-md px-8 py-10 bg-white/80 backdrop-blur-xl shadow-2xl border border-white/50 sm:rounded-3xl z-10 animate-fade-in-up">
            {{ $slot }}
        </div>

        <div class="mt-8 text-center text-sm text-slate-400 z-10 animate-fade-in delay-300">
            &copy; {{ date('Y') }} Kos Bu Linda. All rights reserved.
        </div>
    </div>
</body>

</html>