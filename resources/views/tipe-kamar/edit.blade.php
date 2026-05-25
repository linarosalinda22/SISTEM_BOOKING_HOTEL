@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto bg-white p-8 rounded-2xl shadow">

    <h1 class="text-2xl font-bold mb-6">
        Edit Tipe Kamar
    </h1>

    <form action="{{ route('tipe-kamar.update', $tipeKamar->id) }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <!-- Nama Tipe -->
        <div class="mb-4">

            <label class="block mb-2 font-medium">
                Nama Tipe
            </label>

            <input type="text"
                name="nama_tipe"
                value="{{ $tipeKamar->nama_tipe }}"
                class="w-full border rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-yellow-400">

        </div>

        <!-- Deskripsi -->
        <div class="mb-4">

            <label class="block mb-2 font-medium">
                Deskripsi
            </label>

            <textarea name="deskripsi"
                rows="4"
                class="w-full border rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-yellow-400">{{ $tipeKamar->deskripsi }}</textarea>

        </div>

        <!-- Harga -->
        <div class="mb-4">

            <label class="block mb-2 font-medium">
                Harga
            </label>

            <input type="number"
                name="harga"
                value="{{ $tipeKamar->harga }}"
                class="w-full border rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-yellow-400">

        </div>

        <!-- Kapasitas -->
        <div class="mb-4">

            <label class="block mb-2 font-medium">
                Kapasitas
            </label>

            <input type="number"
                name="kapasitas"
                value="{{ $tipeKamar->kapasitas }}"
                class="w-full border rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-yellow-400">

        </div>

        <!-- Foto Lama -->
        <div class="mb-4">

            <label class="block mb-2 font-medium">
                Foto Saat Ini
            </label>

            @if($tipeKamar->foto)

                <img src="{{ asset('storage/' . $tipeKamar->foto) }}"
                    alt="Foto Kamar"
                    class="w-40 h-40 object-cover rounded-xl border shadow mb-3">

            @else

                <p class="text-gray-500">
                    Belum ada foto
                </p>

            @endif

        </div>

        <!-- Upload Foto Baru -->
        <div class="mb-4">

            <label class="block mb-2 font-medium">
                Ganti Foto
            </label>

            <input type="file"
                name="foto"
                class="w-full border rounded-xl p-3">

        </div>

        <!-- Tombol -->
        <div class="flex gap-3 mt-6">

            <!-- Update -->
            <button type="submit"
                class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-3 rounded-xl transition">

                Update
            </button>

            <!-- Batal -->
            <a href="{{ route('tipe-kamar.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-3 rounded-xl transition">

                Batal
            </a>

        </div>

    </form>

</div>

@endsection