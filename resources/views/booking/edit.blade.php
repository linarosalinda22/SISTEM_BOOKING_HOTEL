@extends('layouts.master')

@section('title', 'Edit Booking')

@section('content')
<div class="max-w-3xl">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Booking</h2>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('booking.update', $booking) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Pilih Tamu <span class="text-red-500">*</span></label>
                <select name="tamu_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('tamu_id') border-red-500 @enderror">
                    @foreach($tamuses as $tamu)
                        <option value="{{ $tamu->id }}" {{ old('tamu_id', $booking->tamu_id) == $tamu->id ? 'selected' : '' }}>
                            {{ $tamu->nama_lengkap }}
                        </option>
                    @endforeach
                </select>
                @error('tamu_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Tanggal Check-in <span class="text-red-500">*</span></label>
                    <input type="date" name="tanggal_checkin" value="{{ old('tanggal_checkin', $booking->tanggal_checkin->format('Y-m-d')) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('tanggal_checkin') border-red-500 @enderror">
                    @error('tanggal_checkin') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Tanggal Check-out <span class="text-red-500">*</span></label>
                    <input type="date" name="tanggal_checkout" value="{{ old('tanggal_checkout', $booking->tanggal_checkout->format('Y-m-d')) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('tanggal_checkout') border-red-500 @enderror">
                    @error('tanggal_checkout') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Pilih Kamar <span class="text-red-500">*</span></label>
                <select name="kamar_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('kamar_id') border-red-500 @enderror">
                    @foreach($kamars as $kamar)
                        <option value="{{ $kamar->id }}" {{ old('kamar_id', $booking->kamar_id) == $kamar->id ? 'selected' : '' }}>
                            Kamar {{ $kamar->nomor_kamar }} ({{ $kamar->tipeKamar->nama_tipe }})
                        </option>
                    @endforeach
                </select>
                @error('kamar_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                    <i class="fas fa-save mr-2"></i> Perbarui
                </button>
                <a href="{{ route('booking.index') }}" class="bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition">
                    <i class="fas fa-times mr-2"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
