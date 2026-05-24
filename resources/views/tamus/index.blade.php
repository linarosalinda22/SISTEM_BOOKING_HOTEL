@extends('layouts.master')

@section('title', 'Data Tamu')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div class="flex items-center gap-4">
        <div class="bg-brand-50 p-3.5 rounded-xl text-brand-700 shadow-inner hidden sm:block">
            <i class="fas fa-users text-3xl"></i>
        </div>
        <div>
            <div class="flex items-center gap-2">
                <a href="/dashboard" class="text-slate-400 hover:text-brand-700 transition text-sm font-medium flex items-center gap-1">
                    Dashboard
                </a>
                <span class="text-slate-300 text-sm">/</span>
                <span class="text-slate-800 text-sm font-semibold">Data Tamu</span>
            </div>
            <h2 class="text-2xl font-bold text-slate-800 tracking-tight mt-1">
                Manajemen Data Tamu
            </h2>
            <p class="text-slate-500 text-xs mt-0.5">
                Kelola, cari, dan lihat profil detail seluruh tamu hotel.
            </p>
        </div>
    </div>

    <div class="flex items-center gap-3 self-end sm:self-center">
        <a href="/dashboard" class="bg-white border border-slate-200 text-slate-600 px-4 py-2.5 rounded-xl hover:bg-slate-50 hover:text-slate-800 font-medium text-sm transition shadow-sm flex items-center gap-2">
            <i class="fas fa-arrow-left text-xs"></i> 
            <span>Dashboard</span>
        </a>

        <a href="{{ route('tamus.create') }}" class="bg-brand-700 hover:bg-brand-900 text-white px-4 py-2.5 rounded-xl font-medium text-sm transition shadow-md flex items-center gap-2">
            <i class="fas fa-plus text-xs"></i> 
            <span>Tambah Tamu</span>
        </a>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="p-6 border-b border-slate-100 bg-slate-50/50">
        <form action="{{ route('tamus.index') }}" method="GET" class="flex gap-3">
            <div class="relative flex-1">
                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                    <i class="fas fa-search"></i>
                </span>
                <input type="text" name="search" placeholder="Cari nama, email, atau nomor identitas..." value="{{ $search }}" 
                    class="w-full pl-11 pr-4 py-2.5 bg-white border border-slate-200 rounded-xl focus:outline-none focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 text-sm transition">
            </div>
            <button type="submit" class="bg-brand-700 text-white px-6 py-2.5 rounded-xl hover:bg-brand-900 font-medium transition shadow-sm flex items-center">
                Cari
            </button>
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full whitespace-nowrap">
            <thead class="bg-brand-50/60 border-b border-slate-100">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-brand-900 w-16">No.</th>
                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-brand-900">Nama Lengkap</th>
                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-brand-900">Email</th>
                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-brand-900">No. Telepon</th>
                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-brand-900">Jenis Kelamin</th>
                    <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-brand-900 w-32">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                @forelse ($tamuses as $tamu)
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="px-6 py-4 font-medium text-slate-400">{{ $tamuses->firstItem() + $loop->index }}</td>
                        <td class="px-6 py-4 font-semibold text-slate-800">{{ $tamu->nama_lengkap }}</td>
                        <td class="px-6 py-4 text-slate-600">{{ $tamu->email }}</td>
                        <td class="px-6 py-4 font-mono text-slate-600">{{ $tamu->no_telepon }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $tamu->jenis_kelamin == 'Laki-laki' ? 'bg-brand-50 text-brand-700 border border-brand-200/50' : 'bg-rose-50 text-rose-600 border border-rose-100' }}">
                                {{ $tamu->jenis_kelamin }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-3">
                                <a href="{{ route('tamus.show', $tamu) }}" class="p-2 text-slate-400 hover:text-brand-700 hover:bg-brand-50 rounded-lg transition" title="Detail">
                                    <i class="fas fa-eye text-base"></i>
                                </a>
                                <a href="{{ route('tamus.edit', $tamu) }}" class="p-2 text-slate-400 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition" title="Edit">
                                    <i class="fas fa-edit text-base"></i>
                                </a>
                                
                                <form action="{{ route('tamus.destroy', $tamu) }}" method="POST" class="inline" id="delete-form-{{ $tamu->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDelete('{{ $tamu->id }}', '{{ $tamu->nama_lengkap }}')" class="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition" title="Hapus">
                                        <i class="fas fa-trash text-base"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center text-slate-400 gap-2">
                                <i class="fas fa-users text-4xl text-slate-300"></i>
                                <p class="text-base font-medium">Tidak ada data tamu ditemukan</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($tamuses->hasPages())
    <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/30">
        {{ $tamuses->links() }}
    </div>
    @endif
</div>

<script>
    function confirmDelete(id, namaTamu) {
        Swal.fire({
            title: 'Hapus Data Tamu?',
            text: `Apakah Anda yakin ingin menghapus data dari "${namaTamu}"? Tindakan ini tidak dapat dibatalkan.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#08519C', 
            cancelButtonColor: '#64748B',  
            confirmButtonText: '<i class="fas fa-trash mr-1"></i> Ya, Hapus!',
            cancelButtonText: 'Batal',
            background: '#ffffff',
            customClass: {
                popup: 'rounded-2xl border border-slate-100 shadow-xl',
                title: 'text-slate-800 font-bold tracking-tight text-xl pt-4',
                htmlContainer: 'text-slate-500 text-sm px-3'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
@endsection