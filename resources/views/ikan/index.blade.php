@extends('layouts.app')

@section('title', 'Data Master Ikan')

@section('content')
<!-- Page Header -->
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
    <div>
        <h1 class="text-3xl font-extrabold text-[#0B2B40] tracking-tight">
            <i class="fa-solid fa-fish text-teal-500 me-3"></i>Master Data Ikan
        </h1>
        <p class="text-slate-500 text-sm mt-1">Kelola daftar jenis ikan yang dapat ditangani</p>
    </div>
    <a href="{{ route('ikan.create') }}" class="btn-premium py-2.5 px-6 flex items-center gap-2">
        <i class="fa-solid fa-plus text-xs"></i>
        Tambah Data Ikan
    </a>
</div>

<div class="glass-premium p-6">
    <div class="overflow-x-auto">
        <table class="table-premium">
            <thead>
                <tr>
                    <th width="5%" class="text-center">No</th>
                    <th>Nama Ikan</th>
                    <th>Jenis / Klasifikasi</th>
                    <th width="15%" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ikan as $index => $item)
                <tr>
                    <td class="text-slate-400 font-bold text-center text-sm">{{ $index + 1 }}</td>
                    <td>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600 shadow-sm">
                                <i class="fa-solid fa-fish"></i>
                            </div>
                            <span class="font-bold text-[#0B2B40]">{{ $item->nama }}</span>
                        </div>
                    </td>
                    <td>
                        <span class="px-2 py-1 bg-blue-50 text-blue-600 rounded-lg text-[10px] font-bold uppercase tracking-wider border border-blue-100">
                            {{ $item->jenis }}
                        </span>
                    </td>
                    <td class="text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('ikan.edit', $item->ikan_id) }}" class="w-8 h-8 flex items-center justify-center bg-amber-50 text-amber-600 border border-amber-100 rounded-lg hover:bg-amber-500 hover:text-white transition-all shadow-sm" title="Edit Data">
                                <i class="fa-solid fa-pen text-xs"></i>
                            </a>
                            <form action="{{ route('ikan.destroy', $item->ikan_id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-8 h-8 flex items-center justify-center bg-red-50 text-red-500 border border-red-100 rounded-lg hover:bg-red-500 hover:text-white transition-all shadow-sm" title="Hapus Data">
                                    <i class="fa-solid fa-trash text-xs"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-slate-400 py-12 italic">Belum ada data ikan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
