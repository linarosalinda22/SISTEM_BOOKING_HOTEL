@extends('layouts.master')

@section('title', 'Detail Booking')

@section('content')
<div class="max-w-3xl">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Detail Booking</h2>
        <a href="{{ route('booking.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Data Booking -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold mb-4 border-b pb-3">Data Booking</h3>

            <div class="mb-4">
                <p class="text-gray-600 text-sm">Kode Booking</p>
                <p class="text-lg font-semibold text-gray-800">BK-{{ $booking->id }}</p>
            </div>

            <div class="mb-4">
                <p class="text-gray-600 text-sm">Status</p>
                <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold
                    {{ $booking->status_booking == 'Pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                    {{ $booking->status_booking == 'Check-in' ? 'bg-blue-100 text-blue-700' : '' }}
                    {{ $booking->status_booking == 'Selesai' ? 'bg-green-100 text-green-700' : '' }}
                    {{ $booking->status_booking == 'Dibatalkan' ? 'bg-red-100 text-red-700' : '' }}
                ">
                    {{ $booking->status_booking }}
                </span>
            </div>

            <div class="mb-4">
                <p class="text-gray-600 text-sm">Dibuat</p>
                <p class="text-lg font-semibold text-gray-800">{{ $booking->created_at->format('d M Y H:i') }}</p>
            </div>
        </div>

        <!-- Data Tamu -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold mb-4 border-b pb-3">Data Tamu</h3>

            <div class="mb-4">
                <p class="text-gray-600 text-sm">Nama</p>
                <p class="text-lg font-semibold text-gray-800">{{ $booking->tamu->nama_lengkap }}</p>
            </div>

            <div class="mb-4">
                <p class="text-gray-600 text-sm">Email</p>
                <p class="text-lg font-semibold text-gray-800">{{ $booking->tamu->email }}</p>
            </div>

            <div class="mb-4">
                <p class="text-gray-600 text-sm">No. Telepon</p>
                <p class="text-lg font-semibold text-gray-800">{{ $booking->tamu->no_telepon }}</p>
            </div>
        </div>

        <!-- Data Kamar -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold mb-4 border-b pb-3">Data Kamar</h3>

            <div class="mb-4">
                <p class="text-gray-600 text-sm">Nomor Kamar</p>
                <p class="text-lg font-semibold text-gray-800">{{ $booking->kamar->nomor_kamar }}</p>
            </div>

            <div class="mb-4">
                <p class="text-gray-600 text-sm">Tipe Kamar</p>
                <p class="text-lg font-semibold text-gray-800">{{ $booking->kamar->tipeKamar->nama_tipe }}</p>
            </div>

            <div class="mb-4">
                <p class="text-gray-600 text-sm">Lantai</p>
                <p class="text-lg font-semibold text-gray-800">{{ $booking->kamar->lantai }}</p>
            </div>
        </div>

        <!-- Data Menginap -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold mb-4 border-b pb-3">Data Menginap</h3>

            <div class="mb-4">
                <p class="text-gray-600 text-sm">Check-in</p>
                <p class="text-lg font-semibold text-gray-800">{{ $booking->tanggal_checkin->format('d M Y') }}</p>
            </div>

            <div class="mb-4">
                <p class="text-gray-600 text-sm">Check-out</p>
                <p class="text-lg font-semibold text-gray-800">{{ $booking->tanggal_checkout->format('d M Y') }}</p>
            </div>

            <div class="mb-4">
                <p class="text-gray-600 text-sm">Lama Menginap</p>
                <p class="text-lg font-semibold text-gray-800">{{ $booking->lama_menginap }} hari</p>
            </div>
        </div>

        <!-- Data Harga -->
        <div class="bg-blue-50 rounded-lg shadow p-6 lg:col-span-2">
            <h3 class="text-lg font-semibold mb-4 border-b pb-3">Ringkasan Biaya</h3>

            <div class="grid grid-cols-3 gap-4">
                <div>
                    <p class="text-gray-600 text-sm">Harga Per Malam</p>
                    <p class="text-2xl font-bold text-blue-600">Rp {{ number_format($booking->kamar->tipeKamar->harga_per_malam, 0, ',', '.') }}</p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Jumlah Malam</p>
                    <p class="text-2xl font-bold text-blue-600">{{ $booking->lama_menginap }}</p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Total Harga</p>
                    <p class="text-2xl font-bold text-blue-600">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</p>
                </div>
            </div>

            @if($booking->pembayaran)
                <div class="mt-4 pt-4 border-t">
                    <p class="text-gray-600 text-sm">Status Pembayaran</p>
                    <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold
                        {{ $booking->pembayaran->status_pembayaran == 'Lunas' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}
                    ">
                        {{ $booking->pembayaran->status_pembayaran }}
                    </span>
                </div>
            @endif
        </div>
    </div>

    <!-- Aksi -->
    <div class="mt-6 flex gap-4">
        @if($booking->status_booking == 'Pending')
            <a href="{{ route('booking.edit', $booking) }}" class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 transition">
                <i class="fas fa-edit mr-2"></i> Edit
            </a>
            <form action="{{ route('booking.check-in', $booking) }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                    <i class="fas fa-sign-in-alt mr-2"></i> Check-in
                </button>
            </form>
            <form action="{{ route('booking.destroy', $booking) }}" method="POST" class="inline" onsubmit="confirmDelete(event)">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">
                    <i class="fas fa-trash mr-2"></i> Batalkan
                </button>
            </form>
        @elseif($booking->status_booking == 'Check-in')
            <form action="{{ route('booking.check-out', $booking) }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition">
                    <i class="fas fa-sign-out-alt mr-2"></i> Check-out
                </button>
            </form>
        @endif
    </div>
</div>

<script>
    function confirmDelete(event) {
        if (!confirm('Apakah Anda yakin ingin membatalkan booking ini?')) {
            event.preventDefault();
        }
    }
</script>
@endsection
