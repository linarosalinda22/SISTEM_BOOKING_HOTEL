@extends('layouts.master')

@section('title', 'Booking')

@section('content')

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<div class="flex justify-between items-center mb-6">

    <h2 class="text-2xl font-bold text-gray-800">
        Booking Kamar
    </h2>

    <div class="flex items-center gap-3">

        <!-- Tombol Kembali -->
        <a href="{{ route('dashboard') }}"
            class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">
            ← Dashboard
        </a>

        <!-- Tombol Booking -->
        <a href="{{ route('booking.create') }}"
            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
            + Booking Baru
        </a>

    </div>

</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="p-6 border-b border-gray-200">
        <form action="{{ route('booking.index') }}"
    method="GET"
    class="flex items-center gap-4">
            <input type="text" name="search" placeholder="Cari nama tamu..." value="{{ $search }}" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
            <select name="status"
            class="min-w-[180px] px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                <option value="">Semua Status</option>
                <option value="Pending" {{ $status == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Check-in" {{ $status == 'Check-in' ? 'selected' : '' }}>Check-in</option>
                <option value="Selesai" {{ $status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="Dibatalkan" {{ $status == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
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
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Check-in</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Check-out</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Total</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bookings as $booking)
                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="px-6 py-3">{{ $bookings->firstItem() + $loop->index }}</td>
                        <td class="px-6 py-3">{{ $booking->tamu->nama_lengkap }}</td>
                        <td class="px-6 py-3">{{ $booking->kamar->nomor_kamar }}</td>
                        <td class="px-6 py-3">{{ $booking->tanggal_checkin->format('d M Y') }}</td>
                        <td class="px-6 py-3">{{ $booking->tanggal_checkout->format('d M Y') }}</td>
                        <td class="px-6 py-3">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</td>
                        <td class="px-6 py-3">
                            <span class="px-3 py-1 rounded-full text-sm font-semibold
                                {{ $booking->status_booking == 'Pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                {{ $booking->status_booking == 'Check-in' ? 'bg-blue-100 text-blue-700' : '' }}
                                {{ $booking->status_booking == 'Selesai' ? 'bg-green-100 text-green-700' : '' }}
                                {{ $booking->status_booking == 'Dibatalkan' ? 'bg-red-100 text-red-700' : '' }}
                            ">
                                {{ $booking->status_booking }}
                            </span>
                        </td>
                        <td class="px-6 py-3">
                            <a href="{{ route('booking.show', $booking) }}" class="text-blue-600 hover:text-blue-700 mr-2" title="Lihat">
                                <i class="fas fa-eye"></i>
                            </a>
                            @if($booking->status_booking == 'Pending')

                                <!-- Edit -->
                                <a href="{{ route('booking.edit', $booking) }}"
                                    class="text-yellow-600 hover:text-yellow-700 mr-2"
                                    title="Edit">

                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- Hapus -->
                                <form action="{{ route('booking.destroy', $booking) }}"
                                    method="POST"
                                    class="inline"
                                    onsubmit="return confirm('Yakin ingin menghapus booking ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="text-red-600 hover:text-red-700 mr-2"
                                        title="Hapus">

                                        <i class="fas fa-trash"></i>
                                    </button>

                                </form>

                                <!-- Check-in -->
                                <form action="{{ route('booking.check-in', $booking) }}"
                                    method="POST"
                                    class="inline">

                                    @csrf

                                    <button type="submit"
                                        class="text-green-600 hover:text-green-700 mr-2"
                                        title="Check-in">

                                        <i class="fas fa-sign-in-alt"></i>
                                    </button>

                                </form>

                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-4 text-center text-gray-500">Tidak ada data booking</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="px-6 py-4 border-t border-gray-200">
        {{ $bookings->links() }}
    </div>
</div>
@endsection
