<div x-cloak :class="sidebarOpen ? 'w-64' : 'w-20'"
    class="fixed inset-y-0 left-0 z-30 bg-slate-900 transition-all duration-300 transform shadow-2xl overflow-y-auto flex flex-col">
    <!-- Brand -->
    <div class="flex items-center justify-center h-20 bg-slate-950 border-b border-white/10">
        <div class="flex items-center gap-3">
            <div
                class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-indigo-500/30">
                K
            </div>
            <span x-show="sidebarOpen"
                class="font-bold text-xl text-white tracking-wide transition-opacity duration-300">KosAdmin</span>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-4 py-8 space-y-2">

        <!-- Dashboard Link (Common) -->
        <a href="{{ route('dashboard') }}"
            class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('dashboard') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/30' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
            </svg>
            <span x-show="sidebarOpen" class="font-medium whitespace-nowrap">Dashboard</span>

            <!-- Tooltip for collapsed state -->
            <div x-show="!sidebarOpen"
                class="fixed left-20 ml-2 bg-slate-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none z-50">
                Dashboard
            </div>
        </a>

        @if(Auth::user()->role === 'admin')
            <p x-show="sidebarOpen" class="px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider mt-8 mb-2">
                Manajemen</p>

            <!-- Manage Rooms -->
            <a href="{{ route('admin.rooms.index') }}"
                class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.rooms.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/30' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                <span x-show="sidebarOpen" class="font-medium whitespace-nowrap">Kamar Kost</span>
                <div x-show="!sidebarOpen"
                    class="fixed left-20 ml-2 bg-slate-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none z-50">
                    Kamar Kost
                </div>
            </a>

            <!-- Manage Customers -->
            <a href="{{ route('admin.customers.index') }}"
                class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.customers.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/30' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <span x-show="sidebarOpen" class="font-medium whitespace-nowrap">Pelanggan</span>
                <div x-show="!sidebarOpen"
                    class="fixed left-20 ml-2 bg-slate-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none z-50">
                    Pelanggan
                </div>
            </a>

            <!-- Manage Landing Info -->
            <a href="{{ route('admin.landing-infos.index') }}"
                class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.landing-infos.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/30' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                </svg>
                <span x-show="sidebarOpen" class="font-medium whitespace-nowrap">Fitur Beranda</span>
                <div x-show="!sidebarOpen"
                    class="fixed left-20 ml-2 bg-slate-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none z-50">
                    Fitur Beranda
                </div>
            </a>
        @endif

        @if(Auth::user()->role === 'customer')
            <p x-show="sidebarOpen" class="px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider mt-8 mb-2">
                Menu Saya</p>
            <a href="#"
                class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all duration-200 group text-slate-400 hover:bg-white/5 hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                </svg>
                <span x-show="sidebarOpen" class="font-medium whitespace-nowrap">Info Pembayaran</span>
            </a>
        @endif

    </nav>

    <!-- Collapse Button -->
    <div class="p-4 border-t border-white/10">
        <button @click="sidebarOpen = !sidebarOpen"
            class="w-full flex items-center justify-center p-2 rounded-xl text-slate-400 hover:bg-white/5 hover:text-white transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transform transition-transform duration-300"
                :class="sidebarOpen ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
            </svg>
        </button>
    </div>

    <!-- Logout -->
    <div class="p-4">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full flex items-center gap-4 px-4 py-3 rounded-xl text-red-400 hover:bg-red-500/10 hover:text-red-300 transition-all duration-200 group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span x-show="sidebarOpen" class="font-medium whitespace-nowrap">Logout</span>
                <div x-show="!sidebarOpen"
                    class="fixed left-20 ml-2 bg-red-600 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none z-50">
                    Logout
                </div>
            </button>
        </form>
    </div>
</div>