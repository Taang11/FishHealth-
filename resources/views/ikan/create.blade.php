@extends('layouts.app')

@section('title', 'Tambah Data Ikan')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-[#0B2B40] tracking-tight">
                <i class="fa-solid fa-plus-circle text-teal-500 me-3"></i>Tambah Data Ikan
            </h1>
            <p class="text-slate-500 text-sm mt-1">Tambahkan jenis ikan baru ke dalam database FishHealth+</p>
        </div>
        <a href="{{ route('ikan.index') }}" class="btn-premium-outline flex items-center gap-2">
            <i class="fa-solid fa-arrow-left text-xs"></i>
            Kembali
        </a>
    </div>

    <!-- Form Card -->
    <div class="glass-premium p-8 relative overflow-hidden">
        <div class="absolute -right-20 -top-20 w-64 h-64 bg-teal-50 rounded-full blur-3xl"></div>
        
        <form action="{{ route('ikan.store') }}" method="POST" class="space-y-6 relative z-10">
            @csrf
            
            <div class="space-y-2">
                <label class="block text-[#0B2B40] text-sm font-bold mb-2">Nama Ikan</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                        <i class="fa-solid fa-tag"></i>
                    </div>
                    <input type="text" name="nama" class="input-premium pl-11 @error('nama') border-red-500 @enderror" 
                           value="{{ old('nama') }}" placeholder="Masukkan nama ikan (contoh: Koi Kohaku)" required>
                </div>
                @error('nama')
                    <p class="text-red-500 text-[10px] font-bold mt-1 uppercase tracking-widest">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label class="block text-[#0B2B40] text-sm font-bold mb-2">Jenis / Klasifikasi</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                        <i class="fa-solid fa-layer-group"></i>
                    </div>
                    <input type="text" name="jenis" class="input-premium pl-11 @error('jenis') border-red-500 @enderror" 
                           value="{{ old('jenis') }}" placeholder="Masukkan jenis (contoh: Air Tawar)" required>
                </div>
                @error('jenis')
                    <p class="text-red-500 text-[10px] font-bold mt-1 uppercase tracking-widest">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-4">
                <button type="submit" class="btn-premium w-full py-4 text-lg group">
                    <i class="fa-solid fa-save me-2 group-hover:scale-110 transition-transform"></i>
                    Simpan Data Ikan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
