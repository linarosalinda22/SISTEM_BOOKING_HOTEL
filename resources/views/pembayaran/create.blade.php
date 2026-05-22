@extends('layouts.app')

@section('title', 'Input Pembayaran')

@section('content')
<div class="max-w-2xl">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Input Pembayaran</h2>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('pembayaran.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Pilih Booking <span class="text-red-500">*</span></label>
                <select name="booking_id" id="booking_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('booking_id') border-red-500 @enderror">
                    <option value="">-- Pilih Booking --</option>
                    @foreach($bookings as $booking)
                        <option value="{{ $booking->id }}" {{ old('booking_id') == $booking->id ? 'selected' : '' }}>
                            BK-{{ $booking->id }} | {{ $booking->tamu->nama_lengkap }} | Kamar {{ $booking->kamar->nomor_kamar }} (Rp {{ number_format($booking->total_harga, 0, ',', '.') }})
                        </option>
                    @endforeach
                </select>
                @error('booking_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Tanggal Pembayaran <span class="text-red-500">*</span></label>
                <input type="date" name="tanggal_pembayaran" value="{{ old('tanggal_pembayaran', date('Y-m-d')) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('tanggal_pembayaran') border-red-500 @enderror">
                @error('tanggal_pembayaran') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Metode Pembayaran <span class="text-red-500">*</span></label>
                    <select name="metode_pembayaran" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('metode_pembayaran') border-red-500 @enderror">
                        <option value="">Pilih Metode</option>
                        <option value="Transfer Bank" {{ old('metode_pembayaran') == 'Transfer Bank' ? 'selected' : '' }}>Transfer Bank</option>
                        <option value="Cash" {{ old('metode_pembayaran') == 'Cash' ? 'selected' : '' }}>Cash</option>
                        <option value="E-Wallet" {{ old('metode_pembayaran') == 'E-Wallet' ? 'selected' : '' }}>E-Wallet</option>
                    </select>
                    @error('metode_pembayaran') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Status Pembayaran <span class="text-red-500">*</span></label>
                    <select name="status_pembayaran" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('status_pembayaran') border-red-500 @enderror">
                        <option value="Belum Lunas" {{ old('status_pembayaran') == 'Belum Lunas' ? 'selected' : '' }}>Belum Lunas</option>
                        <option value="Lunas" {{ old('status_pembayaran') == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                    </select>
                    @error('status_pembayaran') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Total Bayar <span class="text-red-500">*</span></label>
                <input type="number" name="total_bayar" value="{{ old('total_bayar') }}" step="1000" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('total_bayar') border-red-500 @enderror">
                @error('total_bayar') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                    <i class="fas fa-save mr-2"></i> Simpan
                </button>
                <a href="{{ route('pembayaran.index') }}" class="bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition">
                    <i class="fas fa-times mr-2"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('booking_id').addEventListener('change', function() {
        const option = this.options[this.selectedIndex];
        const text = option.text;
        const amountMatch = text.match(/Rp ([\d.]+)/);
        if (amountMatch) {
            const amount = parseInt(amountMatch[1].replace(/\./g, ''));
            document.querySelector('input[name="total_bayar"]').value = amount;
        }
    });
</script>
@endsection
