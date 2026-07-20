<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Tipe Mobil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="nama_kategori" class="block font-medium text-sm text-gray-700">
                            Nama Tipe Mobil
                        </label>
                        <input type="text" name="nama_kategori" id="nama_kategori"
                               value="{{ old('nama_kategori') }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @error('nama_kategori')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="deskripsi" class="block font-medium text-sm text-gray-700">
                            Deskripsi (opsional)
                        </label>
                        <textarea name="deskripsi" id="deskripsi" rows="3"
                                  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center gap-3">
                        <button type="submit"
                                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Simpan
                        </button>
                        <a href="{{ route('categories.index') }}" class="text-gray-600 hover:underline">
                            Batal
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>