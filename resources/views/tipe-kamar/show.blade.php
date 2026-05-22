@extends('layouts.app')

@section('title', 'Detail Tipe Kamar')

@section('content')
<div class="max-w-2xl">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Detail Tipe Kamar</h2>
        <a href="{{ route('tipe-kamar.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        @if($tipeKamar->foto)
            <div class="mb-6">
                <img src="{{ asset('storage/' . $tipeKamar->foto) }}" alt="Foto" class="w-full h-64 object-cover rounded-lg">
            </div>
        @endif

        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <p class="text-gray-600 text-sm">Nama Tipe</p>
                <p class="text-lg font-semibold text-gray-800">{{ $tipeKamar->nama_tipe }}</p>
            </div>

            <div>
                <p class="text-gray-600 text-sm">Harga Per Malam</p>
                <p class="text-lg font-semibold text-gray-800">Rp {{ number_format($tipeKamar->harga_per_malam, 0, ',', '.') }}</p>
            </div>

            <div>
                <p class="text-gray-600 text-sm">Kapasitas</p>
                <p class="text-lg font-semibold text-gray-800">{{ $tipeKamar->kapasitas }} Orang</p>
            </div>

            <div>
                <p class="text-gray-600 text-sm">Jumlah Kamar</p>
                <p class="text-lg font-semibold text-gray-800">{{ $tipeKamar->kamar->count() }} Kamar</p>
            </div>

            <div class="col-span-2">
                <p class="text-gray-600 text-sm">Fasilitas</p>
                <p class="text-lg font-semibold text-gray-800">{{ $tipeKamar->fasilitas }}</p>
            </div>

            <div class="col-span-2">
                <p class="text-gray-600 text-sm">Deskripsi</p>
                <p class="text-lg font-semibold text-gray-800">{{ $tipeKamar->deskripsi }}</p>
            </div>
        </div>

        <div class="flex gap-4">
            <a href="{{ route('tipe-kamar.edit', $tipeKamar) }}" class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 transition">
                <i class="fas fa-edit mr-2"></i> Edit
            </a>
            <form action="{{ route('tipe-kamar.destroy', $tipeKamar) }}" method="POST" class="inline" onsubmit="confirmDelete(event)">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">
                    <i class="fas fa-trash mr-2"></i> Hapus
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
