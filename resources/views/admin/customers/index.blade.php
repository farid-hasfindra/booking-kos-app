<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Pelanggan') }}
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
                <a href="{{ route('admin.customers.create') }}"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded shadow">
                    + Tambah Pelanggan
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">Nama</th>
                                <th scope="col" class="px-6 py-3">Username</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                                <th scope="col" class="px-6 py-3">Tanggal Bergabung</th>
                                <th scope="col" class="px-6 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customers as $customer)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        {{ $customer->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $customer->username }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <form action="{{ route('admin.customers.toggle-status', $customer->id) }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="px-2 py-1 rounded text-xs font-bold {{ $customer->is_active ? 'bg-green-100 text-green-700 hover:bg-green-200' : 'bg-red-100 text-red-700 hover:bg-red-200' }}">
                                                {{ $customer->is_active ? 'Aktif' : 'Non-Aktif' }}
                                            </button>
                                        </form>
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $customer->created_at->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 flex items-center gap-4">
                                        <a href="{{ route('admin.customers.edit', $customer->id) }}"
                                            class="font-medium text-blue-600 hover:underline">Edit</a>

                                        <form action="{{ route('admin.customers.destroy', $customer->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus pelanggan ini?');">
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

                    <div class="mt-4">
                        {{ $customers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>