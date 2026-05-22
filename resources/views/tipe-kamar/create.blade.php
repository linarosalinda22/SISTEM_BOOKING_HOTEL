@extends('layouts.app')

@section('title', 'Tambah Tipe Kamar')

@section('content')
<div class="max-w-2xl">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Tambah Tipe Kamar</h2>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('tipe-kamar.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Nama Tipe <span class="text-red-500">*</span></label>
                <input type="text" name="nama_tipe" value="{{ old('nama_tipe') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('nama_tipe') border-red-500 @enderror">
                @error('nama_tipe') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Harga Per Malam <span class="text-red-500">*</span></label>
                    <input type="number" name="harga_per_malam" value="{{ old('harga_per_malam') }}" step="1000" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('harga_per_malam') border-red-500 @enderror">
                    @error('harga_per_malam') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Kapasitas <span class="text-red-500">*</span></label>
                    <input type="number" name="kapasitas" value="{{ old('kapasitas') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('kapasitas') border-red-500 @enderror">
                    @error('kapasitas') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Fasilitas <span class="text-red-500">*</span></label>
                <textarea name="fasilitas" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('fasilitas') border-red-500 @enderror" placeholder="Contoh: AC, TV, WiFi, Kasur King Size">{{ old('fasilitas') }}</textarea>
                @error('fasilitas') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Deskripsi <span class="text-red-500">*</span></label>
                <textarea name="deskripsi" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('deskripsi') border-red-500 @enderror">{{ old('deskripsi') }}</textarea>
                @error('deskripsi') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Foto</label>
                <input type="file" name="foto" accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('foto') border-red-500 @enderror">
                <p class="text-gray-500 text-sm mt-1">Format: JPG, PNG, GIF | Ukuran maksimal: 2MB</p>
                @error('foto') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                    <i class="fas fa-save mr-2"></i> Simpan
                </button>
                <a href="{{ route('tipe-kamar.index') }}" class="bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition">
                    <i class="fas fa-times mr-2"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
