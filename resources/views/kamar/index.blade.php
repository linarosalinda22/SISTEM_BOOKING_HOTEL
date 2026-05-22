@extends('layouts.app')

@section('title', 'Data Kamar')

@section('content')

<div class="flex justify-between items-center mb-6">

    <div>
        <h1 class="text-3xl font-bold text-gray-800">
            Data Kamar
        </h1>

        <p class="text-gray-500">
            Kelola seluruh kamar hotel
        </p>
    </div>

    <a href="{{ route('kamar.create') }}"
        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl">

        Tambah Kamar
    </a>
</div>

<div class="bg-white rounded-2xl shadow overflow-hidden">

    <table class="w-full">

        <thead class="bg-gray-100">

            <tr>
                <th class="p-4">No</th>
                <th>Nomor Kamar</th>
                <th>Tipe</th>
                <th>Harga</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>

        </thead>

        <tbody>

            @foreach($kamar as $item)

            <tr class="border-b hover:bg-gray-50">

                <td class="p-4">
                    {{ $loop->iteration }}
                </td>

                <td>
                    {{ $item->nomor_kamar }}
                </td>

                <td>
                    {{ $item->tipeKamar->nama_tipe ?? '-' }}
                </td>

                <td class="text-green-600 font-bold">
                    Rp {{ number_format($item->harga,0,',','.') }}
                </td>

                <td>

                    @if($item->status_kamar == 'Tersedia')

                        <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-sm">
                            Tersedia
                        </span>

                    @elseif($item->status_kamar == 'Terisi')

                        <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-sm">
                            Terisi
                        </span>

                    @else

                        <span class="bg-yellow-100 text-yellow-600 px-3 py-1 rounded-full text-sm">
                            Maintenance
                        </span>

                    @endif

                </td>

                <td class="flex gap-2 p-4">

                    <a href="{{ route('kamar.edit', $item->id) }}"
                        class="bg-yellow-400 text-white px-3 py-2 rounded-lg">

                        Edit
                    </a>

                    <form action="{{ route('kamar.destroy', $item->id) }}"
                        method="POST">

                        @csrf
                        @method('DELETE')

                        <button class="bg-red-500 text-white px-3 py-2 rounded-lg">
                            Hapus
                        </button>

                    </form>

                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

</div>

@endsection