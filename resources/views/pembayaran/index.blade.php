@extends('layouts.app')

@section('title', 'Riwayat Pembayaran')

@section('content')
<!-- Page Header -->
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
    <div>
        <h1 class="text-3xl font-extrabold text-[#0B2B40] tracking-tight">
            <i class="fa-solid fa-wallet text-emerald-500 me-3"></i>Riwayat Pembayaran
        </h1>
        <p class="text-slate-500 text-sm mt-1">Laporan transaksi pembayaran layanan yang telah dilakukan</p>
    </div>
    <div class="flex items-center gap-2 bg-emerald-50 border border-emerald-100 px-4 py-2 rounded-2xl shadow-sm">
        <i class="fa-solid fa-shield-check text-emerald-600"></i>
        <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-600">Secure Midtrans Payment</span>
    </div>
</div>

<div class="glass-premium p-6">
    <!-- Search & Filter Bar -->
    <div class="flex flex-col sm:flex-row gap-3 mb-6">
        <div class="relative flex-1">
            <i class="fa-solid fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-300 text-xs"></i>
            <input type="text" id="searchPembayaran" placeholder="Cari ID booking, pelanggan, teknisi, layanan..." class="input-premium pl-9 text-sm py-2 w-full" oninput="filterPembayaran()">
        </div>
        <select id="filterPembayaranStatus" class="input-premium text-sm py-2 w-full sm:w-44" onchange="filterPembayaran()">
            <option value="">Semua Status</option>
            <option value="paid">Paid</option>
            <option value="unpaid">Unpaid / Lainnya</option>
        </select>
    </div>

    <!-- Mobile Card List View -->
    <div class="block sm:hidden space-y-3.5 mb-4" id="pembayaranMobileList">
        @forelse($data as $index => $item)
        <div class="mobile-card-item bg-slate-50/50 p-4 rounded-xl border border-slate-100 shadow-sm space-y-3" data-status="{{ $item->status }}">
            <!-- Header: Booking ID & Status -->
            <div class="flex items-start justify-between gap-3">
                <div class="flex items-center gap-2">
                    <span class="w-6 h-6 flex items-center justify-center bg-slate-100 rounded-lg text-slate-400 font-bold text-xs row-no-mobile">{{ $index + 1 }}</span>
                    <span class="font-bold text-[#0B2B40] text-sm">#{{ $item->booking_id }}</span>
                </div>
                <div class="flex-shrink-0">
                    @if($item->status == 'paid')
                        <span class="px-2.5 py-0.5 bg-emerald-100 text-emerald-700 rounded-lg text-[9px] font-bold uppercase tracking-wider border border-emerald-200">Paid</span>
                    @else
                        <span class="px-2.5 py-0.5 bg-slate-100 text-slate-500 rounded-lg text-[9px] font-bold uppercase tracking-wider border border-slate-200">{{ $item->status }}</span>
                    @endif
                </div>
            </div>

            <!-- Pelanggan, Teknisi & Layanan Info block -->
            <div class="bg-white p-3 rounded-lg border border-slate-100 space-y-2.5">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest">Pelanggan</p>
                        <p class="text-xs font-bold text-[#0B2B40] mt-0.5">{{ $item->booking->user->name ?? '-' }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest">Teknisi</p>
                        <p class="text-xs font-semibold text-slate-700 mt-0.5">{{ $item->booking->teknisi->nama ?? '-' }}</p>
                    </div>
                </div>
                <div class="border-t border-slate-50 pt-2">
                    <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest">Layanan</p>
                    <p class="text-xs font-bold text-slate-600 mt-0.5">{{ $item->booking->layanan->nama_layanan ?? '-' }}</p>
                </div>
            </div>

            <!-- Transaksi & Waktu Info block -->
            <div class="flex items-center justify-between text-xs bg-white p-3 rounded-lg border border-slate-100">
                <div>
                    <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest">Jumlah Transaksi</p>
                    <p class="text-sm font-black text-emerald-600 mt-0.5">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</p>
                </div>
                <div class="text-right">
                    <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest">Waktu</p>
                    <p class="text-[10px] text-slate-500 font-medium mt-0.5"><i class="fa-regular fa-clock text-amber-500 mr-1"></i>{{ $item->created_at->format('d M Y, H:i') }}</p>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center text-slate-400 py-8 italic bg-slate-50 rounded-xl border border-dashed border-slate-200">
            Belum ada riwayat pembayaran.
        </div>
        @endforelse
    </div>

    <!-- Desktop Table View -->
    <div class="hidden sm:block overflow-x-auto">
        <table class="table-premium" id="pembayaranTable">
            <thead>
                <tr>
                    <th width="5%" class="text-center">No</th>
                    <th>ID Booking</th>
                    <th>Pelanggan</th>
                    <th>Teknisi</th>
                    <th>Layanan</th>
                    <th>Jumlah Transaksi</th>
                    <th>Waktu Pembayaran</th>
                    <th class="text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $index => $item)
                <tr data-status="{{ $item->status }}">
                    <td class="text-slate-400 font-bold text-center text-sm row-no">{{ $index + 1 }}</td>
                    <td class="font-bold text-[#0B2B40]">#{{ $item->booking_id }}</td>
                    <td>
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 bg-slate-100 rounded-lg flex items-center justify-center text-[10px] font-bold text-[#0B2B40] shadow-sm">
                                {{ substr($item->booking->user->name ?? 'U', 0, 1) }}
                            </div>
                            <span class="text-sm font-semibold text-slate-700">{{ $item->booking->user->name ?? '-' }}</span>
                        </div>
                    </td>
                    <td class="text-sm text-slate-500 font-medium">{{ $item->booking->teknisi->nama ?? '-' }}</td>
                    <td class="text-sm text-slate-600">{{ $item->booking->layanan->nama_layanan ?? '-' }}</td>
                    <td>
                        <div class="text-emerald-600 font-black text-sm">
                            Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                        </div>
                    </td>
                    <td>
                        <div class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">
                            <i class="fa-regular fa-clock me-1 text-amber-500"></i>
                            {{ $item->created_at->format('d M Y, H:i') }}
                        </div>
                    </td>
                    <td class="text-center">
                        @if($item->status == 'paid')
                            <span class="px-3 py-1.5 bg-emerald-50 text-emerald-600 rounded-xl text-[10px] font-black uppercase tracking-wider border border-emerald-100 flex items-center justify-center gap-2 mx-auto w-fit shadow-sm">
                                <i class="fa-solid fa-check-circle"></i> Paid
                            </span>
                        @else
                            <span class="px-3 py-1.5 bg-slate-50 text-slate-400 rounded-xl text-[10px] font-black uppercase tracking-wider border border-slate-100 flex items-center justify-center gap-2 mx-auto w-fit">
                                {{ $item->status }}
                            </span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr id="emptyRow">
                    <td colspan="8" class="text-center text-slate-400 py-12 italic">Belum ada riwayat pembayaran.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div id="noResultPembayaran" class="hidden text-center text-slate-400 py-12 italic text-sm">Tidak ada data yang cocok dengan pencarian.</div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function filterPembayaran() {
    const q = document.getElementById('searchPembayaran').value.toLowerCase().trim();
    const status = document.getElementById('filterPembayaranStatus').value;
    
    // 1. Filter Desktop Rows
    const rows = document.querySelectorAll('#pembayaranTable tbody tr[data-status]');
    let visibleRows = 0;
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        const rowStatus = row.getAttribute('data-status') || '';
        const matchQ = !q || text.includes(q);
        let matchStatus = true;
        if (status === 'paid') {
            matchStatus = rowStatus === 'paid';
        } else if (status === 'unpaid') {
            matchStatus = rowStatus !== 'paid';
        }
        const show = matchQ && matchStatus;
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
    const cards = document.querySelectorAll('#pembayaranMobileList .mobile-card-item');
    let visibleCards = 0;
    cards.forEach(card => {
        const text = card.textContent.toLowerCase();
        const cardStatus = card.getAttribute('data-status') || '';
        const matchQ = !q || text.includes(q);
        let matchStatus = true;
        if (status === 'paid') {
            matchStatus = cardStatus === 'paid';
        } else if (status === 'unpaid') {
            matchStatus = cardStatus !== 'paid';
        }
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
    document.getElementById('noResultPembayaran').classList.toggle('hidden', totalVisible > 0);
}
</script>
@endpush
