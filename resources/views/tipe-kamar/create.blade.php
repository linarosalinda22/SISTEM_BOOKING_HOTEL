@extends('layouts.master')

@section('content')

<div class="max-w-3xl mx-auto bg-white p-8 rounded-2xl shadow">

    <h1 class="text-2xl font-bold mb-6">
        Tambah Tipe Kamar
    </h1>

    <form action="{{ route('tipe-kamar.store') }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf

        <!-- Nama Tipe -->
        <div class="mb-4">

            <label class="block mb-2 font-medium">
                Nama Tipe <span class="text-red-500">*</span>
            </label>

            <input type="text"
                name="nama_tipe"
                class="w-full border rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-blue-400">

        </div>

        <!-- Deskripsi -->
        <div class="mb-4">

            <label class="block mb-2 font-medium">
                Deskripsi <span class="text-red-500">*</span>
            </label>

            <textarea name="deskripsi"
                rows="4"
                class="w-full border rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-blue-400"></textarea>

        </div>

        <!-- Harga -->
        <div class="mb-4">

            <label class="block mb-2 font-medium">
                Harga <span class="text-red-500">*</span>
            </label>

            <input type="number"
                name="harga"
                class="w-full border rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-blue-400">

        </div>

        <!-- Kapasitas -->
        <div class="mb-4">

            <label class="block mb-2 font-medium">
                Kapasitas <span class="text-red-500">*</span>
            </label>

            <input type="number"
                name="kapasitas"
                class="w-full border rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-blue-400">

        </div>

        <!-- Foto -->
        <div class="mb-4">

            <label class="block mb-2 font-medium">
                Foto Kamar <span class="text-red-500">*</span>
            </label>

            <input type="file"
                name="foto"
                class="w-full border rounded-xl p-3">

        </div>

        <!-- Tombol -->
        <div class="flex gap-3 mt-6">

            <!-- Simpan -->
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl transition">

                Simpan
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