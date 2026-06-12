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
    @if(auth()->user()->isAdmin())
    <a href="{{ route('layanan.create') }}" class="btn-premium py-2.5 px-6 flex items-center gap-2">
        <i class="fa-solid fa-plus text-xs"></i>
        Tambah Layanan Baru
    </a>
    @endif
</div>

<div class="glass-premium p-6">
    <!-- Search & Filter Bar -->
    <div class="flex flex-col sm:flex-row gap-3 mb-6">
        <div class="relative flex-1">
            <i class="fa-solid fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-300 text-xs"></i>
            <input type="text" id="searchLayanan" placeholder="Cari nama layanan..." class="input-premium pl-9 text-sm py-2 w-full" oninput="filterLayanan()">
        </div>
        <select id="subtypeLayanan" class="input-premium text-sm py-2 w-full sm:w-44" onchange="filterLayanan()">
            <option value="">Semua Tipe</option>
            <option value="teknisi">Teknisi Kolam</option>
            <option value="dokter">Dokter Ikan</option>
        </select>
        <select id="sortLayanan" class="input-premium text-sm py-2 w-full sm:w-44" onchange="filterLayanan()">
            <option value="">Urut: Default</option>
            <option value="asc">Harga: Rendah ke Tinggi</option>
            <option value="desc">Harga: Tinggi ke Rendah</option>
        </select>
    </div>

    <!-- Mobile Card List View -->
    <div class="block sm:hidden space-y-3.5 mb-4" id="layananMobileList">
        @forelse($data as $index => $item)
        <div class="mobile-card-item bg-slate-50/50 p-4 rounded-xl border border-slate-100 shadow-sm space-y-3" data-harga="{{ $item->harga }}" data-subtype="{{ $item->subtype }}">
            <!-- Header: No, Nama & Harga -->
            <div class="flex items-center justify-between gap-3">
                <div class="flex items-center gap-2 min-w-0">
                    <span class="w-6 h-6 flex-shrink-0 flex items-center justify-center bg-slate-100 rounded-lg text-slate-400 font-bold text-xs row-no-mobile">{{ $index + 1 }}</span>
                    <div class="w-9 h-9 flex-shrink-0 bg-indigo-50 rounded-xl flex items-center justify-center text-indigo-600 shadow-sm">
                        <i class="fa-solid fa-hand-holding-medical"></i>
                    </div>
                    <div class="min-w-0">
                        <p class="font-bold text-[#0B2B40] text-sm leading-tight truncate">{{ $item->nama_layanan }}</p>
                        <span class="inline-block px-2 py-0.5 mt-1 rounded text-[9px] font-extrabold uppercase tracking-wider {{ $item->subtype === 'dokter' ? 'bg-rose-50 text-rose-600 border border-rose-100' : 'bg-blue-50 text-blue-600 border border-blue-100' }}">
                            {{ $item->subtype === 'dokter' ? 'Dokter Ikan' : 'Teknisi Kolam' }}
                        </span>
                    </div>
                </div>
                <div class="flex-shrink-0 text-right">
                    <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest">Harga</p>
                    <p class="text-sm font-black text-emerald-600">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                </div>
            </div>

            <!-- Admin Actions block -->
            @if(auth()->user()->isAdmin())
            <div class="pt-2 border-t border-slate-100 flex gap-2">
                <a href="{{ route('layanan.edit', $item->layanan_id) }}" class="flex-1 text-center text-xs font-black bg-amber-50 hover:bg-amber-500 text-amber-600 hover:text-white py-2.5 rounded-xl border border-amber-100 transition-all uppercase tracking-widest flex items-center justify-center gap-2">
                    <i class="fa-solid fa-pen"></i> Edit
                </a>
                <form action="{{ route('layanan.destroy', $item->layanan_id) }}" method="POST" class="flex-1" onsubmit="return confirm('Yakin ingin menghapus layanan ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full text-center text-xs font-black bg-red-50 hover:bg-red-500 text-red-500 hover:text-white border border-red-100 py-2.5 rounded-xl transition-all uppercase tracking-widest flex items-center justify-center gap-2">
                        <i class="fa-solid fa-trash"></i> Hapus
                    </button>
                </form>
            </div>
            @endif
        </div>
        @empty
        <div class="text-center text-slate-400 py-8 italic bg-slate-50 rounded-xl border border-dashed border-slate-200">
            Belum ada data layanan.
        </div>
        @endforelse
    </div>

    <!-- Desktop Table View -->
    <div class="hidden sm:block overflow-x-auto">
        <table class="table-premium" id="layananTable">
            <thead>
                <tr>
                    <th width="5%" class="text-center">No</th>
                    <th>Nama Layanan</th>
                    <th>Tipe Layanan</th>
                    <th>Harga Layanan</th>
                    @if(auth()->user()->isAdmin())
                    <th width="15%" class="text-center">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($data as $index => $item)
                <tr data-harga="{{ $item->harga }}" data-subtype="{{ $item->subtype }}">
                    <td class="text-slate-400 font-bold text-center text-sm row-no">{{ $index + 1 }}</td>
                    <td>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-indigo-50 rounded-xl flex items-center justify-center text-indigo-600 shadow-sm">
                                <i class="fa-solid fa-hand-holding-medical"></i>
                            </div>
                            <span class="font-bold text-[#0B2B40]">{{ $item->nama_layanan }}</span>
                        </div>
                    </td>
                    <td>
                        <span class="px-2.5 py-1 rounded-full text-xs font-bold {{ $item->subtype === 'dokter' ? 'bg-rose-50 text-rose-600 border border-rose-100' : 'bg-blue-50 text-blue-600 border border-blue-100' }}">
                            {{ $item->subtype === 'dokter' ? 'Dokter Ikan' : 'Teknisi Kolam' }}
                        </span>
                    </td>
                    <td>
                        <div class="flex items-center gap-2 text-emerald-600 font-black">
                            <span class="text-[10px] opacity-50">Rp</span>
                            {{ number_format($item->harga, 0, ',', '.') }}
                        </div>
                    </td>
                    @if(auth()->user()->isAdmin())
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
                    @endif
                </tr>
                @empty
                <tr id="emptyRow">
                    <td colspan="{{ auth()->user()->isAdmin() ? 5 : 4 }}" class="text-center text-slate-400 py-12 italic">Belum ada data layanan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div id="noResultLayanan" class="hidden text-center text-slate-400 py-12 italic text-sm">Tidak ada data yang cocok dengan pencarian.</div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function filterLayanan() {
    const q = document.getElementById('searchLayanan').value.toLowerCase().trim();
    const subtype = document.getElementById('subtypeLayanan').value;
    const sort = document.getElementById('sortLayanan').value;

    // 1. Filter & Sort Desktop Rows
    const tbody = document.querySelector('#layananTable tbody');
    let rows = Array.from(tbody.querySelectorAll('tr[data-harga]'));
    rows.forEach(row => {
        const rowSubtype = row.getAttribute('data-subtype');
        const matchesQuery = !q || row.textContent.toLowerCase().includes(q);
        const matchesSubtype = !subtype || rowSubtype === subtype;
        row.style.display = (matchesQuery && matchesSubtype) ? '' : 'none';
    });
    if (sort) {
        const visible = rows.filter(r => r.style.display !== 'none');
        visible.sort((a, b) => {
            const ha = parseInt(a.getAttribute('data-harga'));
            const hb = parseInt(b.getAttribute('data-harga'));
            return sort === 'asc' ? ha - hb : hb - ha;
        });
        visible.forEach(r => tbody.appendChild(r));
    }
    let noDesktop = 1;
    rows.forEach(row => {
        if (row.style.display !== 'none') {
            const cell = row.querySelector('.row-no');
            if (cell) cell.textContent = noDesktop++;
        }
    });

    // 2. Filter & Sort Mobile Cards
    const mobileContainer = document.getElementById('layananMobileList');
    let cards = Array.from(mobileContainer.querySelectorAll('.mobile-card-item'));
    cards.forEach(card => {
        const cardSubtype = card.getAttribute('data-subtype');
        const matchesQuery = !q || card.textContent.toLowerCase().includes(q);
        const matchesSubtype = !subtype || cardSubtype === subtype;
        card.style.display = (matchesQuery && matchesSubtype) ? '' : 'none';
    });
    if (sort) {
        const visibleCards = cards.filter(c => c.style.display !== 'none');
        visibleCards.sort((a, b) => {
            const ha = parseInt(a.getAttribute('data-harga'));
            const hb = parseInt(b.getAttribute('data-harga'));
            return sort === 'asc' ? ha - hb : hb - ha;
        });
        visibleCards.forEach(c => mobileContainer.appendChild(c));
    }
    let noMobile = 1;
    cards.forEach(card => {
        if (card.style.display !== 'none') {
            const cell = card.querySelector('.row-no-mobile');
            if (cell) cell.textContent = noMobile++;
        }
    });

    // 3. Empty state
    const totalVisible = Math.max(
        rows.filter(r => r.style.display !== 'none').length,
        cards.filter(c => c.style.display !== 'none').length
    );
    document.getElementById('noResultLayanan').classList.toggle('hidden', totalVisible > 0);
}
</script>
@endpush
