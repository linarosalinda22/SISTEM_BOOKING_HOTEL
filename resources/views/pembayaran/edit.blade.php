@extends('layouts.master')

@section('title', 'Edit Pembayaran')

@section('content')
<div class="max-w-2xl">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Pembayaran</h2>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('pembayaran.update', $pembayaran) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Booking</label>
                <p class="text-lg font-semibold text-gray-800">BK-{{ $pembayaran->booking_id }} | {{ $pembayaran->booking->tamu->nama_lengkap }} | Kamar {{ $pembayaran->booking->kamar->nomor_kamar }}</p>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Tanggal Pembayaran <span class="text-red-500">*</span></label>
                <input type="date" name="tanggal_pembayaran" value="{{ old('tanggal_pembayaran', $pembayaran->tanggal_pembayaran->format('Y-m-d')) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('tanggal_pembayaran') border-red-500 @enderror">
                @error('tanggal_pembayaran') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Metode Pembayaran <span class="text-red-500">*</span></label>
                    <select name="metode_pembayaran" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('metode_pembayaran') border-red-500 @enderror">
                        <option value="Transfer Bank" {{ old('metode_pembayaran', $pembayaran->metode_pembayaran) == 'Transfer Bank' ? 'selected' : '' }}>Transfer Bank</option>
                        <option value="Cash" {{ old('metode_pembayaran', $pembayaran->metode_pembayaran) == 'Cash' ? 'selected' : '' }}>Cash</option>
                        <option value="E-Wallet" {{ old('metode_pembayaran', $pembayaran->metode_pembayaran) == 'E-Wallet' ? 'selected' : '' }}>E-Wallet</option>
                    </select>
                    @error('metode_pembayaran') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Status Pembayaran <span class="text-red-500">*</span></label>
                    <select name="status_pembayaran" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('status_pembayaran') border-red-500 @enderror">
                        <option value="Belum Lunas" {{ old('status_pembayaran', $pembayaran->status_pembayaran) == 'Belum Lunas' ? 'selected' : '' }}>Belum Lunas</option>
                        <option value="Lunas" {{ old('status_pembayaran', $pembayaran->status_pembayaran) == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                    </select>
                    @error('status_pembayaran') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Total Bayar <span class="text-red-500">*</span></label>
                <input type="number" name="total_bayar" value="{{ old('total_bayar', $pembayaran->total_bayar) }}" step="1000" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('total_bayar') border-red-500 @enderror">
                @error('total_bayar') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                    <i class="fas fa-save mr-2"></i> Perbarui
                </button>
                <a href="{{ route('pembayaran.index') }}" class="bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition">
                    <i class="fas fa-times mr-2"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
