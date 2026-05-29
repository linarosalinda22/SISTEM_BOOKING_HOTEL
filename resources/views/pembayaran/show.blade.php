@extends('layouts.master')

@section('title', 'Detail Pembayaran')

@section('content')
<div class="max-w-3xl">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Detail Pembayaran</h2>
        <div class="space-x-2">
            <a href="{{ route('pembayaran.invoice', $pembayaran) }}" target="_blank" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition inline-block">
                <i class="fas fa-file-pdf mr-2"></i> Cetak Invoice
            </a>
            <a href="{{ route('pembayaran.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition inline-block">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Data Pembayaran -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold mb-4 border-b pb-3">Data Pembayaran</h3>
            
            <div class="mb-4">
                <p class="text-gray-600 text-sm">Nomor Pembayaran</p>
                <p class="text-lg font-semibold text-gray-800">PMB-{{ $pembayaran->id }}</p>
            </div>

            <div class="mb-4">
                <p class="text-gray-600 text-sm">Tanggal</p>
                <p class="text-lg font-semibold text-gray-800">{{ $pembayaran->tanggal_pembayaran->format('d M Y') }}</p>
            </div>

            <div class="mb-4">
                <p class="text-gray-600 text-sm">Metode</p>
                <p class="text-lg font-semibold text-gray-800">{{ $pembayaran->metode_pembayaran }}</p>
            </div>

            <div class="mb-4">
                <p class="text-gray-600 text-sm">Status</p>
                <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold
                    {{ $pembayaran->status_pembayaran == 'Lunas' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}
                ">
                    {{ $pembayaran->status_pembayaran }}
                </span>
            </div>
        </div>

        <!-- Data Booking -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold mb-4 border-b pb-3">Data Booking</h3>
            
            <div class="mb-4">
                <p class="text-gray-600 text-sm">Kode Booking</p>
                <p class="text-lg font-semibold text-gray-800">BK-{{ $pembayaran->booking_id }}</p>
            </div>

            <div class="mb-4">
                <p class="text-gray-600 text-sm">Nama Tamu</p>
                <p class="text-lg font-semibold text-gray-800">{{ $pembayaran->booking->tamu->nama_lengkap }}</p>
            </div>

            <div class="mb-4">
                <p class="text-gray-600 text-sm">Nomor Kamar</p>
                <p class="text-lg font-semibold text-gray-800">{{ $pembayaran->booking->kamar->nomor_kamar }}</p>
            </div>

            <div class="mb-4">
                <p class="text-gray-600 text-sm">Periode</p>
                <p class="text-lg font-semibold text-gray-800">{{ $pembayaran->booking->tanggal_checkin->format('d M Y') }} - {{ $pembayaran->booking->tanggal_checkout->format('d M Y') }}</p>
            </div>
        </div>

        <!-- Ringkasan Biaya -->
        <div class="lg:col-span-2 bg-blue-50 rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold mb-4 border-b pb-3">Ringkasan Biaya</h3>
            
            <div class="grid grid-cols-3 gap-4 mb-6">
                <div>
                    <p class="text-gray-600 text-sm">Harga Per Malam</p>
                    <p class="text-2xl font-bold text-blue-600">Rp {{ number_format($pembayaran->booking->kamar->tipeKamar->harga_per_malam, 0, ',', '.') }}</p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Jumlah Malam</p>
                    <p class="text-2xl font-bold text-blue-600">{{ $pembayaran->booking->lama_menginap }}</p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Total Seharusnya</p>
                    <p class="text-2xl font-bold text-blue-600">Rp {{ number_format($pembayaran->booking->total_harga, 0, ',', '.') }}</p>
                </div>
            </div>

            <div class="border-t pt-4">
                <div class="flex justify-between items-center">
                    <p class="text-lg font-semibold">Total Bayar</p>
                    <p class="text-3xl font-bold text-green-600">Rp {{ number_format($pembayaran->total_bayar, 0, ',', '.') }}</p>
                </div>
                @if($pembayaran->total_bayar < $pembayaran->booking->total_harga)
                    <div class="mt-4 p-3 bg-red-100 text-red-700 rounded">
                        Sisa Pembayaran: Rp {{ number_format($pembayaran->booking->total_harga - $pembayaran->total_bayar, 0, ',', '.') }}
                    </div>
                @elseif($pembayaran->total_bayar > $pembayaran->booking->total_harga)
                    <div class="mt-4 p-3 bg-yellow-100 text-yellow-700 rounded">
                        Kelebian Pembayaran: Rp {{ number_format($pembayaran->total_bayar - $pembayaran->booking->total_harga, 0, ',', '.') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Aksi -->
    <div class="mt-6 flex gap-4">
        <a href="{{ route('pembayaran.edit', $pembayaran) }}" class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 transition">
            <i class="fas fa-edit mr-2"></i> Edit
        </a>
        <form action="{{ route('pembayaran.destroy', $pembayaran) }}" method="POST" class="inline" onsubmit="confirmDelete(event)">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">
                <i class="fas fa-trash mr-2"></i> Hapus
            </button>
        </form>
    </div>
</div>
@endsection
