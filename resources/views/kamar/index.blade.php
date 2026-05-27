@extends('layouts.app')

@section('title', 'Data Kamar')

@section('content')
<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<div class="p-6">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">

        <div>
            <h1 class="text-3xl font-bold text-gray-800">
                Data Kamar
            </h1>

            <p class="text-gray-500 mt-1">
                Kelola seluruh kamar hotel
            </p>
        </div>

        <div class="flex items-center gap-3">

            <!-- Tombol Kembali -->
            <a href="{{ route('dashboard') }}"
            class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-3 rounded-lg transition font-medium shadow">

            <i class="fas fa-arrow-left mr-2"></i>
            Dashboard
        </a>

            <!-- Tombol Tambah -->
            <a href="{{ route('kamar.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl transition shadow flex items-center gap-2">

                <i class="fas fa-plus"></i>
                Tambah Kamar
            </a>

        </div>

    </div>

    <!-- Card Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">

        <!-- Search -->
        <div class="p-6 border-b border-gray-200">

            <form action="{{ route('kamar.index') }}"
                method="GET"
                class="flex gap-3">

                <!-- Input Search -->
                <input type="text"
                    name="search"
                    placeholder="Cari nomor kamar atau tipe kamar..."
                    value="{{ request('search') }}"
                    class="flex-1 px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">

                <!-- Tombol Search -->
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl transition shadow flex items-center justify-center">

                    <i class="fas fa-search"></i>

                </button>

            </form>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full">

                <!-- Head -->
                <thead class="bg-gray-100 border-b border-gray-200">

                    <tr>

                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">
                            No
                        </th>

                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">
                            Nomor Kamar
                        </th>

                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">
                            Tipe
                        </th>

                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">
                            Harga
                        </th>

                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">
                            Status
                        </th>

                        <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <!-- Body -->
                <tbody>

                    @forelse($kamar as $item)

                    <tr class="border-b border-gray-200 hover:bg-gray-50 transition">

                        <!-- No -->
                        <td class="px-6 py-4">
                            {{ $loop->iteration }}
                        </td>

                        <!-- Nomor -->
                        <td class="px-6 py-4 font-medium text-gray-700">
                            {{ $item->nomor_kamar }}
                        </td>

                        <!-- Tipe -->
                        <td class="px-6 py-4">
                            {{ $item->tipeKamar->nama_tipe ?? '-' }}
                        </td>

                        <!-- Harga -->
                        <td class="px-6 py-4 font-semibold text-green-600">
                            Rp {{ number_format($item->harga,0,',','.') }}
                        </td>

                        <!-- Status -->
                        <td class="px-6 py-4">

                            @if($item->status_kamar == 'Tersedia')

                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-medium">
                                    Tersedia
                                </span>

                            @elseif($item->status_kamar == 'Terisi')

                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-medium">
                                    Terisi
                                </span>

                            @else

                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-medium">
                                    Maintenance
                                </span>

                            @endif

                        </td>

                        <!-- Aksi -->
                        <td class="px-6 py-4">

                            <div class="flex items-center justify-center gap-2">

                        <!-- Edit -->
                        <a href="{{ route('kamar.edit', $item->id) }}"
                            class="w-10 h-10 bg-yellow-500 hover:bg-yellow-600 rounded-xl flex items-center justify-center text-white shadow transition">

                            <i class="fas fa-edit"></i>
                        </a>

                        <!-- Hapus -->
                        <form action="{{ route('kamar.destroy', $item->id) }}"
                            method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus data kamar ini?')">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="w-10 h-10 bg-red-500 hover:bg-red-600 rounded-xl flex items-center justify-center text-white shadow transition">

                                <i class="fas fa-trash"></i>
                            </button>

                        </form>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="6"
                            class="px-6 py-6 text-center text-gray-500">

                            Tidak ada data kamar

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection