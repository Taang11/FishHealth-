@extends('layouts.app')

@section('title', 'Dashboard Teknisi')

@section('content')
<!-- Page Header -->
<div class="flex flex-col sm:flex-row sm:items-start md:items-center justify-between gap-3 mb-6 sm:mb-8">
    <div>
        <h1 class="page-title flex items-center gap-2 sm:gap-3">
            <i class="fa-solid {{ $teknisi && $teknisi->subtype == 'dokter' ? 'fa-user-doctor' : 'fa-user-gear' }} text-teal-500 text-2xl sm:text-3xl"></i>
            <span>Dashboard {{ $teknisi ? ucfirst($teknisi->subtype ?? 'Teknisi') : 'Teknisi' }}</span>
        </h1>
        <p class="text-slate-500 text-xs sm:text-sm mt-1">Ringkasan pekerjaan dan profil Anda</p>
    </div>
    @if($teknisi)
    <div class="badge-pill bg-amber-50 border border-amber-100 text-amber-700">
        <div class="w-1.5 h-1.5 bg-amber-500 rounded-full animate-pulse"></div>
        {{ $teknisi->nama }}
    </div>
    @endif
</div>

@if(!$teknisi)
<div class="glass-premium p-8 sm:p-12 text-center border-l-4 border-amber-500">
    <div class="w-20 h-20 bg-amber-50 rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-sm">
        <i class="fa-solid fa-triangle-exclamation text-amber-500 text-3xl"></i>
    </div>
    <h4 class="text-xl font-bold text-[#0B2B40] mb-2">Profil Teknisi Belum Dibuat</h4>
    <p class="text-slate-500 max-w-md mx-auto leading-relaxed">Silakan hubungi administrator untuk melengkapi data profil teknisi Anda agar dapat mulai menerima pesanan pelanggan.</p>
</div>
@else

<!-- Stats Grid - 2×2 on mobile, 4 cols on md+ -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4 mb-6 sm:mb-8">
    <div class="glass-premium p-3 sm:p-5 text-center group hover:scale-[1.02]">
        <div class="w-9 h-9 sm:w-10 sm:h-10 bg-blue-50 rounded-lg sm:rounded-xl flex items-center justify-center text-blue-600 text-sm sm:text-base mx-auto mb-2 shadow-sm">
            <i class="fa-solid fa-list"></i>
        </div>
        <h3 class="text-xl sm:text-2xl font-black text-[#0B2B40]">{{ $stats['total_booking'] }}</h3>
        <p class="text-slate-400 text-[9px] sm:text-[10px] font-bold uppercase tracking-widest leading-tight">Total Booking</p>
    </div>

    <div class="glass-premium p-3 sm:p-5 text-center group hover:scale-[1.02]">
        <div class="w-9 h-9 sm:w-10 sm:h-10 bg-amber-50 rounded-lg sm:rounded-xl flex items-center justify-center text-amber-600 text-sm sm:text-base mx-auto mb-2 shadow-sm">
            <i class="fa-solid fa-clock"></i>
        </div>
        <h3 class="text-xl sm:text-2xl font-black text-[#0B2B40]">{{ $stats['pending'] }}</h3>
        <p class="text-slate-400 text-[9px] sm:text-[10px] font-bold uppercase tracking-widest leading-tight">Menunggu</p>
    </div>

    <div class="glass-premium p-3 sm:p-5 text-center group hover:scale-[1.02]">
        <div class="w-9 h-9 sm:w-10 sm:h-10 bg-emerald-50 rounded-lg sm:rounded-xl flex items-center justify-center text-emerald-600 text-sm sm:text-base mx-auto mb-2 shadow-sm">
            <i class="fa-solid fa-thumbs-up"></i>
        </div>
        <h3 class="text-xl sm:text-2xl font-black text-[#0B2B40]">{{ $stats['accepted'] }}</h3>
        <p class="text-slate-400 text-[9px] sm:text-[10px] font-bold uppercase tracking-widest leading-tight">Diterima</p>
    </div>

    <div class="glass-premium p-3 sm:p-5 text-center group hover:scale-[1.02]">
        <div class="w-9 h-9 sm:w-10 sm:h-10 bg-purple-50 rounded-lg sm:rounded-xl flex items-center justify-center text-purple-600 text-sm sm:text-base mx-auto mb-2 shadow-sm">
            <i class="fa-solid fa-star"></i>
        </div>
        <h3 class="text-xl sm:text-2xl font-black text-[#0B2B40]">{{ $stats['selesai'] }}</h3>
        <p class="text-slate-400 text-[9px] sm:text-[10px] font-bold uppercase tracking-widest leading-tight">Selesai</p>
    </div>
