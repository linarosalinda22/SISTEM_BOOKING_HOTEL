@extends('layouts.master')

@section('title', 'Tipe Kamar')

@section('content')

<div class="p-8">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-slate-800">
            Tipe Kamar
        </h2>

        <a href="{{ route('tipe-kamar.create') }}"
            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg transition font-medium shadow">
            <i class="fas fa-plus mr-2"></i>
            Tambah Tipe Kamar
        </a>
    </div>

    <!-- Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">

        <!-- Search -->
        <div class="p-6 border-b border-slate-200">
            <form action="{{ route('tipe-kamar.index') }}" method="GET" class="flex gap-4">

                <input type="text"
                    name="search"
                    placeholder="Cari nama tipe kamar..."
                    value="{{ $search }}"
                    class="flex-1 px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">

                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg transition">
                    <i class="fas fa-search"></i>
                </button>

            </form>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-slate-100 border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">
                            No.
                        </th>

                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">
                            Nama Tipe
                        </th>

                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">
                            Harga/Malam
                        </th>

                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">
                            Kapasitas
                        </th>

                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">
                            Foto
                        </th>

                        <th class="px-6 py-4 text-center text-sm font-semibold text-slate-700">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($tipeKamars as $tipeKamar)

                        <tr class="border-b border-slate-200 hover:bg-slate-50 transition">

                            <td class="px-6 py-4">
                                {{ $tipeKamars->firstItem() + $loop->index }}
                            </td>

                            <td class="px-6 py-4 font-medium text-slate-700">
                                {{ $tipeKamar->nama_tipe }}
                            </td>

                            <td class="px-6 py-4">
                                Rp {{ number_format($tipeKamar->harga, 0, ',', '.') }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $tipeKamar->kapasitas }} Orang
                            </td>

                            <td class="px-6 py-4">

                                @if($tipeKamar->foto)

                                    <img src="{{ asset('storage/' . $tipeKamar->foto) }}"
                                        alt="Foto"
                                        class="w-14 h-14 object-cover rounded-lg border">

                                @else

                                    <span class="text-slate-400">
                                        -
                                    </span>

                                @endif

                            </td>

                            <!-- AKSI -->
                            <td class="px-6 py-4">

                                <div class="flex items-center justify-center gap-3">
                                  
                                    <!-- Edit -->
                                    <a href="{{ route('tipe-kamar.edit', $tipeKamar->id) }}"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white w-9 h-9 rounded-lg flex items-center justify-center transition shadow">

                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <!-- Hapus -->
                                    <form action="{{ route('tipe-kamar.destroy', $tipeKamar->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white w-9 h-9 rounded-lg flex items-center justify-center transition shadow">

                                            <i class="fas fa-trash"></i>
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6"
                                class="px-6 py-6 text-center text-slate-500">

                                Tidak ada data tipe kamar

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-slate-200">
            {{ $tipeKamars->links() }}
        </div>

    </div>

</div>

@endsection