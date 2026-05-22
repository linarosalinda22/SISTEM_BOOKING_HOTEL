@extends('layouts.app')

@section('title', 'Kamar')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Kamar</h2>
    <a href="{{ route('kamar.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
        <i class="fas fa-plus mr-2"></i> Tambah Kamar
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="p-6 border-b border-gray-200">
        <form action="{{ route('kamar.index') }}" method="GET" class="flex gap-4">
            <input type="text" name="search" placeholder="Cari nomor kamar..." value="{{ $search }}" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
            <select name="status" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                <option value="">Semua Status</option>
                <option value="Tersedia" {{ $status == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                <option value="Terisi" {{ $status == 'Terisi' ? 'selected' : '' }}>Terisi</option>
                <option value="Maintenance" {{ $status == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
            </select>
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
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Nomor Kamar</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Tipe Kamar</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Lantai</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kamars as $kamar)
                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="px-6 py-3">{{ $kamars->firstItem() + $loop->index }}</td>
                        <td class="px-6 py-3 font-semibold">{{ $kamar->nomor_kamar }}</td>
                        <td class="px-6 py-3">{{ $kamar->tipeKamar->nama_tipe }}</td>
                        <td class="px-6 py-3">{{ $kamar->lantai }}</td>
                        <td class="px-6 py-3">
                            <span class="px-3 py-1 rounded-full text-sm font-semibold
                                {{ $kamar->status_kamar == 'Tersedia' ? 'bg-green-100 text-green-700' : '' }}
                                {{ $kamar->status_kamar == 'Terisi' ? 'bg-red-100 text-red-700' : '' }}
                                {{ $kamar->status_kamar == 'Maintenance' ? 'bg-yellow-100 text-yellow-700' : '' }}
                            ">
                                {{ $kamar->status_kamar }}
                            </span>
                        </td>
                        <td class="px-6 py-3">
                            <a href="{{ route('kamar.show', $kamar) }}" class="text-blue-600 hover:text-blue-700 mr-2">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('kamar.edit', $kamar) }}" class="text-yellow-600 hover:text-yellow-700 mr-2">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('kamar.destroy', $kamar) }}" method="POST" class="inline" onsubmit="confirmDelete(event)">
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
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">Tidak ada data kamar</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="px-6 py-4 border-t border-gray-200">
        {{ $kamars->links() }}
    </div>
</div>
@endsection
