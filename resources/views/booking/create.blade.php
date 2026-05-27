@extends('layouts.app')

@section('title', 'Buat Booking Baru')

@section('content')
<div class="max-w-3xl">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Buat Booking Baru</h2>

    <div class="bg-white rounded-lg shadow p-6">
    @if ($errors->any())
    <div id="error-alert"
        class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4 flex justify-between items-center">

        <div>
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

        <button type="button"
            onclick="document.getElementById('error-alert').style.display='none'"
            class="ml-4 text-red-700 font-bold text-xl">

            &times;
        </button>

    </div>
@endif
        <form action="{{ route('booking.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Pilih Tamu <span class="text-red-500">*</span></label>
                <select name="tamu_id" id="tamu_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('tamu_id') border-red-500 @enderror">
                    <option value="">-- Pilih Tamu --</option>
                    @foreach($tamuses as $tamu)
                        <option value="{{ $tamu->id }}" {{ old('tamu_id') == $tamu->id ? 'selected' : '' }}>
                            {{ $tamu->nama_lengkap }} ({{ $tamu->email }})
                        </option>
                    @endforeach
                </select>
                @error('tamu_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Tanggal Check-in <span class="text-red-500">*</span></label>
                    <input type="date" name="tanggal_checkin" id="tanggal_checkin" value="{{ old('tanggal_checkin') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('tanggal_checkin') border-red-500 @enderror">
                    @error('tanggal_checkin') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Tanggal Check-out <span class="text-red-500">*</span></label>
                    <input type="date" name="tanggal_checkout" id="tanggal_checkout" value="{{ old('tanggal_checkout') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('tanggal_checkout') border-red-500 @enderror">
                    @error('tanggal_checkout') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Pilih Kamar <span class="text-red-500">*</span></label>
                <select name="kamar_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('kamar_id') border-red-500 @enderror">
                    <option value="">-- Pilih Kamar --</option>
                    @foreach($kamars as $kamar)
                        <option value="{{ $kamar->id }}" {{ old('kamar_id') == $kamar->id ? 'selected' : '' }}>
                            Kamar {{ $kamar->nomor_kamar }} ({{ $kamar->tipeKamar->nama_tipe }}) - Rp {{ number_format($kamar->tipeKamar->harga, 0, ',', '.') }}/malam
                        </option>
                    @endforeach
                </select>
                @error('kamar_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="bg-blue-50 p-4 rounded-lg mb-6">
                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <p class="text-gray-600 text-sm">Lama Menginap</p>
                        <p class="text-xl font-semibold text-blue-600" id="lama_menginap">0 hari</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Harga Per Malam</p>
                        <p class="text-xl font-semibold text-blue-600" id="harga_per_malam">Rp 0</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Total Harga</p>
                        <p class="text-2xl font-bold text-blue-600" id="total_harga">Rp 0</p>
                    </div>
                </div>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                    <i class="fas fa-save mr-2"></i> Buat Booking
                </button>
                <a href="{{ route('booking.index') }}" class="bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition">
                    <i class="fas fa-times mr-2"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    const kamarSelect = document.querySelector('select[name="kamar_id"]');
    const checkinInput = document.getElementById('tanggal_checkin');
    const checkoutInput = document.getElementById('tanggal_checkout');

    function calculatePrice() {
        const kamarId = kamarSelect.value;
        if (!kamarId || !checkinInput.value || !checkoutInput.value) return;

        const checkin = new Date(checkinInput.value);
        const checkout = new Date(checkoutInput.value);
        const days = Math.ceil((checkout - checkin) / (1000 * 60 * 60 * 24));

        document.getElementById('lama_menginap').textContent = days + ' hari';

        const option = kamarSelect.options[kamarSelect.selectedIndex];
        const text = option.text;
        const priceMatch = text.match(/Rp ([\d.]+)/);
        if (priceMatch) {
            const pricePerNight = parseInt(priceMatch[1].replace(/\./g, ''));
            document.getElementById('harga_per_malam').textContent = 'Rp ' + pricePerNight.toLocaleString('id-ID');
            const total = pricePerNight * days;
            document.getElementById('total_harga').textContent = 'Rp ' + total.toLocaleString('id-ID');
        }
    }

    kamarSelect.addEventListener('change', calculatePrice);
    checkinInput.addEventListener('change', calculatePrice);
    checkoutInput.addEventListener('change', calculatePrice);
</script>
@endsection
