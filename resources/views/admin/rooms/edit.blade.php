<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Kamar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.rooms.update', $room) }}" method="POST" enctype="multipart/form-data"
                        class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="name" :value="__('Nama Kamar')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                :value="old('name', $room->name)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div>
                            <x-input-label for="price" :value="__('Harga (Per Bulan)')" />
                            <x-text-input id="price" name="price" type="number" class="mt-1 block w-full"
                                :value="old('price', $room->price)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('price')" />
                        </div>

                        <div>
                            <x-input-label for="location" :value="__('Lokasi (Lantai/Blok)')" />
                            <x-text-input id="location" name="location" type="text" class="mt-1 block w-full"
                                :value="old('location', $room->location)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('location')" />
                        </div>

                        <div>
                            <x-input-label for="status" :value="__('Status')" />
                            <select id="status" name="status"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="available" {{ $room->status == 'available' ? 'selected' : '' }}>Available
                                </option>
                                <option value="full" {{ $room->status == 'full' ? 'selected' : '' }}>Full</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('status')" />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Deskripsi')" />
                            <textarea id="description" name="description" rows="4"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                required>{{ old('description', $room->description) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div>
                            <x-input-label for="facilities" :value="__('Fasilitas (Pisahkan dengan koma)')" />
                            <textarea id="facilities" name="facilities" rows="2"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                required>{{ old('facilities', $room->facilities) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('facilities')" />
                        </div>

                        <div>
                            <x-input-label for="image" :value="__('Ganti Gambar Utama (Opsional)')" />
                            <input id="image" name="image" type="file"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                            <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengganti gambar.</p>
                            <x-input-error class="mt-2" :messages="$errors->get('image')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Update Kamar') }}</x-primary-button>
                            <a href="{{ route('admin.rooms.index') }}"
                                class="text-gray-600 hover:text-gray-900">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>