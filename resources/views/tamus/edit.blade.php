@extends('layouts.master')

@section('title', 'Edit Tamu')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-8">
        <div>
            <div class="flex items-center gap-2 text-sm font-medium">
                <a href="/dashboard" class="text-slate-400 hover:text-brand-700 transition">Dashboard</a>
                <span class="text-slate-300">/</span>
                <a href="{{ route('tamus.index') }}" class="text-slate-400 hover:text-brand-700 transition">Data Tamu</a>
                <span class="text-slate-300">/</span>
                <span class="text-slate-800 font-semibold">Edit</span>
            </div>
            <h2 class="text-3xl font-bold text-slate-800 tracking-tight mt-1">Ubah Data Tamu</h2>
            <p class="text-slate-500 text-sm mt-0.5">Perbarui informasi profil atau dokumen identitas tamu jika terdapat kekeliruan data.</p>
        </div>
        <a href="{{ route('tamus.index') }}" class="bg-white border border-slate-200 text-slate-600 px-4 py-2.5 rounded-xl hover:bg-slate-50 font-medium text-sm transition shadow-sm flex items-center gap-2">
            <i class="fas fa-arrow-left text-xs"></i> Kembali
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-6 bg-gradient-to-r from-amber-600 to-amber-500 text-white flex items-center gap-4">
            <div class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center border border-white/20 shadow-inner">
                <i class="fas fa-user-edit text-xl text-amber-100"></i>
            </div>
            <div>
                <h3 class="text-lg font-bold tracking-wide">Formulir Pembaruan Data</h3>
                <p class="text-xs text-amber-100/90 mt-0.5">Mengubah profil tamu: <span class="font-semibold text-white">{{ $tamu->nama_lengkap }}</span></p>
            </div>
        </div>

        <form action="{{ route('tamus.update', $tamu) }}" method="POST" class="p-8 space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div class="space-y-2">
                    <label class="block text-slate-700 font-semibold text-sm">Nama Lengkap <span class="text-rose-500">*</span></label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                            <i class="fas fa-user text-sm"></i>
                        </span>
                        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $tamu->nama_lengkap) }}" placeholder="Masukkan nama lengkap"
                            class="w-full pl-11 pr-4 py-2.5 bg-white border @error('nama_lengkap') border-rose-400 focus:ring-rose-500/10 @else border-slate-200 focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 @enderror rounded-xl focus:outline-none text-sm text-slate-800 transition">
                    </div>
                    @error('nama_lengkap') <p class="text-rose-500 text-xs font-medium mt-1"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label class="block text-slate-700 font-semibold text-sm">No. Identitas (KTP / Paspor) <span class="text-rose-500">*</span></label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                            <i class="fas fa-id-card text-sm"></i>
                        </span>
                        <input type="text" name="no_identitas" value="{{ old('no_identitas', $tamu->no_identitas) }}" placeholder="Nomor KTP atau paspor"
                            class="w-full pl-11 pr-4 py-2.5 bg-white border font-mono @error('no_identitas') border-rose-400 focus:ring-rose-500/10 @else border-slate-200 focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 @enderror rounded-xl focus:outline-none text-sm text-slate-800 transition">
                    </div>
                    @error('no_identitas') <p class="text-rose-500 text-xs font-medium mt-1"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label class="block text-slate-700 font-semibold text-sm">Jenis Kelamin <span class="text-rose-500">*</span></label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                            <i class="fas fa-venus-mars text-sm"></i>
                        </span>
                        <select name="jenis_kelamin" 
                            class="w-full pl-11 pr-4 py-2.5 bg-white border @error('jenis_kelamin') border-rose-400 focus:ring-rose-500/10 @else border-slate-200 focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 @enderror rounded-xl focus:outline-none text-sm text-slate-800 transition appearance-none cursor-pointer">
                            <option value="Laki-laki" {{ old('jenis_kelamin', $tamu->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin', $tamu->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-slate-400 pointer-events-none">
                            <i class="fas fa-chevron-down text-xs"></i>
                        </span>
                    </div>
                    @error('jenis_kelamin') <p class="text-rose-500 text-xs font-medium mt-1"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label class="block text-slate-700 font-semibold text-sm">No. Telepon <span class="text-rose-500">*</span></label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                            <i class="fas fa-phone text-sm"></i>
                        </span>
                        <input type="text" name="no_telepon" value="{{ old('no_telepon', $tamu->no_telepon) }}" placeholder="Nomor handphone aktif"
                            class="w-full pl-11 pr-4 py-2.5 bg-white border font-mono @error('no_telepon') border-rose-400 focus:ring-rose-500/10 @else border-slate-200 focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 @enderror rounded-xl focus:outline-none text-sm text-slate-800 transition">
                    </div>
                    @error('no_telepon') <p class="text-rose-500 text-xs font-medium mt-1"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p> @enderror
                </div>

                <div class="space-y-2 md:col-span-2">
                    <label class="block text-slate-700 font-semibold text-sm">Alamat Email <span class="text-rose-500">*</span></label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                            <i class="fas fa-envelope text-sm"></i>
                        </span>
                        <input type="email" name="email" value="{{ old('email', $tamu->email) }}" placeholder="Alamat email aktif"
                            class="w-full pl-11 pr-4 py-2.5 bg-white border @error('email') border-rose-400 focus:ring-rose-500/10 @else border-slate-200 focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 @enderror rounded-xl focus:outline-none text-sm text-slate-800 transition">
                    </div>
                    @error('email') <p class="text-rose-500 text-xs font-medium mt-1"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p> @enderror
                </div>

                <div class="space-y-2 md:col-span-2">
                    <label class="block text-slate-700 font-semibold text-sm">Alamat Lengkap <span class="text-rose-500">*</span></label>
                    <div class="relative">
                        <span class="absolute top-3 left-4 text-slate-400">
                            <i class="fas fa-map-marker-alt text-sm"></i>
                        </span>
                        <textarea name="alamat" rows="3" placeholder="Tuliskan alamat lengkap..."
                            class="w-full pl-11 pr-4 py-2.5 bg-white border @error('alamat') border-rose-400 focus:ring-rose-500/10 @else border-slate-200 focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 @enderror rounded-xl focus:outline-none text-sm text-slate-800 transition resize-none">{{ old('alamat', $tamu->alamat) }}</textarea>
                    </div>
                    @error('alamat') <p class="text-rose-500 text-xs font-medium mt-1"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p> @enderror
                </div>

            </div>

            <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('tamus.index') }}" class="bg-white border border-slate-200 text-slate-600 px-5 py-2.5 rounded-xl hover:bg-slate-50 font-medium text-sm transition shadow-sm flex items-center gap-2">
                    <i class="fas fa-times text-xs"></i> Batal
                </a>
                
                <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white px-6 py-2.5 rounded-xl font-medium text-sm transition shadow-md flex items-center gap-2">
                    <i class="fas fa-save text-xs"></i> Perbarui Data
                </button>
            </div>
        </form>
    </div>
</div>
@endsection