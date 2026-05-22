@extends('layouts.app')

@section('title', 'Tambah Kamar')

@section('content')
<div class="max-w-2xl">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Tambah Kamar</h2>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('kamar.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Nomor Kamar <span class="text-red-500">*</span></label>
                <input type="text" name="nomor_kamar" value="{{ old('nomor_kamar') }}" placeholder="Contoh: 101" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('nomor_kamar') border-red-500 @enderror">
                @error('nomor_kamar') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Tipe Kamar <span class="text-red-500">*</span></label>
                <select name="tipe_kamar_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('tipe_kamar_id') border-red-500 @enderror">
                    <option value="">Pilih Tipe Kamar</option>
                    @foreach($tipeKamars as $tipeKamar)
                        <option value="{{ $tipeKamar->id }}" {{ old('tipe_kamar_id') == $tipeKamar->id ? 'selected' : '' }}>
                            {{ $tipeKamar->nama_tipe }} - Rp {{ number_format($tipeKamar->harga_per_malam, 0, ',', '.') }}
                        </option>
                    @endforeach
                </select>
                @error('tipe_kamar_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Lantai <span class="text-red-500">*</span></label>
                    <input type="number" name="lantai" value="{{ old('lantai') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('lantai') border-red-500 @enderror">
                    @error('lantai') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Status <span class="text-red-500">*</span></label>
                    <select name="status_kamar" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('status_kamar') border-red-500 @enderror">
                        <option value="Tersedia" {{ old('status_kamar') == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="Terisi" {{ old('status_kamar') == 'Terisi' ? 'selected' : '' }}>Terisi</option>
                        <option value="Maintenance" {{ old('status_kamar') == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                    </select>
                    @error('status_kamar') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                    <i class="fas fa-save mr-2"></i> Simpan
                </button>
                <a href="{{ route('kamar.index') }}" class="bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition">
                    <i class="fas fa-times mr-2"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
