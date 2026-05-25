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
    <!-- Search & Filter Bar -->
    <div class="flex flex-col sm:flex-row gap-3 mb-6">
        <div class="relative flex-1">
            <i class="fa-solid fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-300 text-xs"></i>
            <input type="text" id="searchTeknisi" placeholder="Cari nama, kontak, atau alamat..." class="input-premium pl-9 text-sm py-2 w-full" oninput="filterTeknisi()">
        </div>
        <select id="filterSubtype" class="input-premium text-sm py-2 w-full sm:w-40" onchange="filterTeknisi()">
            <option value="">Semua Tipe</option>
            <option value="dokter">Dokter</option>
            <option value="teknisi">Teknisi</option>
        </select>
    </div>

    <!-- Mobile Card List View -->
    <div class="block sm:hidden space-y-3.5 mb-4" id="teknisiMobileList">
        @forelse($data as $index => $item)
        <div class="mobile-card-item bg-slate-50/50 p-4 rounded-xl border border-slate-100 shadow-sm space-y-3" data-subtype="{{ $item->subtype }}">
            <!-- Header: No, Nama, & Tipe -->
            <div class="flex items-start justify-between gap-3">
                <div class="flex items-center gap-2">
                    <span class="w-6 h-6 flex items-center justify-center bg-slate-100 rounded-lg text-slate-400 font-bold text-xs row-no-mobile">{{ $index + 1 }}</span>
                    <div>
                        <p class="font-bold text-[#0B2B40] text-sm">{{ $item->nama }}</p>
                        <p class="text-[9px] uppercase tracking-widest font-bold {{ $item->subtype == 'dokter' ? 'text-blue-500' : 'text-slate-400' }} mt-0.5">
                            <i class="fa-solid {{ $item->subtype == 'dokter' ? 'fa-user-doctor' : 'fa-wrench' }} me-1"></i>
                            {{ ucfirst($item->subtype ?? 'teknisi') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Kontak & Alamat Info block -->
            <div class="bg-white p-3 rounded-lg border border-slate-100 space-y-2.5">
                <div>
                    <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest">WhatsApp</p>
                    <a href="https://wa.me/{{ $item->no_hp }}" target="_blank" class="inline-flex items-center gap-1.5 mt-1 text-emerald-600 text-xs font-bold">
                        <i class="fa-brands fa-whatsapp text-sm"></i>
                        {{ $item->no_hp }}
                    </a>
                </div>
                <div class="border-t border-slate-50 pt-2">
                    <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest">Wilayah / Alamat</p>
                    <p class="text-xs font-bold text-slate-600 mt-1 flex items-start gap-1.5">
                        <i class="fa-solid fa-location-dot text-amber-500 mt-0.5 flex-shrink-0"></i>
                        {{ $item->alamat }}
                    </p>
                </div>
            </div>

            <!-- Actions block -->
            <div class="pt-2 border-t border-slate-100 flex gap-2 justify-end">
                <a href="{{ route('teknisi.edit', $item->teknisi_id) }}" class="flex-1 text-center text-xs font-black bg-amber-50 hover:bg-amber-500 text-amber-600 hover:text-white py-2.5 rounded-xl border border-amber-100 transition-all uppercase tracking-widest flex items-center justify-center gap-2">
                    <i class="fa-solid fa-pen"></i> Edit
                </a>
                <form action="{{ route('teknisi.destroy', $item->teknisi_id) }}" method="POST" class="flex-1" onsubmit="return confirm('Yakin ingin menghapus teknisi ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full text-center text-xs font-black bg-red-50 hover:bg-red-500 text-red-500 hover:text-white border border-red-100 py-2.5 rounded-xl transition-all uppercase tracking-widest flex items-center justify-center gap-2">
                        <i class="fa-solid fa-trash"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="text-center text-slate-400 py-8 italic bg-slate-50 rounded-xl border border-dashed border-slate-200">
            Belum ada data teknisi.
        </div>
        @endforelse
    </div>

    <!-- Desktop Table View -->
    <div class="hidden sm:block overflow-x-auto">
        <table class="table-premium" id="teknisiTable">
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
                <tr data-subtype="{{ $item->subtype }}">
                    <td class="text-slate-400 font-bold text-center text-sm row-no">{{ $index + 1 }}</td>
                    <td>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 shadow-sm">
                                <i class="fa-solid fa-user-gear"></i>
                            </div>
                            <div class="flex flex-col">
                                <span class="font-bold text-[#0B2B40]">{{ $item->nama }}</span>
                                <span class="text-[10px] uppercase tracking-widest font-bold {{ $item->subtype == 'dokter' ? 'text-blue-500' : 'text-slate-400' }}">
                                    <i class="fa-solid {{ $item->subtype == 'dokter' ? 'fa-user-doctor' : 'fa-wrench' }} me-1"></i>
                                    {{ ucfirst($item->subtype ?? 'teknisi') }}
                                </span>
                            </div>
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
        <div id="noResultTeknisi" class="hidden text-center text-slate-400 py-12 italic text-sm">Tidak ada data yang cocok dengan pencarian.</div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function filterTeknisi() {
    const q = document.getElementById('searchTeknisi').value.toLowerCase().trim();
    const subtype = document.getElementById('filterSubtype').value;
    
    // 1. Filter Desktop Rows
    const rows = document.querySelectorAll('#teknisiTable tbody tr[data-subtype]');
    let visibleRows = 0;
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        const st = row.getAttribute('data-subtype') || '';
        const matchQ = !q || text.includes(q);
        const matchSt = !subtype || st === subtype;
        const show = matchQ && matchSt;
        row.style.display = show ? '' : 'none';
        if (show) visibleRows++;
    });

    // Renumber Desktop
    let noDesktop = 1;
    rows.forEach(row => {
        if (row.style.display !== 'none') {
            const cell = row.querySelector('.row-no');
            if (cell) cell.textContent = noDesktop++;
        }
    });

    // 2. Filter Mobile Cards
    const cards = document.querySelectorAll('#teknisiMobileList .mobile-card-item');
    let visibleCards = 0;
    cards.forEach(card => {
        const text = card.textContent.toLowerCase();
        const cardStatus = card.getAttribute('data-subtype') || '';
        const matchQ = !q || text.includes(q);
        const matchStatus = !subtype || cardStatus === subtype;
        const show = matchQ && matchStatus;
        card.style.display = show ? '' : 'none';
        if (show) visibleCards++;
    });

    // Renumber Mobile
    let noMobile = 1;
    cards.forEach(card => {
        if (card.style.display !== 'none') {
            const cell = card.querySelector('.row-no-mobile');
            if (cell) cell.textContent = noMobile++;
        }
    });

    // 3. Handle Empty Message
    const totalVisible = Math.max(visibleRows, visibleCards);
    document.getElementById('noResultTeknisi').classList.toggle('hidden', totalVisible > 0);
}
</script>
@endpush
