<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-6">
            <h2 class="text-2xl font-bold text-slate-800 text-center mb-1">Selamat Datang Kembali</h2>
            <p class="text-slate-500 text-center text-sm">Masuk untuk mengelola hunian Anda</p>
        </div>

        <!-- Username -->
        <div>
            <x-input-label for="username" :value="__('Username')" class="text-slate-700 font-semibold" />
            <x-text-input id="username"
                class="block mt-2 w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 py-3"
                type="text" name="username" :value="old('username')" required autofocus autocomplete="username"
                placeholder="Masukkan username Anda" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-5" x-data="{ show: false }">
            <x-input-label for="password" :value="__('Password')" class="text-slate-700 font-semibold" />

            <div class="relative mt-2">
                <x-text-input id="password"
                    class="block w-full pr-12 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 py-3"
                    ::type="show ? 'text' : 'password'" name="password" required autocomplete="current-password"
                    placeholder="••••••••" />
                <button type="button" @click="show = !show"
                    class="absolute inset-y-0 right-0 flex items-center px-4 text-gray-400 hover:text-indigo-600 transition-colors">
                    <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <svg x-show="show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" class="w-5 h-5" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                    </svg>
                </button>
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-6 flex justify-between items-center">
            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 cursor-pointer"
                    name="remember">
                <span
                    class="ms-2 text-sm text-gray-600 group-hover:text-indigo-600 transition-colors">{{ __('Ingat saya') }}</span>
            </label>
        </div>

        <div class="mt-8">
            <button
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3.5 px-4 rounded-xl shadow-lg shadow-indigo-200 transition-all transform hover:-translate-y-0.5"
                type="submit">
                {{ __('Masuk Sekarang') }}
            </button>
        </div>
    </form>
</x-guest-layout>