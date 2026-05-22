@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto bg-white p-8 rounded-2xl shadow">

    <h1 class="text-2xl font-bold mb-6">
        Tambah Tipe Kamar
    </h1>

    <form action="{{ route('tipe-kamar.store') }}" method="POST">

        @csrf

        <div class="mb-4">
            <label>Nama Tipe</label>

            <input type="text"
                name="nama_tipe"
                class="w-full border rounded-xl p-3">
        </div>

        <div class="mb-4">
            <label>Deskripsi</label>

            <textarea name="deskripsi"
                class="w-full border rounded-xl p-3"></textarea>
        </div>

        <div class="mb-4">
            <label>Harga</label>

            <input type="number"
                name="harga"
                class="w-full border rounded-xl p-3">
        </div>

        <div class="mb-4">
            <label>Kapasitas</label>

            <input type="number"
                name="kapasitas"
                class="w-full border rounded-xl p-3">
        </div>

        <button type="submit"
            class="bg-blue-600 text-white px-5 py-3 rounded-xl">

            Simpan
        </button>

    </form>

</div>

@endsection