@extends('layouts.app')

@section('title', 'Tipe Kamar')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Tipe Kamar</h2>
    <a href="{{ route('tipe-kamar.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
        <i class="fas fa-plus mr-2"></i> Tambah Tipe Kamar
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="p-6 border-b border-gray-200">
        <form action="{{ route('tipe-kamar.index') }}" method="GET" class="flex gap-4">
            <input type="text" name="search" placeholder="Cari nama tipe kamar..." value="{{ $search }}" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-100 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">No.</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Nama Tipe</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Harga/Malam</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Kapasitas</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Foto</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tipeKamars as $tipeKamar)
                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="px-6 py-3">{{ $tipeKamars->firstItem() + $loop->index }}</td>
                        <td class="px-6 py-3">{{ $tipeKamar->nama_tipe }}</td>
                        <td class="px-6 py-3">Rp {{ number_format($tipeKamar->harga_per_malam, 0, ',', '.') }}</td>
                        <td class="px-6 py-3">{{ $tipeKamar->kapasitas }} Orang</td>
                        <td class="px-6 py-3">
                            @if($tipeKamar->foto)
                                <img src="{{ asset('storage/' . $tipeKamar->foto) }}" alt="Foto" class="w-12 h-12 object-cover rounded">
                            @else
                                <span class="text-gray-500">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-3">
                            <a href="{{ route('tipe-kamar.show', $tipeKamar) }}" class="text-blue-600 hover:text-blue-700 mr-2">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('tipe-kamar.edit', $tipeKamar) }}" class="text-yellow-600 hover:text-yellow-700 mr-2">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('tipe-kamar.destroy', $tipeKamar) }}" method="POST" class="inline" onsubmit="confirmDelete(event)">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-700">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">Tidak ada data tipe kamar</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="px-6 py-4 border-t border-gray-200">
        {{ $tipeKamars->links() }}
    </div>
</div>
@endsection
