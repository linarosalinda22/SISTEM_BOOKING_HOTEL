@extends('layouts.app')

@section('content')

<div class="bg-white rounded-2xl shadow p-8">

    <h1 class="text-2xl font-bold mb-6">
        Tambah Kamar
    </h1>

    <form action="{{ route('kamar.store') }}" method="POST">

        @csrf

        <!-- Nomor Kamar -->
        <div class="mb-4">

            <label class="block mb-2 font-medium">
                Nomor Kamar
                <span class="text-red-500">*</span>
            </label>

            <input type="text"
                name="nomor_kamar"
                required
                class="w-full border rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-blue-400">

        </div>

        <!-- Tipe Kamar -->
        <div class="mb-4">

            <label class="block mb-2 font-medium">
                Tipe Kamar
                <span class="text-red-500">*</span>
            </label>

            <select name="tipe_kamar_id"
                id="tipe_kamar_id"
                required
                class="w-full border rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-blue-400">

                <option value="">
                    -- Pilih Tipe Kamar --
                </option>

                @foreach($tipeKamar as $item)

                <option value="{{ $item->id }}"
                    data-harga="{{ $item->harga }}">

                    {{ $item->nama_tipe }}
                </option>

                @endforeach

            </select>

        </div>

        <!-- Harga -->
        <div class="mb-4">

            <label class="block mb-2 font-medium">
                Harga
                <span class="text-red-500">*</span>
            </label>

            <input type="number"
            name="harga"
            id="harga"
            readonly
            required
            class="w-full border rounded-xl p-3 bg-gray-100 focus:outline-none">

        </div>

        <!-- Status -->
        <div class="mb-4">

            <label class="block mb-2 font-medium">
                Status
                <span class="text-red-500">*</span>
            </label>

            <select name="status_kamar"
                required
                class="w-full border rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-blue-400">

                <option value="Tersedia">Tersedia</option>
                <option value="Terisi">Terisi</option>
                <option value="Maintenance">Maintenance</option>

            </select>

        </div>

        <!-- Tombol -->
        <div class="flex gap-3 mt-6">

            <!-- Simpan -->
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl transition">

                Simpan
            </button>

            <!-- Batal -->
            <a href="{{ route('kamar.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-3 rounded-xl transition">

                Batal
            </a>

        </div>

    </form>

</div>
<script>

    const tipeKamar = document.getElementById('tipe_kamar_id');
    const harga = document.getElementById('harga');

    tipeKamar.addEventListener('change', function () {

        const selectedOption = this.options[this.selectedIndex];
        const hargaKamar = selectedOption.getAttribute('data-harga');

        harga.value = hargaKamar ?? '';

    });

</script>

@endsection