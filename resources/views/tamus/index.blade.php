@extends('layouts.app')

@section('title', 'Data Tamu')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Data Tamu</h2>
    <a href="{{ route('tamus.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
        <i class="fas fa-plus mr-2"></i> Tambah Tamu
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="p-6 border-b border-gray-200">
        <form action="{{ route('tamus.index') }}" method="GET" class="flex gap-4">
            <input type="text" name="search" placeholder="Cari nama, email, atau nomor identitas..." value="{{ $search }}" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
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
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Nama Lengkap</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Email</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">No. Telepon</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Jenis Kelamin</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tamuses as $tamu)
                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="px-6 py-3">{{ $tamuses->firstItem() + $loop->index }}</td>
                        <td class="px-6 py-3">{{ $tamu->nama_lengkap }}</td>
                        <td class="px-6 py-3">{{ $tamu->email }}</td>
                        <td class="px-6 py-3">{{ $tamu->no_telepon }}</td>
                        <td class="px-6 py-3">
                            <span class="px-3 py-1 rounded-full text-sm {{ $tamu->jenis_kelamin == 'Laki-laki' ? 'bg-blue-100 text-blue-700' : 'bg-pink-100 text-pink-700' }}">
                                {{ $tamu->jenis_kelamin }}
                            </span>
                        </td>
                        <td class="px-6 py-3">
                            <a href="{{ route('tamus.show', $tamu) }}" class="text-blue-600 hover:text-blue-700 mr-2">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('tamus.edit', $tamu) }}" class="text-yellow-600 hover:text-yellow-700 mr-2">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('tamus.destroy', $tamu) }}" method="POST" class="inline" onsubmit="confirmDelete(event)">
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
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">Tidak ada data tamu</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="px-6 py-4 border-t border-gray-200">
        {{ $tamuses->links() }}
    </div>
</div>
@endsection
