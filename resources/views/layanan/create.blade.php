@extends('layouts.app')

@section('title', 'Tambah Layanan Baru')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-[#0B2B40] tracking-tight">
                <i class="fa-solid fa-plus-circle text-teal-500 me-3"></i>Tambah Layanan
            </h1>
            <p class="text-slate-500 text-sm mt-1">Daftarkan jenis layanan medis baru di FishHealth+</p>
        </div>
        <a href="{{ route('layanan.index') }}" class="btn-premium-outline flex items-center gap-2">
            <i class="fa-solid fa-arrow-left text-xs"></i>
            Kembali
        </a>
    </div>

    <!-- Form Card -->
    <div class="glass-premium p-8 relative overflow-hidden">
        <div class="absolute -right-20 -top-20 w-64 h-64 bg-teal-50 rounded-full blur-3xl"></div>
        
        <form action="{{ route('layanan.store') }}" method="POST" class="space-y-6 relative z-10">
            @csrf
            
            <div class="space-y-2">
                <label class="block text-[#0B2B40] text-sm font-bold mb-2">Nama Layanan</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                        <i class="fa-solid fa-stethoscope"></i>
                    </div>
                    <input type="text" name="nama_layanan" class="input-premium pl-11 @error('nama_layanan') border-red-500 @enderror" 
                           value="{{ old('nama_layanan') }}" placeholder="Masukkan nama layanan (contoh: Operasi Tumor)" required>
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
                           value="{{ old('harga') }}" placeholder="Masukkan nominal harga (contoh: 250000)" required>
                </div>
                @error('harga')
                    <p class="text-red-500 text-[10px] font-bold mt-1 uppercase tracking-widest">{{ $message }}</p>
                @enderror
                <p class="text-[10px] text-slate-400 font-medium uppercase tracking-widest mt-1">Hanya angka saja, tanpa titik atau koma.</p>
            </div>

            <div class="space-y-2">
                <label class="block text-[#0B2B40] text-sm font-bold mb-2">Tipe Layanan (Subtype)</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                        <i class="fa-solid fa-users-gear"></i>
                    </div>
                    <select name="subtype" class="input-premium pl-11 @error('subtype') border-red-500 @enderror" required>
                        <option value="teknisi" {{ old('subtype') === 'teknisi' ? 'selected' : '' }}>Teknisi Kolam (Fisik)</option>
                        <option value="dokter" {{ old('subtype') === 'dokter' ? 'selected' : '' }}>Dokter Ikan (Medis)</option>
                    </select>
                </div>
                @error('subtype')
                    <p class="text-red-500 text-[10px] font-bold mt-1 uppercase tracking-widest">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-4">
                <button type="submit" class="btn-premium w-full py-4 text-lg group">
                    <i class="fa-solid fa-cloud-arrow-up me-2 group-hover:scale-110 transition-transform"></i>
                    Daftarkan Layanan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