</div>

<!-- ── REVENUE CHART ─────────────────────────────────────────── -->
<div class="glass-premium p-4 sm:p-6 mb-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <div>
            <div class="flex items-center gap-3 mb-1">
                <div class="w-1.5 h-6 bg-gradient-to-b from-teal-400 to-[#0B2B40] rounded-full shadow-md shadow-teal-400/20"></div>
                <h5 class="font-bold text-lg text-[#0B2B40]">Grafik Pemasukan Saya</h5>
            </div>
            <p class="text-slate-400 text-xs ml-5">Pendapatan bulanan Anda — Tahun {{ $year }}</p>
        </div>
        <div class="flex items-center gap-3 self-start md:self-auto">
            <div class="bg-teal-50 border border-teal-100 rounded-2xl px-5 py-3 text-center">
                <p class="text-[10px] text-teal-600 font-bold uppercase tracking-widest">Total {{ $year }}</p>
                <p class="text-lg font-black text-teal-600">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>

    <!-- Chart Legend -->
    <div class="flex items-center gap-6 mb-4 ml-1">
        <div class="flex items-center gap-2">
            <div class="w-3.5 h-3.5 rounded-full bg-teal-400 shadow-md shadow-teal-400/30 flex items-center justify-center">
                <div class="w-1.5 h-1.5 rounded-full bg-white"></div>
            </div>
            <span class="text-xs font-bold text-slate-600">Pendapatan Bulanan</span>
        </div>
    </div>

    <div class="relative h-[260px] sm:h-[320px]">
        <canvas id="teknisiRevenueChart"></canvas>
    </div>
</div>

