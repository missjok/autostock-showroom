<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Unit Mobil') }}
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
                    <h3 class="text-lg font-semibold">Daftar Unit Mobil</h3>
                    <div class="flex gap-2">
                        <a href="{{ route('products.export-pdf') }}"
                           class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-800">
                            Export PDF
                        </a>
                        @role('admin')
                            <a href="{{ route('products.create') }}"
                               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                + Tambah Unit Mobil
                            </a>
                        @endrole
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b bg-gray-50">
                                <th class="p-3">No</th>
                                <th class="p-3">Nama Unit</th>
                                <th class="p-3">Merk</th>
                                <th class="p-3">Tahun</th>
                                <th class="p-3">Warna</th>
                                <th class="p-3">Tipe Mobil</th>
                                <th class="p-3">Dealer</th>
                                <th class="p-3">Stok</th>
                                <th class="p-3">Harga</th>
                                <th class="p-3">Status</th>
                                <th class="p-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="p-3">{{ $loop->iteration }}</td>
                                    <td class="p-3">{{ $product->nama_barang }}</td>
                                    <td class="p-3">{{ $product->merk ?? '-' }}</td>
                                    <td class="p-3">{{ $product->tahun ?? '-' }}</td>
                                    <td class="p-3">{{ $product->warna ?? '-' }}</td>
                                    <td class="p-3">{{ $product->category->nama_kategori ?? '-' }}</td>
                                    <td class="p-3">{{ $product->supplier->nama_supplier ?? '-' }}</td>
                                    <td class="p-3">{{ $product->stok }}</td>
                                    <td class="p-3">Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                                    <td class="p-3">
                                        @if ($product->status === 'tersedia')
                                            <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-700">Tersedia</span>
                                        @elseif ($product->status === 'terjual')
                                            <span class="px-2 py-1 text-xs rounded bg-red-100 text-red-700">Terjual</span>
                                        @else
                                            <span class="px-2 py-1 text-xs rounded bg-yellow-100 text-yellow-700">Booking</span>
                                        @endif
                                    </td>
                                    <td class="p-3 space-x-2">
                                        @role('admin')
                                            <a href="{{ route('products.edit', $product) }}"
                                               class="text-blue-600 hover:underline">Edit</a>

                                            <form action="{{ route('products.destroy', $product) }}"
                                                  method="POST" class="inline"
                                                  onsubmit="return confirm('Yakin ingin menghapus unit mobil ini?')">
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
                                    <td colspan="11" class="p-3 text-center text-gray-500">
                                        Belum ada data unit mobil.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $products->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>