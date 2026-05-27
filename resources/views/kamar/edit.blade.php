@extends('layouts.app')

@section('title', 'Edit Kamar')

@section('content')

<div class="max-w-4xl mx-auto">

    <!-- Header -->
    <div class="flex items-center justify-between mb-6">

        <div>
            <h1 class="text-3xl font-bold text-gray-800">
                Edit Data Kamar
            </h1>

            <p class="text-gray-500 mt-1">
                Update informasi kamar hotel
            </p>
        </div>
    </div>

    <!-- Card -->
    <div class="bg-white rounded-2xl shadow-lg p-8">

        <!-- Error -->
        @if ($errors->any())

            <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-xl mb-6">

                <ul class="list-disc pl-5">

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <!-- Form -->
        <form action="{{ route('kamar.update', $kamar->id) }}"
            method="POST">

            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Nomor Kamar -->
                <div>

                    <label class="block text-gray-700 font-semibold mb-2">
                        Nomor Kamar
                    </label>

                    <input type="text"
                        name="nomor_kamar"
                        value="{{ old('nomor_kamar', $kamar->nomor_kamar) }}"
                        class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                        placeholder="Masukkan nomor kamar">

                </div>

                <!-- Tipe Kamar -->
                <div>

                    <label class="block text-gray-700 font-semibold mb-2">
                        Tipe Kamar
                    </label>

                    <select name="tipe_kamar_id"
                        class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-blue-400 focus:outline-none">

                        @foreach($tipeKamar as $item)

                            <option value="{{ $item->id }}"
                                {{ $kamar->tipe_kamar_id == $item->id ? 'selected' : '' }}>

                                {{ $item->nama_tipe }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <!-- Harga -->
                <div>

                    <label class="block text-gray-700 font-semibold mb-2">
                        Harga
                    </label>

                    <input type="number"
                        name="harga"
                        value="{{ old('harga', $kamar->harga) }}"
                        class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                        placeholder="Masukkan harga kamar">

                </div>

                <!-- Status -->
                <div>

                    <label class="block text-gray-700 font-semibold mb-2">
                        Status Kamar
                    </label>

                    <select name="status_kamar"
                        class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-blue-400 focus:outline-none">

                        <option value="Tersedia"
                            {{ $kamar->status_kamar == 'Tersedia' ? 'selected' : '' }}>

                            Tersedia

                        </option>

                        <option value="Terisi"
                            {{ $kamar->status_kamar == 'Terisi' ? 'selected' : '' }}>

                            Terisi

                        </option>

                        <option value="Maintenance"
                            {{ $kamar->status_kamar == 'Maintenance' ? 'selected' : '' }}>

                            Maintenance

                        </option>

                    </select>

                </div>

            </div>

            <!-- Tombol -->
            <div class="flex justify-end gap-4 mt-8">

                <a href="{{ route('kamar.index') }}"
                    class="bg-gray-400 hover:bg-gray-500 text-white px-6 py-3 rounded-xl transition">

                    Batal
                </a>

                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl transition">

                    <i class="fas fa-save mr-2"></i>
                    Update Data
                </button>

            </div>

        </form>

    </div>

</div>

@endsection