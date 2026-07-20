<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dealer/Distributor') }}
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
                    <h3 class="text-lg font-semibold">Daftar Dealer/Distributor</h3>
                    @role('admin')
                        <a href="{{ route('suppliers.create') }}"
                           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            + Tambah Dealer
                        </a>
                    @endrole
                </div>

                <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b bg-gray-50">
                            <th class="p-3">No</th>
                            <th class="p-3">Nama Dealer</th>
                            <th class="p-3">Kontak</th>
                            <th class="p-3">Alamat</th>
                            <th class="p-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($suppliers as $supplier)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-3">{{ $loop->iteration }}</td>
                                <td class="p-3">{{ $supplier->nama_supplier }}</td>
                                <td class="p-3">{{ $supplier->kontak ?? '-' }}</td>
                                <td class="p-3">{{ $supplier->alamat ?? '-' }}</td>
                                <td class="p-3 space-x-2">
                                    @role('admin')
                                        <a href="{{ route('suppliers.edit', $supplier) }}"
                                           class="text-blue-600 hover:underline">Edit</a>

                                        <form action="{{ route('suppliers.destroy', $supplier) }}"
                                              method="POST" class="inline"
                                              onsubmit="return confirm('Yakin ingin menghapus supplier ini?')">
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
                                <td colspan="5" class="p-3 text-center text-gray-500">
                                    Belum ada data supplier.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
               </table>
                </div>

                <div class="mt-4">
                    {{ $suppliers->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>