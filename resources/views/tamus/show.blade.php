@extends('layouts.app')

@section('title', 'Detail Tamu')

@section('content')
<div class="max-w-2xl">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Detail Data Tamu</h2>
        <a href="{{ route('tamus.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="grid grid-cols-2 gap-6">
            <div>
                <p class="text-gray-600 text-sm">Nama Lengkap</p>
                <p class="text-lg font-semibold text-gray-800">{{ $tamu->nama_lengkap }}</p>
            </div>

            <div>
                <p class="text-gray-600 text-sm">Email</p>
                <p class="text-lg font-semibold text-gray-800">{{ $tamu->email }}</p>
            </div>

            <div>
                <p class="text-gray-600 text-sm">No. Telepon</p>
                <p class="text-lg font-semibold text-gray-800">{{ $tamu->no_telepon }}</p>
            </div>

            <div>
                <p class="text-gray-600 text-sm">Jenis Kelamin</p>
                <p class="text-lg font-semibold text-gray-800">{{ $tamu->jenis_kelamin }}</p>
            </div>

            <div>
                <p class="text-gray-600 text-sm">No. Identitas</p>
                <p class="text-lg font-semibold text-gray-800">{{ $tamu->no_identitas }}</p>
            </div>

            <div>
                <p class="text-gray-600 text-sm">Terdaftar Sejak</p>
                <p class="text-lg font-semibold text-gray-800">{{ $tamu->created_at->format('d M Y H:i') }}</p>
            </div>

            <div class="col-span-2">
                <p class="text-gray-600 text-sm">Alamat</p>
                <p class="text-lg font-semibold text-gray-800">{{ $tamu->alamat }}</p>
            </div>
        </div>

        <div class="mt-6 flex gap-4">
            <a href="{{ route('tamus.edit', $tamu) }}" class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 transition">
                <i class="fas fa-edit mr-2"></i> Edit
            </a>
            <form action="{{ route('tamus.destroy', $tamu) }}" method="POST" class="inline" onsubmit="confirmDelete(event)">
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
