@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto bg-white p-8 rounded-2xl shadow">

    <h1 class="text-2xl font-bold mb-6">
        Edit Tipe Kamar
    </h1>

    <form action="{{ route('tipe-kamar.update', $tipeKamar->id) }}"
        method="POST">

        @csrf
        @method('PUT')

        <div class="mb-4">
            <label>Nama Tipe</label>

            <input type="text"
                name="nama_tipe"
                value="{{ $tipeKamar->nama_tipe }}"
                class="w-full border rounded-xl p-3">
        </div>

        <div class="mb-4">
            <label>Deskripsi</label>

            <textarea name="deskripsi"
                class="w-full border rounded-xl p-3">{{ $tipeKamar->deskripsi }}</textarea>
        </div>

        <div class="mb-4">
            <label>Harga</label>

            <input type="number"
                name="harga"
                value="{{ $tipeKamar->harga }}"
                class="w-full border rounded-xl p-3">
        </div>

        <div class="mb-4">
            <label>Kapasitas</label>

            <input type="number"
                name="kapasitas"
                value="{{ $tipeKamar->kapasitas }}"
                class="w-full border rounded-xl p-3">
        </div>

        <button type="submit"
            class="bg-yellow-500 text-white px-5 py-3 rounded-xl">

            Update
        </button>

    </form>

</div>

@endsection