<!-- Profile Info -->
<div class="glass-premium p-4 sm:p-6 lg:p-8 mb-6 sm:mb-8 border-l-4 border-[#0B2B40]">
    <div class="flex items-center gap-3 mb-4 sm:mb-6">
        <div class="w-1.5 h-5 sm:h-6 bg-[#0B2B40] rounded-full"></div>
        <h5 class="text-base sm:text-lg font-bold text-[#0B2B40]">Profil Saya</h5>
    </div>
    {{-- Subtype badge --}}
    @if($teknisi)
    <div class="mb-4">
        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest border
            {{ $teknisi->subtype == 'dokter' ? 'bg-blue-50 text-blue-600 border-blue-100' : 'bg-slate-100 text-slate-500 border-slate-200' }}">
            <i class="fa-solid {{ $teknisi->subtype == 'dokter' ? 'fa-user-doctor' : 'fa-wrench' }}"></i>
            {{ ucfirst($teknisi->subtype ?? 'teknisi') }}
        </span>
    </div>
    @endif
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6">
        <div class="flex items-center gap-3 pb-3 sm:pb-0 border-b border-slate-100 sm:border-b-0">
            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-blue-50 rounded-xl sm:rounded-2xl flex items-center justify-center text-blue-600 shadow-sm flex-shrink-0">
                <i class="fa-solid fa-user text-sm sm:text-base"></i>
            </div>
            <div>
                <p class="text-slate-400 text-[9px] sm:text-[10px] font-bold uppercase tracking-widest">Nama Lengkap</p>
                <p class="text-[#0B2B40] font-bold text-sm sm:text-base">{{ $teknisi->nama }}</p>
            </div>
        </div>
        <div class="flex items-center gap-3 pb-3 sm:pb-0 border-b border-slate-100 sm:border-b-0">
            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-emerald-50 rounded-xl sm:rounded-2xl flex items-center justify-center text-emerald-600 shadow-sm flex-shrink-0">
                <i class="fa-brands fa-whatsapp text-sm sm:text-base"></i>
            </div>
            <div>
                <p class="text-slate-400 text-[9px] sm:text-[10px] font-bold uppercase tracking-widest">No. WhatsApp</p>
                <p class="text-[#0B2B40] font-bold text-sm sm:text-base">{{ $teknisi->no_hp }}</p>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-amber-50 rounded-xl sm:rounded-2xl flex items-center justify-center text-amber-600 shadow-sm flex-shrink-0">
                <i class="fa-solid fa-location-dot text-sm sm:text-base"></i>
            </div>
            <div>
                <p class="text-slate-400 text-[9px] sm:text-[10px] font-bold uppercase tracking-widest">Wilayah Tugas</p>
                <p class="text-[#0B2B40] font-bold text-sm sm:text-base">{{ \Illuminate\Support\Str::limit($teknisi->alamat, 30) }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Bookings Table -->
<div class="glass-premium p-4 sm:p-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <div class="flex items-center gap-4">
            <div class="w-1.5 h-6 bg-teal-500 rounded-full"></div>
            <h5 class="text-lg font-bold text-[#0B2B40]">Jadwal Booking Saya</h5>
        </div>
        <!-- Search & Filter -->
        <div class="flex flex-col sm:flex-row gap-2 w-full md:w-auto">
            <div class="relative">
                <i class="fa-solid fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-300 text-xs"></i>
                <input type="text" id="searchBookingTeknisi" placeholder="Cari pelanggan atau layanan..." class="input-premium pl-9 text-sm py-2 w-full sm:w-56" oninput="filterBookingTeknisi()">
            </div>
            <select id="filterStatusTeknisi" class="input-premium text-sm py-2 w-full sm:w-36" onchange="filterBookingTeknisi()">
                <option value="">Semua Status</option>
                <option value="pending">Pending</option>
                <option value="accepted">Accepted</option>
                <option value="selesai">Selesai</option>
            </select>
        </div>
    </div>

    <!-- Mobile Card List View -->
    <div class="block sm:hidden space-y-3.5 mb-4" id="bookingTeknisiMobileList">
        @forelse($upcoming_bookings as $booking)
        <div class="mobile-card-item bg-slate-50/50 p-4 rounded-xl border border-slate-100 shadow-sm space-y-3" data-status="{{ $booking->status }}">
            <!-- Header: Pelanggan & Status -->
            <div class="flex items-start justify-between gap-3">
                <div>
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Pelanggan</p>
                    <p class="font-bold text-[#0B2B40] text-sm mt-0.5">{{ $booking->user->name ?? '-' }}</p>
                </div>
                <div class="flex-shrink-0">
                    @if($booking->status == 'pending')
                        <span class="px-2.5 py-0.5 bg-amber-100 text-amber-700 rounded-lg text-[9px] font-bold uppercase tracking-wider border border-amber-200">Pending</span>
                    @elseif($booking->status == 'accepted')
                        <span class="px-2.5 py-0.5 bg-emerald-100 text-emerald-700 rounded-lg text-[9px] font-bold uppercase tracking-wider border border-emerald-200">Accepted</span>
                    @else
                        <span class="px-2.5 py-0.5 bg-blue-100 text-blue-700 rounded-lg text-[9px] font-bold uppercase tracking-wider border border-blue-200">Selesai</span>
                    @endif
                </div>
            </div>

            <!-- Ikan & Layanan -->
            <div class="bg-white p-3 rounded-lg border border-slate-100 space-y-2">
                <div class="flex items-center gap-3">
                    @if($booking->ikan_foto)
                        <img src="{{ asset($booking->ikan_foto) }}" class="w-9 h-9 object-cover rounded-md border border-slate-100 shadow-xs flex-shrink-0">
                    @endif
                    <div class="min-w-0">
                        <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest">Hewan / Ikan</p>
                        <p class="text-xs font-bold text-[#0B2B40] truncate">{{ $booking->ikan_nama ?? '-' }}</p>
                        <p class="text-[9px] text-slate-400 font-medium uppercase tracking-wider truncate">{{ $booking->ikan_jenis ?? '-' }}</p>
                    </div>
                </div>
                <div class="border-t border-slate-50 pt-2">
                    <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest">Layanan Utama</p>
                    <p class="text-xs font-bold text-slate-700 mt-0.5">{{ $booking->layanan->nama_layanan ?? '-' }}</p>
                </div>
            </div>

            <!-- Jadwal Info block -->
            <div class="flex items-center justify-between text-xs text-slate-600 bg-white p-3 rounded-lg border border-slate-100">
                <span class="flex items-center gap-1.5 font-bold text-[#0B2B40]"><i class="fa-regular fa-calendar text-teal-500"></i>{{ $booking->tanggal }}</span>
                <span class="flex items-center gap-1.5 font-medium text-slate-400 uppercase tracking-widest"><i class="fa-regular fa-clock text-amber-500"></i>{{ $booking->jam }}</span>
            </div>

            <!-- Mobile action buttons -->
            @if($booking->status == 'pending' || ($booking->status == 'accepted' && !$booking->is_teknisi_selesai))
            <div class="pt-2 border-t border-slate-100 flex justify-end">
                @if($booking->status == 'pending')
                    <form action="{{ route('teknisi.booking.update-status', [$booking->booking_id, 'accepted']) }}" method="POST" class="w-full">
                        @csrf @method('PATCH')
                        <button type="submit" class="w-full text-center text-xs font-black bg-teal-500 hover:bg-teal-600 text-white py-2.5 rounded-xl transition-all shadow-md shadow-teal-50 uppercase tracking-widest">
                            Terima Pekerjaan
                        </button>
                    </form>
                @elseif($booking->status == 'accepted' && !$booking->is_teknisi_selesai)
                    <form action="{{ route('teknisi.booking.update-status', [$booking->booking_id, 'selesai']) }}" method="POST" class="w-full">
                        @csrf @method('PATCH')
                        <button type="submit" class="w-full text-center text-xs font-black bg-emerald-500 hover:bg-emerald-600 text-white py-2.5 rounded-xl transition-all shadow-md shadow-emerald-50 uppercase tracking-widest">
                            Selesaikan Pekerjaan
                        </button>
                    </form>
                @endif
            </div>
            @elseif($booking->status == 'accepted' && $booking->is_teknisi_selesai)
            <div class="text-center pt-1.5">
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider italic">Menunggu Konfirmasi User</span>
            </div>
            @endif
        </div>
        @empty
        <div class="text-center text-slate-400 py-6 italic text-xs">Tidak ada jadwal booking.</div>
        @endforelse
    </div>

    <!-- Desktop Table View -->
    <div class="hidden sm:block overflow-x-auto">
        <table class="table-premium" id="bookingTeknisiTable">
            <thead>
                <tr>
                    <th class="whitespace-nowrap">Pelanggan</th>
                    <th class="whitespace-nowrap">Ikan</th>
                    <th class="whitespace-nowrap">Layanan</th>
                    <th class="whitespace-nowrap">Jadwal</th>
                    <th class="whitespace-nowrap">Status</th>
                    <th class="whitespace-nowrap text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($upcoming_bookings as $booking)
                <tr data-status="{{ $booking->status }}">
                    <td class="font-bold text-[#0B2B40] whitespace-nowrap">{{ $booking->user->name ?? '-' }}</td>
                    <td class="whitespace-nowrap">
                        <div class="flex items-center gap-3">
                            @if($booking->ikan_foto)
                                <img src="{{ asset($booking->ikan_foto) }}" class="w-10 h-10 object-cover rounded-lg border border-slate-100 shadow-sm flex-shrink-0">
                            @endif
                            <div>
                                <p class="text-sm font-bold text-[#0B2B40]">{{ $booking->ikan_nama ?? '-' }}</p>
                                <p class="text-[10px] text-slate-400 font-medium uppercase tracking-wider">{{ $booking->ikan_jenis ?? '-' }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="text-slate-600 text-sm whitespace-nowrap">{{ $booking->layanan->nama_layanan ?? '-' }}</td>
                    <td class="whitespace-nowrap">
                        <div class="text-xs text-slate-600 flex flex-col gap-1">
                            <span class="flex items-center gap-2 font-bold text-[#0B2B40]"><i class="fa-regular fa-calendar text-teal-500"></i>{{ $booking->tanggal }}</span>
                            <span class="flex items-center gap-2 font-medium text-slate-400 uppercase tracking-widest"><i class="fa-regular fa-clock text-amber-500"></i>{{ $booking->jam }}</span>
                        </div>
                    </td>
                    <td class="whitespace-nowrap">
                        @if($booking->status == 'pending')
                            <span class="px-2 py-1 bg-amber-100 text-amber-700 rounded-lg text-[10px] font-bold uppercase tracking-wider border border-amber-200">Pending</span>
                        @elseif($booking->status == 'accepted')
                            <span class="px-2 py-1 bg-emerald-100 text-emerald-700 rounded-lg text-[10px] font-bold uppercase tracking-wider border border-emerald-200">Accepted</span>
                        @else
                            <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-lg text-[10px] font-bold uppercase tracking-wider border border-blue-200">Selesai</span>
                        @endif
                    </td>
                    <td class="text-center whitespace-nowrap">
                        @if($booking->status == 'pending')
                            <form action="{{ route('teknisi.booking.update-status', [$booking->booking_id, 'accepted']) }}" method="POST">
                                @csrf @method('PATCH')
                                <button type="submit" class="text-[10px] font-black bg-teal-500 hover:bg-teal-600 text-white px-4 py-2 rounded-xl transition-all shadow-lg shadow-teal-50 uppercase tracking-widest">
                                    Terima
                                </button>
                            </form>
                        @elseif($booking->status == 'accepted')
                            @if(!$booking->is_teknisi_selesai)
                                <form action="{{ route('teknisi.booking.update-status', [$booking->booking_id, 'selesai']) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="text-[10px] font-black bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-xl transition-all shadow-lg shadow-emerald-50 uppercase tracking-widest">
                                        Selesai
                                    </button>
                                </form>
                            @else
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider italic">Menunggu User</span>
                            @endif
                        @else
                            <span class="text-slate-300">-</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr id="emptyRow">
                    <td colspan="6" class="text-center text-slate-400 py-8 italic">Tidak ada jadwal booking.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div id="noResultTeknisi" class="hidden text-center text-slate-400 py-8 italic text-sm">Tidak ada data yang cocok dengan pencarian.</div>
    </div>
</div>

@endif
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
(function() {
    const el = document.getElementById('teknisiRevenueChart');
    if (!el) return;

    const months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
    const revenues = @json(array_values($chartData));

    const ctx = el.getContext('2d');

    // Gradient fill for the area chart (Teal-400 to transparent)
    const areaGradient = ctx.createLinearGradient(0, 0, 0, 320);
    areaGradient.addColorStop(0, 'rgba(45, 212, 191, 0.28)');
    areaGradient.addColorStop(0.5, 'rgba(45, 212, 191, 0.08)');
    areaGradient.addColorStop(1, 'rgba(45, 212, 191, 0.0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: months,
            datasets: [
                {
                    label: 'Pemasukan',
                    data: revenues,
                    borderColor: '#14B8A6',
                    backgroundColor: areaGradient,
                    borderWidth: 3,
                    pointBackgroundColor: '#FFFFFF',
                    pointBorderColor: '#14B8A6',
                    pointBorderWidth: 3,
                    pointRadius: revenues.map(v => v > 0 ? 5 : 0),
                    pointHitRadius: 10,
                    pointHoverRadius: 7,
                    pointHoverBackgroundColor: '#14B8A6',
                    pointHoverBorderColor: '#FFFFFF',
                    pointHoverBorderWidth: 3,
                    tension: 0.38,
                    fill: true,
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: {
                duration: 1000,
                easing: 'easeOutQuart',
            },
            plugins: {
                legend: { display: false },
                tooltip: {
                    enabled: true,
                    backgroundColor: 'rgba(11, 43, 64, 0.95)',
                    titleColor: '#2DD4BF',
                    bodyColor: '#FFFFFF',
                    borderColor: 'rgba(255,255,255,0.1)',
                    borderWidth: 1,
                    padding: 12,
                    cornerRadius: 12,
                    displayColors: false,
                    callbacks: {
                        title: function(items) { return items[0].label; },
                        label: function(item) {
                            const v = item.parsed.y;
                            if (v === 0) return '  Tidak ada pemasukan';
                            return '  Rp ' + v.toLocaleString('id-ID');
                        },
                        afterLabel: function(item) {
                            const v = item.parsed.y;
                            if (v === 0) return null;
                            const total = revenues.reduce((a,b) => a+b, 0);
                            if (total === 0) return null;
                            return '  ' + ((v / total) * 100).toFixed(1) + '% dari total';
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    border: { display: false },
                    ticks: {
                        color: 'rgba(100, 116, 139, 0.8)',
                        font: { size: 11, weight: '600', family: 'Plus Jakarta Sans' }
                    }
                },
                y: {
                    grid: {
                        color: 'rgba(15, 23, 42, 0.05)',
                        drawBorder: false,
                        lineWidth: 1,
                    },
                    border: { display: false, dash: [4, 4] },
                    ticks: {
                        color: 'rgba(100, 116, 139, 0.8)',
                        font: { size: 10, family: 'Plus Jakarta Sans' },
                        padding: 8,
                        callback: function(val) {
                            if (val === 0) return '';
                            if (val >= 1000000) return 'Rp ' + (val/1000000).toFixed(1) + 'Jt';
                            if (val >= 1000) return 'Rp ' + (val/1000).toFixed(0) + 'Rb';
                            return 'Rp ' + val;
                        }
                    }
                }
            }
        }
    });
})();

function filterBookingTeknisi() {
    const q = document.getElementById('searchBookingTeknisi')?.value.toLowerCase().trim() || '';
    const statusFilter = document.getElementById('filterStatusTeknisi')?.value || '';
    let visible = 0;

    // Filter Desktop rows
    const rows = document.querySelectorAll('#bookingTeknisiTable tbody tr[data-status]');
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        const status = row.getAttribute('data-status') || '';
        const matchQ = !q || text.includes(q);
        const matchStatus = !statusFilter || status === statusFilter;
        const show = matchQ && matchStatus;
        row.style.display = show ? '' : 'none';
        if (show) visible++;
    });

    // Filter Mobile card items
    const cards = document.querySelectorAll('#bookingTeknisiMobileList .mobile-card-item');
    let mobileVisible = 0;
    cards.forEach(card => {
        const text = card.textContent.toLowerCase();
        const status = card.getAttribute('data-status') || '';
        const matchQ = !q || text.includes(q);
        const matchStatus = !statusFilter || status === statusFilter;
        const show = matchQ && matchStatus;
        card.style.display = show ? '' : 'none';
        if (show) mobileVisible++;
    });

    const finalVisible = Math.max(visible, mobileVisible);
    const noResult = document.getElementById('noResultTeknisi');
    if (noResult) noResult.classList.toggle('hidden', finalVisible > 0);
}
</script>
@endpush
