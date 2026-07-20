<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tipe Mobil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Daftar Tipe Mobil</h3>
                    @role('admin')
                        <a href="{{ route('categories.create') }}"
                           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            + Tambah Tipe Mobil
                        </a>
                    @endrole
                </div>

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b bg-gray-50">
                            <th class="p-3">No</th>
                            <th class="p-3">Nama Tipe Mobil</th>
                            <th class="p-3">Deskripsi</th>
                            <th class="p-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-3">{{ $loop->iteration }}</td>
                                <td class="p-3">{{ $category->nama_kategori }}</td>
                                <td class="p-3">{{ $category->deskripsi ?? '-' }}</td>
                                <td class="p-3 space-x-2">
                                    @role('admin')
                                        <a href="{{ route('categories.edit', $category) }}"
                                           class="text-blue-600 hover:underline">Edit</a>

                                        <form action="{{ route('categories.destroy', $category) }}"
                                              method="POST" class="inline"
                                              onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">
                                                Hapus
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-gray-400 text-sm">Tidak ada akses</span>
                                    @endrole
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-3 text-center text-gray-500">
                                    Belum ada data kategori.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $categories->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>