<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Fitur Beranda') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.landing-infos.update', $landingInfo->id) }}" method="POST"
                        class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="value" :value="__('Nilai (Contoh: 20+)')" />
                            <x-text-input id="value" name="value" type="text" class="mt-1 block w-full"
                                :value="old('value', $landingInfo->value)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('value')" />
                        </div>

                        <div>
                            <x-input-label for="text" :value="__('Keterangan (Contoh: Kamar Eksklusif)')" />
                            <x-text-input id="text" name="text" type="text" class="mt-1 block w-full"
                                :value="old('text', $landingInfo->text)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('text')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Simpan Perubahan') }}</x-primary-button>
                            <a href="{{ route('admin.landing-infos.index') }}"
                                class="text-gray-600 hover:text-gray-900">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>