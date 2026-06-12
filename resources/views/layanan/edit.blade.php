@extends('layouts.app')

@section('title', 'Edit Layanan')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-[#0B2B40] tracking-tight">
                <i class="fa-solid fa-pen-to-square text-amber-500 me-3"></i>Edit Layanan
            </h1>
            <p class="text-slate-500 text-sm mt-1">Perbarui detail tarif dan nama layanan medis FishHealth+</p>
        </div>
        <a href="{{ route('layanan.index') }}" class="btn-premium-outline flex items-center gap-2">
            <i class="fa-solid fa-arrow-left text-xs"></i>
            Kembali
        </a>
    </div>

    <!-- Form Card -->
    <div class="glass-premium p-8 relative overflow-hidden">
        <div class="absolute -right-20 -top-20 w-64 h-64 bg-amber-50 rounded-full blur-3xl"></div>
        
        <form action="{{ route('layanan.update', $data->layanan_id) }}" method="POST" class="space-y-6 relative z-10">
            @csrf
            @method('PUT')
            
            <div class="space-y-2">
                <label class="block text-[#0B2B40] text-sm font-bold mb-2">Nama Layanan</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                        <i class="fa-solid fa-stethoscope"></i>
                    </div>
                    <input type="text" name="nama_layanan" class="input-premium pl-11 @error('nama_layanan') border-red-500 @enderror" 
                           value="{{ old('nama_layanan', $data->nama_layanan) }}" placeholder="Masukkan nama layanan" required>
                </div>
                @error('nama_layanan')
                    <p class="text-red-500 text-[10px] font-bold mt-1 uppercase tracking-widest">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label class="block text-[#0B2B40] text-sm font-bold mb-2">Harga Layanan (Rp)</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 font-bold text-sm">
                        Rp
                    </div>
                    <input type="number" name="harga" class="input-premium pl-11 @error('harga') border-red-500 @enderror" 
                           value="{{ old('harga', $data->harga) }}" placeholder="Masukkan nominal harga" required>
                </div>
                @error('harga')
                    <p class="text-red-500 text-[10px] font-bold mt-1 uppercase tracking-widest">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label class="block text-[#0B2B40] text-sm font-bold mb-2">Tipe Layanan (Subtype)</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                        <i class="fa-solid fa-users-gear"></i>
                    </div>
                    <select name="subtype" class="input-premium pl-11 @error('subtype') border-red-500 @enderror" required>
                        <option value="teknisi" {{ old('subtype', $data->subtype) === 'teknisi' ? 'selected' : '' }}>Teknisi Kolam (Fisik)</option>
                        <option value="dokter" {{ old('subtype', $data->subtype) === 'dokter' ? 'selected' : '' }}>Dokter Ikan (Medis)</option>
                    </select>
                </div>
                @error('subtype')
                    <p class="text-red-500 text-[10px] font-bold mt-1 uppercase tracking-widest">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-4">
                <button type="submit" class="btn-premium w-full py-4 text-lg group bg-gradient-to-r from-amber-500 to-orange-600 border-none shadow-amber-200">
                    <i class="fa-solid fa-arrows-rotate me-2 group-hover:rotate-180 transition-transform duration-500"></i>
                    Perbarui Layanan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
