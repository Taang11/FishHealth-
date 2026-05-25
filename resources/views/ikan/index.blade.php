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
    <!-- Search & Filter Bar -->
    <div class="flex flex-col sm:flex-row gap-3 mb-6">
        <div class="relative flex-1">
            <i class="fa-solid fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-300 text-xs"></i>
            <input type="text" id="searchIkan" placeholder="Cari nama ikan..." class="input-premium pl-9 text-sm py-2 w-full" oninput="filterIkan()">
        </div>
        <select id="filterIkanJenis" class="input-premium text-sm py-2 w-full sm:w-44" onchange="filterIkan()">
            <option value="">Semua Jenis</option>
            {{-- Dynamically populated via JS --}}
        </select>
    </div>

    <!-- Mobile Card List View -->
    <div class="block sm:hidden space-y-3.5 mb-4" id="ikanMobileList">
        @forelse($ikan as $index => $item)
        <div class="mobile-card-item bg-slate-50/50 p-4 rounded-xl border border-slate-100 shadow-sm space-y-3" data-jenis="{{ strtolower($item->jenis) }}">
            <!-- Header: No, Nama & Jenis -->
            <div class="flex items-center justify-between gap-3">
                <div class="flex items-center gap-2 min-w-0">
                    <span class="w-6 h-6 flex-shrink-0 flex items-center justify-center bg-slate-100 rounded-lg text-slate-400 font-bold text-xs row-no-mobile">{{ $index + 1 }}</span>
                    <div class="w-9 h-9 flex-shrink-0 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600 shadow-sm">
                        <i class="fa-solid fa-fish"></i>
                    </div>
                    <p class="font-bold text-[#0B2B40] text-sm truncate">{{ $item->nama }}</p>
                </div>
                <span class="flex-shrink-0 px-2.5 py-1 bg-blue-50 text-blue-600 rounded-lg text-[9px] font-bold uppercase tracking-wider border border-blue-100 class-jenis-mobile">{{ $item->jenis }}</span>
            </div>

            <!-- Actions block -->
            <div class="pt-2 border-t border-slate-100 flex gap-2">
                <a href="{{ route('ikan.edit', $item->ikan_id) }}" class="flex-1 text-center text-xs font-black bg-amber-50 hover:bg-amber-500 text-amber-600 hover:text-white py-2.5 rounded-xl border border-amber-100 transition-all uppercase tracking-widest flex items-center justify-center gap-2">
                    <i class="fa-solid fa-pen"></i> Edit
                </a>
                <form action="{{ route('ikan.destroy', $item->ikan_id) }}" method="POST" class="flex-1" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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
            Belum ada data ikan.
        </div>
        @endforelse
    </div>

    <!-- Desktop Table View -->
    <div class="hidden sm:block overflow-x-auto">
        <table class="table-premium" id="ikanTable">
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
                <tr data-jenis="{{ strtolower($item->jenis) }}">
                    <td class="text-slate-400 font-bold text-center text-sm row-no">{{ $index + 1 }}</td>
                    <td>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600 shadow-sm">
                                <i class="fa-solid fa-fish"></i>
                            </div>
                            <span class="font-bold text-[#0B2B40]">{{ $item->nama }}</span>
                        </div>
                    </td>
                    <td>
                        <span class="px-2 py-1 bg-blue-50 text-blue-600 rounded-lg text-[10px] font-bold uppercase tracking-wider border border-blue-100 class-jenis">
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
                <tr id="emptyRow">
                    <td colspan="4" class="text-center text-slate-400 py-12 italic">Belum ada data ikan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div id="noResultIkan" class="hidden text-center text-slate-400 py-12 italic text-sm">Tidak ada data yang cocok dengan pencarian.</div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Dynamically populate Jenis options from desktop rows
    const select = document.getElementById('filterIkanJenis');
    const rows = document.querySelectorAll('#ikanTable tbody tr[data-jenis]');
    const jenisSet = new Set();
    
    rows.forEach(row => {
        const jenisSpan = row.querySelector('.class-jenis');
        if (jenisSpan) {
            const rawText = jenisSpan.textContent.trim();
            if (rawText) jenisSet.add(rawText);
        }
    });

    jenisSet.forEach(jenis => {
        const option = document.createElement('option');
        option.value = jenis.toLowerCase();
        option.textContent = jenis;
        select.appendChild(option);
    });
});

function filterIkan() {
    const q = document.getElementById('searchIkan').value.toLowerCase().trim();
    const filterJenis = document.getElementById('filterIkanJenis').value;

    // 1. Filter Desktop Rows
    const rows = document.querySelectorAll('#ikanTable tbody tr[data-jenis]');
    let visibleRows = 0;
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        const rowJenis = row.getAttribute('data-jenis') || '';
        const matchQ = !q || text.includes(q);
        const matchJenis = !filterJenis || rowJenis === filterJenis;
        const show = matchQ && matchJenis;
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
    const cards = document.querySelectorAll('#ikanMobileList .mobile-card-item');
    let visibleCards = 0;
    cards.forEach(card => {
        const text = card.textContent.toLowerCase();
        const cardJenis = card.getAttribute('data-jenis') || '';
        const matchQ = !q || text.includes(q);
        const matchJenis = !filterJenis || cardJenis === filterJenis;
        const show = matchQ && matchJenis;
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

    // 3. Empty state
    const totalVisible = Math.max(visibleRows, visibleCards);
    document.getElementById('noResultIkan').classList.toggle('hidden', totalVisible > 0);
}
</script>
@endpush
