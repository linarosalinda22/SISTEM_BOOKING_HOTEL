@extends('layouts.master')

@section('title', 'Pembayaran')

@section('content')
<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<div class="p-6">

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">
        Pembayaran
    </h2>
    <div class="flex items-center gap-3">
        <!-- Tombol Kembali -->
        <a href="{{ route('dashboard') }}"
            class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">
            <i class="fas fa-arrow-left mr-2"></i>
            Dashboard
        </a>
        <!-- Tombol Input -->
        <a href="{{ route('pembayaran.create') }}"
            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">

            <i class="fas fa-plus mr-2"></i>
            Input Pembayaran
        </a>
    </div>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="p-6 border-b border-gray-200">
        <form action="{{ route('pembayaran.index') }}" method="GET" class="flex gap-4">
            <input type="text" name="search" placeholder="Cari nama tamu..." value="{{ $search }}" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
            <select name="status"
    class="min-w-[180px] px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                <option value="">Semua Status</option>
                <option value="Lunas" {{ $status == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                <option value="Belum Lunas" {{ $status == 'Belum Lunas' ? 'selected' : '' }}>Belum Lunas</option>
            </select>
            <button type="submit"
    class="bg-blue-600 text-white w-12 h-12 rounded-lg hover:bg-blue-700 transition flex items-center justify-center text-xl">
    🔍︎
</button>
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-100 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">No.</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Nama Tamu</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Kamar</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Total Bayar</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Metode</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pembayarans as $pembayaran)
                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="px-6 py-3">{{ $pembayarans->firstItem() + $loop->index }}</td>
                        <td class="px-6 py-3">{{ $pembayaran->booking->tamu->nama_lengkap }}</td>
                        <td class="px-6 py-3">{{ $pembayaran->booking->kamar->nomor_kamar }}</td>
                        <td class="px-6 py-3">Rp {{ number_format($pembayaran->total_bayar, 0, ',', '.') }}</td>
                        <td class="px-6 py-3">{{ $pembayaran->metode_pembayaran }}</td>
                        <td class="px-6 py-3">
                            <span class="px-3 py-1 rounded-full text-sm font-semibold
                                {{ $pembayaran->status_pembayaran == 'Lunas' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}
                            ">
                                {{ $pembayaran->status_pembayaran }}
                            </span>
                        </td>
                        <td class="px-6 py-3">
                            <a href="{{ route('pembayaran.show', $pembayaran) }}" class="text-blue-600 hover:text-blue-700 mr-2" title="Lihat">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('pembayaran.edit', $pembayaran) }}" class="text-yellow-600 hover:text-yellow-700 mr-2" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="{{ route('pembayaran.invoice', $pembayaran) }}" class="text-green-600 hover:text-green-700 mr-2" title="Cetak Invoice" target="_blank">
                                <i class="fas fa-file-pdf"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">Tidak ada data pembayaran</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="px-6 py-4 border-t border-gray-200">
        {{ $pembayarans->links() }}
    </div>
</div>
@endsection
