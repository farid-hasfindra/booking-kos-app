<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Kamar') }}
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

            <div class="flex justify-end mb-4">
                <a href="{{ route('admin.rooms.create') }}"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded shadow">
                    + Tambah Kamar
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">Nama Kamar</th>
                                <th scope="col" class="px-6 py-3">Harga</th>
                                <th scope="col" class="px-6 py-3">Lokasi</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                                <th scope="col" class="px-6 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rooms as $room)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        {{ $room->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        Rp {{ number_format($room->price, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $room->location }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="{{ $room->status === 'available' ? 'text-green-600 bg-green-100' : 'text-red-600 bg-red-100' }} px-2 py-1 rounded text-xs font-bold uppercase">
                                            {{ $room->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 flex space-x-2">
                                        <a href="{{ route('admin.rooms.edit', $room) }}"
                                            class="font-medium text-blue-600 hover:underline">Edit</a>
                                        <form action="{{ route('admin.rooms.destroy', $room) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="font-medium text-red-600 hover:underline">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $rooms->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>