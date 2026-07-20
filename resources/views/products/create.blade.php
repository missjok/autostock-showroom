<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Unit Mobil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('products.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                        <div class="mb-4">
                            <label for="nama_barang" class="block font-medium text-sm text-gray-700">
                                Nama Unit
                            </label>
                            <input type="text" name="nama_barang" id="nama_barang"
                                   value="{{ old('nama_barang') }}"
                                   placeholder="Contoh: Toyota Avanza 2023"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @error('nama_barang')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="merk" class="block font-medium text-sm text-gray-700">
                                Merk
                            </label>
                            <input type="text" name="merk" id="merk"
                                   value="{{ old('merk') }}"
                                   placeholder="Contoh: Toyota"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @error('merk')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="tahun" class="block font-medium text-sm text-gray-700">
                                Tahun
                            </label>
                            <input type="number" name="tahun" id="tahun"
                                   value="{{ old('tahun') }}"
                                   placeholder="Contoh: 2023"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @error('tahun')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="warna" class="block font-medium text-sm text-gray-700">
                                Warna
                            </label>
                            <input type="text" name="warna" id="warna"
                                   value="{{ old('warna') }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @error('warna')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="no_polisi" class="block font-medium text-sm text-gray-700">
                                No. Polisi (opsional)
                            </label>
                            <input type="text" name="no_polisi" id="no_polisi"
                                   value="{{ old('no_polisi') }}"
                                   placeholder="Contoh: BL 1234 AB"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @error('no_polisi')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="status" class="block font-medium text-sm text-gray-700">
                                Status
                            </label>
                            <select name="status" id="status"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="tersedia" {{ old('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                                <option value="booking" {{ old('status') == 'booking' ? 'selected' : '' }}>Booking</option>
                                <option value="terjual" {{ old('status') == 'terjual' ? 'selected' : '' }}>Terjual</option>
                            </select>
                            @error('status')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="category_id" class="block font-medium text-sm text-gray-700">
                                Tipe Mobil
                            </label>
                            <select name="category_id" id="category_id"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="">-- Pilih Tipe Mobil --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="supplier_id" class="block font-medium text-sm text-gray-700">
                                Dealer/Distributor
                            </label>
                            <select name="supplier_id" id="supplier_id"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="">-- Pilih Dealer --</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                        {{ $supplier->nama_supplier }}
                                    </option>
                                @endforeach
                            </select>
                            @error('supplier_id')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="stok" class="block font-medium text-sm text-gray-700">
                                Stok
                            </label>
                            <input type="number" name="stok" id="stok"
                                   value="{{ old('stok', 1) }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @error('stok')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="harga" class="block font-medium text-sm text-gray-700">
                                Harga (Rp)
                            </label>
                            <input type="number" name="harga" id="harga"
                                   value="{{ old('harga') }}"
                                   placeholder="Contoh: 250000000"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @error('harga')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="satuan" class="block font-medium text-sm text-gray-700">
                                Satuan
                            </label>
                            <input type="text" name="satuan" id="satuan"
                                   value="{{ old('satuan', 'unit') }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @error('satuan')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <div class="flex items-center gap-3 mt-4">
                        <button type="submit"
                                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Simpan
                        </button>
                        <a href="{{ route('products.index') }}" class="text-gray-600 hover:underline">
                            Batal
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>