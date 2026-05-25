@extends('layouts.app')

@section('title', 'Data Booking')

@section('content')
<!-- Page Header -->
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
    <div>
        <h1 class="text-3xl font-extrabold text-[#0B2B40] tracking-tight">
            <i class="fa-regular fa-calendar-check text-teal-500 me-3"></i>Data Booking
        </h1>
        <p class="text-slate-500 text-sm mt-1">Daftar riwayat dan jadwal pemesanan layanan</p>
    </div>
    @if(auth()->user()->isUser())
    <a href="{{ route('booking.create') }}" class="btn-teal py-2.5 px-6 flex items-center gap-2">
        <i class="fa-solid fa-plus text-xs"></i>
        Buat Booking Baru
    </a>
    @endif
</div>

<div class="glass-premium p-6">
    <!-- Search & Filter Bar -->
    <div class="flex flex-col sm:flex-row gap-3 mb-6">
        <div class="relative flex-1">
            <i class="fa-solid fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-300 text-xs"></i>
            <input type="text" id="searchBooking" placeholder="Cari teknisi, ikan, layanan..." class="input-premium pl-9 text-sm py-2 w-full" oninput="filterBooking()">
        </div>
        <select id="filterStatus" class="input-premium text-sm py-2 w-full sm:w-44" onchange="filterBooking()">
            <option value="">Semua Status</option>
            <option value="paid">Paid</option>
            <option value="pending">Pending</option>
            <option value="accepted">Accepted</option>
            <option value="selesai">Selesai</option>
        </select>
    </div>

    <!-- Mobile Card List View -->
    <div class="block sm:hidden space-y-3.5 mb-4" id="bookingMobileList">
        @forelse($booking as $index => $item)
        @php
            $statusVal = ($item->pembayaran && $item->pembayaran->status == 'paid') ? 'paid' : $item->status;
        @endphp
        <div class="mobile-card-item bg-slate-50/50 p-4 rounded-xl border border-slate-100 shadow-sm space-y-3" data-status="{{ $statusVal }}">
            <!-- Header: No, Teknisi & Status -->
            <div class="flex items-start justify-between gap-3">
                <div class="flex items-center gap-2">
                    <span class="w-6 h-6 flex items-center justify-center bg-slate-100 rounded-lg text-slate-400 font-bold text-xs row-no-mobile">{{ $index + 1 }}</span>
                    <div>
                        <p class="font-bold text-[#0B2B40] text-sm">{{ $item->teknisi->nama ?? '-' }}</p>
                        @if($item->teknisi)
                            <p class="text-[9px] uppercase tracking-widest font-bold {{ $item->teknisi->subtype == 'dokter' ? 'text-blue-500' : 'text-slate-400' }} mt-0.5">
                                <i class="fa-solid {{ $item->teknisi->subtype == 'dokter' ? 'fa-user-doctor' : 'fa-wrench' }} me-1"></i>
                                {{ ucfirst($item->teknisi->subtype ?? 'teknisi') }}
                            </p>
                        @endif
                    </div>
                </div>
                <div class="flex-shrink-0">
                    @if($item->pembayaran && $item->pembayaran->status == 'paid')
                        <span class="px-2.5 py-0.5 bg-emerald-100 text-emerald-700 rounded-lg text-[9px] font-bold uppercase tracking-wider border border-emerald-200">Paid</span>
                    @elseif($item->status == 'pending')
                        <span class="px-2.5 py-0.5 bg-amber-100 text-amber-700 rounded-lg text-[9px] font-bold uppercase tracking-wider border border-amber-200">Pending</span>
                    @elseif($item->status == 'accepted')
                        <span class="px-2.5 py-0.5 bg-blue-100 text-blue-700 rounded-lg text-[9px] font-bold uppercase tracking-wider border border-blue-200">Accepted</span>
                    @elseif($item->status == 'selesai')
                        <span class="px-2.5 py-0.5 bg-emerald-100 text-emerald-700 rounded-lg text-[9px] font-bold uppercase tracking-wider border border-emerald-200">Selesai</span>
                    @else
                        <span class="px-2.5 py-0.5 bg-slate-100 text-slate-500 rounded-lg text-[9px] font-bold uppercase tracking-wider border border-slate-200">{{ $item->status }}</span>
                    @endif
                </div>
            </div>

            <!-- Ikan & Layanan -->
            <div class="bg-white p-3 rounded-lg border border-slate-100 space-y-2">
                <div class="flex items-center gap-3">
                    @if($item->ikan_foto)
                        <img src="{{ asset($item->ikan_foto) }}" class="w-9 h-9 object-cover rounded-md border border-slate-100 shadow-xs flex-shrink-0">
                    @endif
                    <div class="min-w-0">
                        <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest">Hewan / Ikan</p>
                        <p class="text-xs font-bold text-[#0B2B40] truncate">{{ $item->ikan_nama ?? '-' }}</p>
                        <p class="text-[9px] text-slate-400 font-medium uppercase tracking-wider truncate">{{ $item->ikan_jenis ?? '-' }}</p>
                    </div>
                </div>
                <div class="border-t border-slate-50 pt-2">
                    <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest">Layanan Utama</p>
                    <p class="text-xs font-bold text-slate-700 mt-0.5">{{ $item->layanan->nama_layanan ?? '-' }}</p>
                </div>
            </div>

            <!-- Jadwal Info block -->
            <div class="flex items-center justify-between text-xs text-slate-600 bg-white p-3 rounded-lg border border-slate-100">
                <span class="flex items-center gap-1.5 font-bold text-[#0B2B40]"><i class="fa-regular fa-calendar text-teal-500"></i>{{ $item->tanggal }}</span>
                <span class="flex items-center gap-1.5 font-medium text-slate-400 uppercase tracking-widest"><i class="fa-regular fa-clock text-amber-500"></i>{{ $item->jam }}</span>
            </div>

            <!-- Actions block -->
            @if(($item->status == 'pending' && !$item->pembayaran && auth()->user()->isUser()) || auth()->user()->isAdmin() || auth()->id() == $item->user_id)
            <div class="pt-2 border-t border-slate-100 flex gap-2 justify-end">
                @if($item->status == 'pending' && !$item->pembayaran && auth()->user()->isUser())
                    <a href="{{ route('bayar', $item->booking_id) }}" class="flex-1 text-center text-xs font-black bg-teal-500 hover:bg-teal-600 text-white py-2.5 rounded-xl transition-all shadow-md shadow-teal-50 uppercase tracking-widest flex items-center justify-center gap-2">
                        <i class="fa-solid fa-money-bill-wave"></i> Bayar Sekarang
                    </a>
                @endif

                @if(auth()->user()->isAdmin() || auth()->id() == $item->user_id)
                <form action="{{ route('booking.destroy', $item->booking_id) }}" method="POST" class="inline {{ ($item->status == 'pending' && !$item->pembayaran && auth()->user()->isUser()) ? 'w-auto' : 'w-full' }}" onsubmit="return confirm('Yakin ingin membatalkan booking ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full text-center text-xs font-black bg-red-50 hover:bg-red-500 text-red-500 hover:text-white border border-red-100 py-2.5 rounded-xl transition-all uppercase tracking-widest flex items-center justify-center gap-2">
                        <i class="fa-solid fa-trash"></i> Batalkan Booking
                    </button>
                </form>
                @endif
            </div>
            @endif
        </div>
        @empty
        <div class="text-center text-slate-400 py-8 italic bg-slate-50 rounded-xl border border-dashed border-slate-200">
            Belum ada data booking.
        </div>
        @endforelse
    </div>

    <!-- Desktop Table View -->
    <div class="hidden sm:block overflow-x-auto">
        <table class="table-premium" id="bookingTable">
            <thead>
                <tr>
                    <th width="5%" class="text-center">No</th>
                    <th>Teknisi</th>
                    <th>Ikan</th>
                    <th>Layanan</th>
                    <th>Jadwal</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($booking as $index => $item)
                @php
                    $statusVal = ($item->pembayaran && $item->pembayaran->status == 'paid') ? 'paid' : $item->status;
                @endphp
                <tr data-status="{{ $statusVal }}">
                    <td class="text-slate-400 font-bold text-center text-sm row-no">{{ $index + 1 }}</td>
                    <td>
                        <div class="flex flex-col">
                            <span class="font-bold text-[#0B2B40]">{{ $item->teknisi->nama ?? '-' }}</span>
                            @if($item->teknisi)
                                <span class="text-[10px] uppercase tracking-widest font-bold {{ $item->teknisi->subtype == 'dokter' ? 'text-blue-500' : 'text-slate-400' }}">
                                    <i class="fa-solid {{ $item->teknisi->subtype == 'dokter' ? 'fa-user-doctor' : 'fa-wrench' }} me-1"></i>
                                    {{ ucfirst($item->teknisi->subtype ?? 'teknisi') }}
                                </span>
                            @endif
                        </div>
                    </td>
                    <td>
                        <div class="flex items-center gap-3">
                            @if($item->ikan_foto)
                                <img src="{{ asset($item->ikan_foto) }}" class="w-10 h-10 object-cover rounded-lg border border-slate-100 shadow-sm">
                            @endif
                            <div>
                                <p class="text-sm font-bold text-[#0B2B40]">{{ $item->ikan_nama ?? '-' }}</p>
                                <p class="text-[10px] text-slate-400 uppercase tracking-widest font-bold">{{ $item->ikan_jenis ?? '-' }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="text-sm font-semibold text-slate-600">{{ $item->layanan->nama_layanan ?? '-' }}</td>
                    <td>
                        <div class="text-xs flex flex-col gap-1">
                            <span class="flex items-center gap-2 font-bold text-[#0B2B40]"><i class="fa-regular fa-calendar text-teal-500"></i>{{ $item->tanggal }}</span>
                            <span class="flex items-center gap-2 font-medium text-slate-400 uppercase tracking-widest"><i class="fa-regular fa-clock text-amber-500"></i>{{ $item->jam }}</span>
                        </div>
                    </td>
                    <td>
                        @if($item->pembayaran && $item->pembayaran->status == 'paid')
                            <span class="px-2 py-1 bg-emerald-100 text-emerald-700 rounded-lg text-[10px] font-bold uppercase tracking-wider border border-emerald-200">Paid</span>
                        @elseif($item->status == 'pending')
                            <span class="px-2 py-1 bg-amber-100 text-amber-700 rounded-lg text-[10px] font-bold uppercase tracking-wider border border-amber-200">Pending</span>
                        @elseif($item->status == 'accepted')
                            <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-lg text-[10px] font-bold uppercase tracking-wider border border-blue-200">Accepted</span>
                        @elseif($item->status == 'selesai')
                            <span class="px-2 py-1 bg-emerald-100 text-emerald-700 rounded-lg text-[10px] font-bold uppercase tracking-wider border border-emerald-200">Selesai</span>
                        @else
                            <span class="px-2 py-1 bg-slate-100 text-slate-500 rounded-lg text-[10px] font-bold uppercase tracking-wider border border-slate-200">{{ $item->status }}</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="flex items-center justify-center gap-2">
                            @if($item->status == 'pending' && !$item->pembayaran && auth()->user()->isUser())
                                <a href="{{ route('bayar', $item->booking_id) }}" class="w-8 h-8 flex items-center justify-center bg-teal-500 text-white rounded-xl hover:bg-teal-600 transition-all shadow-lg shadow-teal-100" title="Bayar Sekarang">
                                    <i class="fa-solid fa-money-bill-wave text-xs"></i>
                                </a>
                            @endif

                            @if(auth()->user()->isAdmin() || auth()->id() == $item->user_id)
                            <form action="{{ route('booking.destroy', $item->booking_id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin membatalkan booking ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-8 h-8 flex items-center justify-center bg-red-50 text-red-500 border border-red-100 rounded-lg hover:bg-red-500 hover:text-white transition-all shadow-sm" title="Batalkan">
                                    <i class="fa-solid fa-trash text-xs"></i>
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr id="emptyRow">
                    <td colspan="7" class="text-center text-slate-400 py-12 italic">Belum ada data booking.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div id="noResultBooking" class="hidden text-center text-slate-400 py-12 italic text-sm">Tidak ada data yang cocok dengan pencarian.</div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function filterBooking() {
    const q = document.getElementById('searchBooking').value.toLowerCase().trim();
    const status = document.getElementById('filterStatus').value;
    
    // 1. Filter Desktop Rows
    const rows = document.querySelectorAll('#bookingTable tbody tr[data-status]');
    let visibleRows = 0;
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        const rowStatus = row.getAttribute('data-status') || '';
        const matchQ = !q || text.includes(q);
        const matchStatus = !status || rowStatus === status;
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
    const cards = document.querySelectorAll('#bookingMobileList .mobile-card-item');
    let visibleCards = 0;
    cards.forEach(card => {
        const text = card.textContent.toLowerCase();
        const cardStatus = card.getAttribute('data-status') || '';
        const matchQ = !q || text.includes(q);
        const matchStatus = !status || cardStatus === status;
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
    document.getElementById('noResultBooking').classList.toggle('hidden', totalVisible > 0);
}
</script>
@endpush
