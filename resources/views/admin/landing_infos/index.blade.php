<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Fitur Beranda') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="mb-4 flex justify-end">
                <a href="{{ route('admin.landing-infos.create') }}"
                    class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                    + Tambah Data
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Nilai (Value)</th>
                                    <th scope="col" class="px-6 py-3">Teks (Keterangan)</th>
                                    <th scope="col" class="px-6 py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($landingInfos as $info)
                                    <tr class="bg-white border-b hover:bg-gray-50">
                                        <td class="px-6 py-4 font-bold text-gray-900">
                                            {{ $info->value }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $info->text }}
                                        </td>
                                        <td class="px-6 py-4 flex items-center gap-4">
                                            <a href="{{ route('admin.landing-infos.edit', $info->id) }}"
                                                class="font-medium text-blue-600 hover:underline">Edit</a>

                                            <form action="{{ route('admin.landing-infos.destroy', $info->id) }}"
                                                method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="font-medium text-red-600 hover:underline">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>