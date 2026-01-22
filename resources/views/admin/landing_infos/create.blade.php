<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.landing-infos.index') }}"
                class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tambah Fitur Beranda') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.landing-infos.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="value" :value="__('Nilai (Contoh: 20+)')" />
                            <x-text-input id="value" name="value" type="text" class="mt-1 block w-full"
                                :value="old('value')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('value')" />
                        </div>

                        <div>
                            <x-input-label for="text" :value="__('Keterangan (Contoh: Kamar Eksklusif)')" />
                            <x-text-input id="text" name="text" type="text" class="mt-1 block w-full"
                                :value="old('text')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('text')" />
                        </div>

                        <div>
                            <x-input-label for="icon" :value="__('Icon SVG (Opsional)')" />
                            <textarea id="icon" name="icon" rows="3"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                placeholder="<svg ...>...</svg>">{{ old('icon') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('icon')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Simpan') }}</x-primary-button>
                            <a href="{{ route('admin.landing-infos.index') }}"
                                class="text-gray-600 hover:text-gray-900">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>