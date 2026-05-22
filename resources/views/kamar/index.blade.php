@extends('layouts.app')

@section('title', 'Data Kamar')

@section('content')

<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-800">
            Data Kamar
        </h1>

        <p class="text-gray-500 mt-1">
            Kelola seluruh data kamar hotel
        </p>
    </div>

    <a href="{{ route('kamar.create') }}"
        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl shadow transition">

        <i class="fas fa-plus mr-2"></i>
        Tambah Kamar
    </a>
</div>

<!-- Statistik -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">

    <div class="bg-white rounded-2xl shadow p-5 border-l-4 border-green-500">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-gray-500 text-sm">
                    Kamar Tersedia
                </p>

                <h2 class="text-3xl font-bold text-green-600 mt-2">
                    {{ $kamar->where('status_kamar', 'Tersedia')->count() }}
                </h2>
            </div>

            <div class="bg-green-100 p-4 rounded-xl">
                <i class="fas fa-bed text-green-600 text-2xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow p-5 border-l-4 border-red-500">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-gray-500 text-sm">
                    Kamar Terisi
                </p>

                <h2 class="text-3xl font-bold text-red-600 mt-2">
                    {{ $kamar->where('status_kamar', 'Terisi')->count() }}
                </h2>
            </div>

            <div class="bg-red-100 p-4 rounded-xl">
                <i class="fas fa-door-closed text-red-600 text-2xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow p-5 border-l-4 border-yellow-500">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-gray-500 text-sm">
                    Maintenance
                </p>

                <h2 class="text-3xl font-bold text-yellow-600 mt-2">
                    {{ $kamar->where('status_kamar', 'Maintenance')->count() }}
                </h2>
            </div>

            <div class="bg-yellow-100 p-4 rounded-xl">
                <i class="fas fa-tools text-yellow-600 text-2xl"></i>
            </div>
        </div>
    </div>

</div>

<!-- Table -->
<div class="bg-white rounded-2xl shadow overflow-hidden">

    <div class="p-5 border-b flex items-center justify-between">
        <h2 class="text-xl font-bold text-gray-700">
            List Data Kamar
        </h2>

        <form method="GET" class="flex items-center gap-3">

            <input type="text"
                name="search"
                placeholder="Cari nomor kamar..."
                class="border rounded-xl px-4 py-2 focus:ring focus:ring-blue-200">

            <button type="submit"
                class="bg-gray-800 hover:bg-gray-900 text-white px-4 py-2 rounded-xl">

                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>

    <div class="overflow-x-auto">

        <table class="w-full text-sm text-left">

            <thead class="bg-gray-100 text-gray-700 uppercase">
                <tr>
                    <th class="px-6 py-4">No</th>
                    <th class="px-6 py-4">Nomor Kamar</th>
                    <th class="px-6 py-4">Tipe Kamar</th>
                    <th class="px-6 py-4">Harga</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">

                @forelse($kamar as $item)

                <tr class="hover:bg-gray-50 transition">

                    <td class="px-6 py-4">
                        {{ $loop->iteration }}
                    </td>

                    <td class="px-6 py-4 font-semibold text-gray-700">
                        {{ $item->nomor_kamar }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $item->tipeKamar->nama_tipe ?? '-' }}
                    </td>

                    <td class="px-6 py-4 text-green-600 font-bold">
                        Rp {{ number_format($item->harga, 0, ',', '.') }}
                    </td>

                    <td class="px-6 py-4">

                        @if($item->status_kamar == 'Tersedia')

                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                                Tersedia
                            </span>

                        @elseif($item->status_kamar == 'Terisi')

                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-semibold">
                                Terisi
                            </span>

                        @else

                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-semibold">
                                Maintenance
                            </span>

                        @endif

                    </td>

                    <td class="px-6 py-4 text-center">

                        <div class="flex justify-center gap-2">

                            <a href="{{ route('kamar.edit', $item->id) }}"
                                class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-2 rounded-lg">

                                <i class="fas fa-edit"></i>
                            </a>

                            <form action="{{ route('kamar.destroy', $item->id) }}"
                                method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus kamar ini?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg">

                                    <i class="fas fa-trash"></i>
                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="6"
                        class="text-center py-10 text-gray-500">

                        Tidak ada data kamar
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>
</div>

@endsection