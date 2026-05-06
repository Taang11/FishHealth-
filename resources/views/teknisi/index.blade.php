@extends('layouts.app')

@section('title', 'Data Master Teknisi')

@section('content')
<!-- Page Header -->
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
    <div>
        <h1 class="text-3xl font-extrabold text-[#0B2B40] tracking-tight">
            <i class="fa-solid fa-user-doctor text-teal-500 me-3"></i>Master Data Teknisi
        </h1>
        <p class="text-slate-500 text-sm mt-1">Kelola daftar teknisi ahli dan wilayah tugasnya</p>
    </div>
    <a href="{{ route('teknisi.create') }}" class="btn-premium py-2.5 px-6 flex items-center gap-2">
        <i class="fa-solid fa-plus text-xs"></i>
        Tambah Teknisi Baru
    </a>
</div>

<div class="glass-premium p-6">
    <div class="overflow-x-auto">
        <table class="table-premium">
            <thead>
                <tr>
                    <th width="5%" class="text-center">No</th>
                    <th>Nama Teknisi</th>
                    <th>Kontak WhatsApp</th>
                    <th>Wilayah / Alamat</th>
                    <th width="15%" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $index => $item)
                <tr>
                    <td class="text-slate-400 font-bold text-center text-sm">{{ $index + 1 }}</td>
                    <td>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 shadow-sm">
                                <i class="fa-solid fa-user-gear"></i>
                            </div>
                            <span class="font-bold text-[#0B2B40]">{{ $item->nama }}</span>
                        </div>
                    </td>
                    <td>
                        <a href="https://wa.me/{{ $item->no_hp }}" target="_blank" class="inline-flex items-center gap-2 px-3 py-1.5 bg-emerald-50 text-emerald-600 rounded-lg hover:bg-emerald-500 hover:text-white transition-all border border-emerald-100 text-xs font-bold uppercase tracking-wider shadow-sm">
                            <i class="fa-brands fa-whatsapp"></i>
                            {{ $item->no_hp }}
                        </a>
                    </td>
                    <td>
                        <div class="flex items-center gap-2 text-slate-500 text-sm font-medium">
                            <i class="fa-solid fa-location-dot text-amber-500"></i>
                            {{ \Illuminate\Support\Str::limit($item->alamat, 40) }}
                        </div>
                    </td>
                    <td class="text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('teknisi.edit', $item->teknisi_id) }}" class="w-8 h-8 flex items-center justify-center bg-amber-50 text-amber-600 border border-amber-100 rounded-lg hover:bg-amber-500 hover:text-white transition-all shadow-sm" title="Edit Teknisi">
                                <i class="fa-solid fa-pen text-xs"></i>
                            </a>
                            <form action="{{ route('teknisi.destroy', $item->teknisi_id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus teknisi ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-8 h-8 flex items-center justify-center bg-red-50 text-red-500 border border-red-100 rounded-lg hover:bg-red-500 hover:text-white transition-all shadow-sm" title="Hapus Teknisi">
                                    <i class="fa-solid fa-trash text-xs"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-slate-400 py-12 italic">Belum ada data teknisi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
