@extends('layouts.master')

@section('title', 'Detail Kamar')

@section('content')
<div class="max-w-2xl">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Detail Kamar</h2>
        <a href="{{ route('kamar.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <p class="text-gray-600 text-sm">Nomor Kamar</p>
                <p class="text-lg font-semibold text-gray-800">{{ $kamar->nomor_kamar }}</p>
            </div>

            <div>
                <p class="text-gray-600 text-sm">Tipe Kamar</p>
                <p class="text-lg font-semibold text-gray-800">{{ $kamar->tipeKamar->nama_tipe }}</p>
            </div>

            <div>
                <p class="text-gray-600 text-sm">Lantai</p>
                <p class="text-lg font-semibold text-gray-800">{{ $kamar->lantai }}</p>
            </div>

            <div>
                <p class="text-gray-600 text-sm">Status</p>
                <p class="text-lg font-semibold">
                    <span class="px-3 py-1 rounded-full text-sm
                        {{ $kamar->status_kamar == 'Tersedia' ? 'bg-green-100 text-green-700' : '' }}
                        {{ $kamar->status_kamar == 'Terisi' ? 'bg-red-100 text-red-700' : '' }}
                        {{ $kamar->status_kamar == 'Maintenance' ? 'bg-yellow-100 text-yellow-700' : '' }}
                    ">
                        {{ $kamar->status_kamar }}
                    </span>
                </p>
            </div>

            <div>
                <p class="text-gray-600 text-sm">Harga Per Malam</p>
                <p class="text-lg font-semibold text-gray-800">Rp {{ number_format($kamar->tipeKamar->harga_per_malam, 0, ',', '.') }}</p>
            </div>

            <div>
                <p class="text-gray-600 text-sm">Kapasitas</p>
                <p class="text-lg font-semibold text-gray-800">{{ $kamar->tipeKamar->kapasitas }} Orang</p>
            </div>
        </div>

        <div class="flex gap-4">
            <a href="{{ route('kamar.edit', $kamar) }}" class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 transition">
                <i class="fas fa-edit mr-2"></i> Edit
            </a>
            <form action="{{ route('kamar.destroy', $kamar) }}" method="POST" class="inline" onsubmit="confirmDelete(event)">
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
