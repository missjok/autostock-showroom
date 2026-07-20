<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('stock-movements.update', $stockMovement) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="product_id" class="block font-medium text-sm text-gray-700">
                            Unit Mobil
                        </label>
                        <select name="product_id" id="product_id"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">-- Pilih Unit Mobil --</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" {{ old('product_id', $stockMovement->product_id) == $product->id ? 'selected' : '' }}>
                                    {{ $product->nama_barang }} (Stok: {{ $product->stok }})
                                </option>
                            @endforeach
                        </select>
                        @error('product_id')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="jenis" class="block font-medium text-sm text-gray-700">
                            Jenis Transaksi
                        </label>
                        <select name="jenis" id="jenis"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="masuk" {{ old('jenis', $stockMovement->jenis) == 'masuk' ? 'selected' : '' }}>Masuk (dari Dealer)</option>
                            <option value="keluar" {{ old('jenis', $stockMovement->jenis) == 'keluar' ? 'selected' : '' }}>Keluar (Terjual)</option>
                        </select>
                        @error('jenis')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="jumlah" class="block font-medium text-sm text-gray-700">
                            Jumlah
                        </label>
                        <input type="number" name="jumlah" id="jumlah"
                               value="{{ old('jumlah', $stockMovement->jumlah) }}"
                               min="1"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @error('jumlah')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="keterangan" class="block font-medium text-sm text-gray-700">
                            Keterangan (opsional)
                        </label>
                        <textarea name="keterangan" id="keterangan" rows="3"
                                  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('keterangan', $stockMovement->keterangan) }}</textarea>
                        @error('keterangan')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4 p-3 bg-yellow-50 border border-yellow-200 rounded text-sm text-yellow-700">
                        <strong>Catatan:</strong> Mengubah data transaksi ini <u>tidak</u> otomatis menyesuaikan ulang stok produk. Silakan cek dan sesuaikan stok secara manual di halaman Unit Mobil jika diperlukan.
                    </div>

                    <div class="flex items-center gap-3">
                        <button type="submit"
                                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Update
                        </button>
                        <a href="{{ route('stock-movements.index') }}" class="text-gray-600 hover:underline">
                            Batal
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>