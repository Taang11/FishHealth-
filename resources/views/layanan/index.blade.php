@extends('layouts.app')

@section('title', 'Data Master Layanan')

@section('content')
<!-- Page Header -->
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
    <div>
        <h1 class="text-3xl font-extrabold text-[#0B2B40] tracking-tight">
            <i class="fa-solid fa-stethoscope text-teal-500 me-3"></i>Master Data Layanan
        </h1>
        <p class="text-slate-500 text-sm mt-1">Kelola daftar layanan kesehatan ikan dan tarifnya</p>
    </div>
    <a href="{{ route('layanan.create') }}" class="btn-premium py-2.5 px-6 flex items-center gap-2">
        <i class="fa-solid fa-plus text-xs"></i>
        Tambah Layanan Baru
    </a>
</div>

<div class="glass-premium p-6">
    <div class="overflow-x-auto">
        <table class="table-premium">
            <thead>
                <tr>
                    <th width="5%" class="text-center">No</th>
                    <th>Nama Layanan</th>
                    <th>Harga Layanan</th>
                    <th width="15%" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $index => $item)
                <tr>
                    <td class="text-slate-400 font-bold text-center text-sm">{{ $index + 1 }}</td>
                    <td>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-indigo-50 rounded-xl flex items-center justify-center text-indigo-600 shadow-sm">
                                <i class="fa-solid fa-hand-holding-medical"></i>
                            </div>
                            <span class="font-bold text-[#0B2B40]">{{ $item->nama_layanan }}</span>
                        </div>
                    </td>
                    <td>
                        <div class="flex items-center gap-2 text-emerald-600 font-black">
                            <span class="text-[10px] opacity-50">Rp</span>
                            {{ number_format($item->harga, 0, ',', '.') }}
                        </div>
                    </td>
                    <td class="text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('layanan.edit', $item->layanan_id) }}" class="w-8 h-8 flex items-center justify-center bg-amber-50 text-amber-600 border border-amber-100 rounded-lg hover:bg-amber-500 hover:text-white transition-all shadow-sm" title="Edit Layanan">
                                <i class="fa-solid fa-pen text-xs"></i>
                            </a>
                            <form action="{{ route('layanan.destroy', $item->layanan_id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus layanan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-8 h-8 flex items-center justify-center bg-red-50 text-red-500 border border-red-100 rounded-lg hover:bg-red-500 hover:text-white transition-all shadow-sm" title="Hapus Layanan">
                                    <i class="fa-solid fa-trash text-xs"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-slate-400 py-12 italic">Belum ada data layanan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
