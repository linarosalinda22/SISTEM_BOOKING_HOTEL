@extends('layouts.app')

@section('content')

<div class="bg-white rounded-2xl shadow p-8">

    <h1 class="text-2xl font-bold mb-6">
        Tambah Kamar
    </h1>

    <form action="{{ route('kamar.store') }}" method="POST">

        @csrf

        <div class="mb-4">
            <label>Nomor Kamar</label>

            <input type="text"
                name="nomor_kamar"
                class="w-full border rounded-xl p-3">
        </div>

        <div class="mb-4">
            <label>Tipe Kamar</label>

            <select name="tipe_kamar_id"
                class="w-full border rounded-xl p-3">

                @foreach($tipeKamar as $item)

                <option value="{{ $item->id }}">
                    {{ $item->nama_tipe }}
                </option>

                @endforeach

            </select>
        </div>

        <div class="mb-4">
            <label>Harga</label>

            <input type="number"
                name="harga"
                class="w-full border rounded-xl p-3">
        </div>

        <div class="mb-4">
            <label>Status</label>

            <select name="status_kamar"
                class="w-full border rounded-xl p-3">

                <option value="Tersedia">Tersedia</option>
                <option value="Terisi">Terisi</option>
                <option value="Maintenance">Maintenance</option>

            </select>
        </div>

        <button class="bg-blue-600 text-white px-5 py-3 rounded-xl">
            Simpan
        </button>

    </form>

</div>

@endsection