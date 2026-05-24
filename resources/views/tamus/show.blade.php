@extends('layouts.master')

@section('title', 'Detail Tamu')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-3xl font-bold text-slate-800 tracking-tight">Detail Data Tamu</h2>
            <p class="text-slate-500 text-sm mt-1">Informasi lengkap mengenai profil tamu</p>
        </div>
        <a href="{{ route('tamus.index') }}" class="bg-white border border-slate-200 text-slate-700 px-4 py-2.5 rounded-xl hover:bg-slate-50 font-medium transition shadow-sm flex items-center gap-2">
            <i class="fas fa-arrow-left text-xs"></i> Kembali
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-6 bg-gradient-to-r from-brand-900 to-brand-700 text-white flex items-center gap-5">
            <div class="w-16 h-16 bg-white/10 rounded-2xl flex items-center justify-center border border-white/20 shadow-inner">
                <i class="fas fa-user text-3xl text-brand-100"></i>
            </div>
            <div>
                <h3 class="text-xl font-bold tracking-wide">{{ $tamu->nama_lengkap }}</h3>
                <p class="text-xs text-brand-200 mt-1 flex items-center gap-1.5">
                    <i class="fas fa-calendar-alt"></i> Terdaftar Sejak: {{ $tamu->created_at->format('d M Y, H:i') }}
                </p>
            </div>
        </div>

        <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
            <div class="space-y-1">
                <p class="text-slate-400 font-medium uppercase tracking-wider text-xs">Email</p>
                <p class="text-base font-semibold text-slate-800">{{ $tamu->email }}</p>
            </div>

            <div class="space-y-1">
                <p class="text-slate-400 font-medium uppercase tracking-wider text-xs">No. Telepon</p>
                <p class="text-base font-semibold text-slate-800 font-mono">{{ $tamu->no_telepon }}</p>
            </div>

            <div class="space-y-1">
                <p class="text-slate-400 font-medium uppercase tracking-wider text-xs">Jenis Kelamin</p>
                <div class="pt-0.5">
                    <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $tamu->jenis_kelamin == 'Laki-laki' ? 'bg-brand-50 text-brand-700 border border-brand-200/50' : 'bg-rose-50 text-rose-600 border border-rose-100' }}">
                        {{ $tamu->jenis_kelamin }}
                    </span>
                </div>
            </div>

            <div class="space-y-1">
                <p class="text-slate-400 font-medium uppercase tracking-wider text-xs">No. Identitas (KTP/Passport)</p>
                <p class="text-base font-semibold text-slate-800 font-mono">{{ $tamu->no_identitas }}</p>
            </div>

            <div class="col-span-1 md:col-span-2 space-y-1 border-t border-slate-100 pt-4">
                <p class="text-slate-400 font-medium uppercase tracking-wider text-xs">Alamat Lengkap</p>
                <p class="text-base text-slate-700 leading-relaxed bg-slate-50 p-4 rounded-xl border border-slate-100 mt-1">
                    {{ $tamu->alamat }}
                </p>
            </div>
        </div>

        <div class="px-8 py-5 bg-slate-50/50 border-t border-slate-100 flex gap-3 justify-end">
            <a href="{{ route('tamus.edit', $tamu) }}" class="bg-amber-500 hover:bg-amber-600 text-white px-5 py-2.5 rounded-xl font-medium transition shadow-sm flex items-center gap-2">
                <i class="fas fa-edit text-sm"></i> Edit Data
            </a>
            <form action="{{ route('tamus.destroy', $tamu) }}" method="POST" class="inline" onsubmit="confirmDelete(event)">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-rose-600 hover:bg-rose-700 text-white px-5 py-2.5 rounded-xl font-medium transition shadow-sm flex items-center gap-2">
                    <i class="fas fa-trash text-sm"></i> Hapus
                </button>
            </form>
        </div>
    </div>
</div>
@endsection