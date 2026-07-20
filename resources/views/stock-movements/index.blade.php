<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Transaksi') }}
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

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Daftar Transaksi Mobil Masuk/Keluar</h3>
                    <a href="{{ route('stock-movements.create') }}"
                       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        + Tambah Transaksi
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b bg-gray-50">
                                <th class="p-3">No</th>
                                <th class="p-3">Tanggal</th>
                                <th class="p-3">Unit Mobil</th>
                                <th class="p-3">Jenis</th>
                                <th class="p-3">Jumlah</th>
                                <th class="p-3">Keterangan</th>
                                <th class="p-3">Dicatat Oleh</th>
                                <th class="p-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($stockMovements as $movement)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="p-3">{{ $loop->iteration }}</td>
                                    <td class="p-3">{{ $movement->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="p-3">{{ $movement->product->nama_barang ?? '-' }}</td>
                                    <td class="p-3">
                                        @if ($movement->jenis === 'masuk')
                                            <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-700">Masuk</span>
                                        @else
                                            <span class="px-2 py-1 text-xs rounded bg-red-100 text-red-700">Keluar</span>
                                        @endif
                                    </td>
                                    <td class="p-3">{{ $movement->jumlah }}</td>
                                    <td class="p-3">{{ $movement->keterangan ?? '-' }}</td>
                                    <td class="p-3">{{ $movement->user->name ?? '-' }}</td>
                                    <td class="p-3 space-x-2">
                                        @role('admin')
                                            <a href="{{ route('stock-movements.edit', $movement) }}"
                                               class="text-blue-600 hover:underline">Edit</a>

                                            <form action="{{ route('stock-movements.destroy', $movement) }}"
                                                  method="POST" class="inline"
                                                  onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')">
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
                                    <td colspan="8" class="p-3 text-center text-gray-500">
                                        Belum ada data transaksi.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $stockMovements->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>