@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<!-- Page Header -->
<div class="flex flex-col sm:flex-row sm:items-start md:items-center justify-between gap-3 mb-6 sm:mb-8">
    <div>
        <h1 class="page-title flex items-center gap-2 sm:gap-3">
            <i class="fa-solid fa-gauge-high text-teal-500 text-2xl sm:text-3xl"></i>
            <span>Dashboard Admin</span>
        </h1>
        <p class="text-slate-500 text-xs sm:text-sm mt-1">Ringkasan operasional FishHealth +</p>
    </div>
    <div class="flex flex-wrap items-center gap-2">
        <div class="badge-pill bg-slate-100 border border-slate-200 text-slate-600">
            <div class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></div>
            Administrator
        </div>
        <!-- Export Buttons -->
        <a href="{{ route('admin.laporan.excel') }}" class="btn-premium px-3 py-1.5 sm:px-4 sm:py-2 text-xs flex items-center gap-1.5 bg-emerald-600 hover:bg-emerald-700">
            <i class="fa-solid fa-file-excel"></i> Excel
        </a>
        <a href="{{ route('admin.laporan.pdf') }}" target="_blank" class="btn-premium px-3 py-1.5 sm:px-4 sm:py-2 text-xs flex items-center gap-1.5 bg-rose-600 hover:bg-rose-700">
            <i class="fa-solid fa-file-pdf"></i> PDF
        </a>
    </div>
</div>

<!-- Stats Grid - 2x2 on mobile, 4 cols on large -->
<div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 md:gap-6 mb-6 sm:mb-8">
    <!-- Total Users -->
    <div class="glass-premium p-3 sm:p-5 relative overflow-hidden group">
        <div class="absolute -right-3 -bottom-3 text-slate-50 text-5xl transform group-hover:scale-110 transition-transform">
            <i class="fa-solid fa-users"></i>
        </div>
        <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-4 relative z-10">
            <div class="w-8 h-8 sm:w-12 sm:h-12 bg-blue-50 rounded-lg sm:rounded-xl flex items-center justify-center text-blue-600 text-sm sm:text-xl shadow-sm flex-shrink-0">
                <i class="fa-solid fa-users"></i>
            </div>
            <div>
                <p class="text-slate-400 text-[9px] sm:text-[10px] font-bold uppercase tracking-widest leading-tight">Total Users</p>
                <h3 class="text-xl sm:text-2xl font-black text-[#0B2B40] leading-tight">{{ $stats['total_users'] }}</h3>
            </div>
        </div>
    </div>

    <!-- Total Teknisi -->
    <div class="glass-premium p-3 sm:p-5 relative overflow-hidden group">
        <div class="absolute -right-3 -bottom-3 text-slate-50 text-5xl transform group-hover:scale-110 transition-transform">
            <i class="fa-solid fa-user-doctor"></i>
        </div>
        <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-4 relative z-10">
            <div class="w-8 h-8 sm:w-12 sm:h-12 bg-emerald-50 rounded-lg sm:rounded-xl flex items-center justify-center text-emerald-600 text-sm sm:text-xl shadow-sm flex-shrink-0">
                <i class="fa-solid fa-user-doctor"></i>
            </div>
            <div>
                <p class="text-slate-400 text-[9px] sm:text-[10px] font-bold uppercase tracking-widest leading-tight">Total Teknisi</p>
                <h3 class="text-xl sm:text-2xl font-black text-[#0B2B40] leading-tight">{{ $stats['total_teknisi'] }}</h3>
            </div>
        </div>
    </div>

    <!-- Total Booking -->
    <div class="glass-premium p-3 sm:p-5 relative overflow-hidden group">
        <div class="absolute -right-3 -bottom-3 text-slate-50 text-5xl transform group-hover:scale-110 transition-transform">
            <i class="fa-regular fa-calendar-check"></i>
        </div>
        <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-4 relative z-10">
            <div class="w-8 h-8 sm:w-12 sm:h-12 bg-amber-50 rounded-lg sm:rounded-xl flex items-center justify-center text-amber-600 text-sm sm:text-xl shadow-sm flex-shrink-0">
                <i class="fa-regular fa-calendar-check"></i>
            </div>
            <div>
                <p class="text-slate-400 text-[9px] sm:text-[10px] font-bold uppercase tracking-widest leading-tight">Total Booking</p>
                <h3 class="text-xl sm:text-2xl font-black text-[#0B2B40] leading-tight">{{ $stats['total_booking'] }}</h3>
            </div>
        </div>
    </div>

    <!-- Total Revenue -->
    <div class="glass-premium p-3 sm:p-5 relative overflow-hidden group">
        <div class="absolute -right-3 -bottom-3 text-slate-50 text-5xl transform group-hover:scale-110 transition-transform">
            <i class="fa-solid fa-money-bill-wave"></i>
        </div>
        <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-4 relative z-10">
            <div class="w-8 h-8 sm:w-12 sm:h-12 bg-purple-50 rounded-lg sm:rounded-xl flex items-center justify-center text-purple-600 text-sm sm:text-xl shadow-sm flex-shrink-0">
                <i class="fa-solid fa-money-bill-wave"></i>
            </div>
            <div>
                <p class="text-slate-400 text-[9px] sm:text-[10px] font-bold uppercase tracking-widest leading-tight">Pemasukan</p>
                <h3 class="text-base sm:text-xl lg:text-2xl font-black text-[#0B2B40] leading-tight">Rp {{ number_format($stats['total_pembayaran'], 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>
</div>

<!-- Booking Status Summary -->
<div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4 mb-6 sm:mb-8">
    <div class="glass-premium p-4 sm:p-6 flex items-center justify-between group">
        <div>
            <div class="flex items-center gap-2 mb-2">
                <div class="w-2 h-2 bg-amber-500 rounded-full animate-pulse"></div>
                <h5 class="text-slate-400 font-bold uppercase tracking-widest text-[10px]">Booking Pending</h5>
            </div>
            <div class="text-3xl sm:text-4xl lg:text-5xl font-black text-amber-500 mb-1 sm:mb-2">{{ $stats['booking_pending'] }}</div>
            <p class="text-slate-500 text-xs sm:text-sm">Menunggu konfirmasi pembayaran</p>
        </div>
        <a href="{{ route('booking.index') }}" class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-slate-50 border border-slate-100 flex items-center justify-center hover:bg-[#0B2B40] hover:text-white transition-all shadow-sm flex-shrink-0">
            <i class="fa-solid fa-arrow-right text-sm"></i>
        </a>
    </div>

    <div class="glass-premium p-4 sm:p-6 flex items-center justify-between group">
        <div>
            <div class="flex items-center gap-2 mb-2">
                <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></div>
                <h5 class="text-slate-400 font-bold uppercase tracking-widest text-[10px]">Booking Accepted</h5>
            </div>
            <div class="text-3xl sm:text-4xl lg:text-5xl font-black text-emerald-500 mb-1 sm:mb-2">{{ $stats['booking_accepted'] }}</div>
            <p class="text-slate-500 text-xs sm:text-sm">Sudah dikonfirmasi dan dibayar</p>
        </div>
        <a href="{{ route('booking.index') }}" class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-slate-50 border border-slate-100 flex items-center justify-center hover:bg-[#0B2B40] hover:text-white transition-all shadow-sm flex-shrink-0">
            <i class="fa-solid fa-arrow-right text-sm"></i>
        </a>
    </div>
</div>

<!-- ── REVENUE CHART ─────────────────────────────────────────── -->
<div class="glass-premium p-4 sm:p-6 mb-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <div>
            <div class="flex items-center gap-3 mb-1">
                <div class="w-1.5 h-6 bg-gradient-to-b from-teal-400 to-[#0B2B40] rounded-full shadow-md shadow-teal-400/20"></div>
                <h5 class="font-bold text-lg text-[#0B2B40]">Grafik Pemasukan Pembayaran</h5>
            </div>
            <p class="text-slate-400 text-xs ml-5">Total gabungan semua teknisi — Tahun {{ $year }}</p>
        </div>
        <div class="flex items-center gap-3 self-start md:self-auto">
            <div class="bg-teal-50 border border-teal-100 rounded-2xl px-5 py-3 text-center">
                <p class="text-[10px] text-teal-600 font-bold uppercase tracking-widest">Total {{ $year }}</p>
                <p class="text-xl font-black text-teal-600">Rp {{ number_format(array_sum($chartData), 0, ',', '.') }}</p>
            </div>
        </div>
    </div>

    <!-- Chart Legend -->
    <div class="flex items-center gap-6 mb-4 ml-1">
        <div class="flex items-center gap-2">
            <div class="w-3.5 h-3.5 rounded-full bg-teal-400 shadow-md shadow-teal-400/30 flex items-center justify-center">
                <div class="w-1.5 h-1.5 rounded-full bg-white"></div>
            </div>
            <span class="text-xs font-bold text-slate-600">Pemasukan Bulanan</span>
        </div>
    </div>

    <div class="relative h-[260px] sm:h-[320px]">
        <canvas id="revenueChart"></canvas>
    </div>

    @if(count($perTeknisiRevenue) > 0)
    <div class="mt-6 border-t border-slate-100 pt-5">
        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-4">Pemasukan Per Teknisi ({{ $year }})</p>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
            @foreach($perTeknisiRevenue as $t)
            <div class="flex items-center justify-between rounded-xl px-4 py-3 bg-slate-50 border border-slate-100">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center text-xs font-bold text-white bg-gradient-to-br from-[#0B2B40] to-[#1B6B82]">
                        {{ substr($t->nama, 0, 1) }}
                    </div>
                    <span class="text-sm font-bold text-[#0B2B40]">{{ $t->nama }}</span>
                </div>
                <span class="text-sm font-black text-teal-600">Rp {{ number_format($t->total, 0, ',', '.') }}</span>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

<!-- Latest Data Tables -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Latest Bookings -->
    <div class="glass-premium p-4 sm:p-6">
        <div class="flex items-center justify-between mb-4">
            <h5 class="font-bold flex items-center gap-3 text-[#0B2B40]">
                <i class="fa-regular fa-calendar text-teal-500"></i>
                Booking Terbaru
            </h5>
            <a href="{{ route('booking.index') }}" class="text-xs font-bold text-teal-600 hover:text-teal-700 transition-colors uppercase tracking-wider">
                Lihat Semua
            </a>
        </div>

        <!-- Search -->
        <div class="mb-4">
            <div class="relative">
                <i class="fa-solid fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-300 text-xs"></i>
                <input type="text" id="searchLatestBooking" placeholder="Cari user atau layanan..." class="input-premium pl-9 text-sm py-2" oninput="filterTableById('latestBookingTable', this.value)">
            </div>
        </div>
        
        <!-- Mobile Card List View -->
        <div class="block sm:hidden space-y-2.5" id="latestBookingTableMobileList">
            @forelse($latest_bookings as $booking)
            <div class="mobile-card-item bg-slate-50/50 p-3.5 rounded-xl border border-slate-100 flex items-center justify-between gap-3">
                <div class="min-w-0">
                    <p class="font-bold text-[#0B2B40] text-sm truncate">{{ $booking->user->name ?? '-' }}</p>
                    <p class="text-slate-500 text-xs mt-0.5 truncate">{{ $booking->layanan->nama_layanan ?? '-' }}</p>
                    <p class="text-[10px] text-slate-400 font-medium mt-1">{{ $booking->tanggal }}</p>
                </div>
                <div class="flex-shrink-0">
                    @if($booking->status == 'pending')
                        <span class="px-2 py-0.5 bg-amber-100 text-amber-700 rounded-lg text-[9px] font-bold uppercase tracking-wider border border-amber-200">Pending</span>
                    @elseif($booking->status == 'accepted')
                        <span class="px-2 py-0.5 bg-emerald-100 text-emerald-700 rounded-lg text-[9px] font-bold uppercase tracking-wider border border-emerald-200">Accepted</span>
                    @else
                        <span class="px-2 py-0.5 bg-blue-100 text-blue-700 rounded-lg text-[9px] font-bold uppercase tracking-wider border border-blue-200">Selesai</span>
                    @endif
                </div>
            </div>
            @empty
            <div class="text-center text-slate-400 py-6 italic text-xs">Belum ada data booking.</div>
            @endforelse
        </div>

        <!-- Desktop Table View -->
        <div class="hidden sm:block overflow-x-auto">
            <table class="table-premium" id="latestBookingTable">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">User</th>
                        <th class="whitespace-nowrap">Layanan</th>
                        <th class="whitespace-nowrap">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($latest_bookings as $booking)
                    <tr>
                        <td class="font-bold text-[#0B2B40] whitespace-nowrap">
                            {{ $booking->user->name ?? '-' }}
                            <div class="text-[10px] text-slate-400 font-medium">{{ $booking->tanggal }}</div>
                        </td>
                        <td class="text-slate-600 text-sm whitespace-nowrap">{{ $booking->layanan->nama_layanan ?? '-' }}</td>
                        <td class="whitespace-nowrap">
                            @if($booking->status == 'pending')
                                <span class="px-2 py-1 bg-amber-100 text-amber-700 rounded-lg text-[10px] font-bold uppercase tracking-wider border border-amber-200">Pending</span>
                            @elseif($booking->status == 'accepted')
                                <span class="px-2 py-1 bg-emerald-100 text-emerald-700 rounded-lg text-[10px] font-bold uppercase tracking-wider border border-emerald-200">Accepted</span>
                            @else
                                <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-lg text-[10px] font-bold uppercase tracking-wider border border-blue-200">Selesai</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center text-slate-400 py-8 italic">Belum ada data booking.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Latest Payments -->
    <div class="glass-premium p-4 sm:p-6">
        <div class="flex items-center justify-between mb-4">
            <h5 class="font-bold flex items-center gap-3 text-[#0B2B40]">
                <i class="fa-solid fa-wallet text-emerald-500"></i>
                Pembayaran Terbaru
            </h5>
            <a href="{{ route('pembayaran.index') }}" class="text-xs font-bold text-emerald-600 hover:text-emerald-700 transition-colors uppercase tracking-wider">
                Lihat Semua
            </a>
        </div>

        <!-- Search -->
        <div class="mb-4">
            <div class="relative">
                <i class="fa-solid fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-300 text-xs"></i>
                <input type="text" id="searchLatestPembayaran" placeholder="Cari user atau layanan..." class="input-premium pl-9 text-sm py-2" oninput="filterTableById('latestPembayaranTable', this.value)">
            </div>
        </div>
        
        <!-- Mobile Card List View -->
        <div class="block sm:hidden space-y-2.5" id="latestPembayaranTableMobileList">
            @forelse($latest_pembayaran as $p)
            <div class="mobile-card-item bg-slate-50/50 p-3.5 rounded-xl border border-slate-100 flex items-center justify-between gap-3">
                <div class="min-w-0">
                    <p class="font-bold text-[#0B2B40] text-sm truncate">{{ $p->booking->user->name ?? '-' }}</p>
                    <p class="text-slate-500 text-xs mt-0.5 truncate">{{ $p->booking->layanan->nama_layanan ?? '-' }}</p>
                </div>
                <div class="text-right flex-shrink-0">
                    <p class="text-emerald-600 font-black text-xs">Rp {{ number_format($p->jumlah, 0, ',', '.') }}</p>
                    <span class="inline-block px-2 py-0.5 bg-emerald-100 text-emerald-700 rounded-lg text-[9px] font-bold uppercase tracking-wider border border-emerald-200 mt-1">Paid</span>
                </div>
            </div>
            @empty
            <div class="text-center text-slate-400 py-6 italic text-xs">Belum ada data pembayaran.</div>
            @endforelse
        </div>

        <!-- Desktop Table View -->
        <div class="hidden sm:block overflow-x-auto">
            <table class="table-premium" id="latestPembayaranTable">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">User</th>
                        <th class="whitespace-nowrap">Jumlah</th>
                        <th class="whitespace-nowrap">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($latest_pembayaran as $p)
                    <tr>
                        <td class="font-bold text-[#0B2B40] whitespace-nowrap">
                            {{ $p->booking->user->name ?? '-' }}
                            <div class="text-[10px] text-slate-400 font-medium">{{ $p->booking->layanan->nama_layanan ?? '-' }}</div>
                        </td>
                        <td class="text-emerald-600 font-black text-sm whitespace-nowrap">Rp {{ number_format($p->jumlah, 0, ',', '.') }}</td>
                        <td class="whitespace-nowrap">
                            <span class="px-2 py-1 bg-emerald-100 text-emerald-700 rounded-lg text-[10px] font-bold uppercase tracking-wider border border-emerald-200">Paid</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center text-slate-400 py-8 italic">Belum ada data pembayaran.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
(function() {
    const months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
    const revenues = @json(array_values($chartData));

    const ctx = document.getElementById('revenueChart').getContext('2d');

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

// Generic table filter by id (supports desktop tables and mobile card lists)
function filterTableById(tableId, query) {
    const q = query.toLowerCase().trim();
    
    // Desktop view filtering
    const table = document.getElementById(tableId);
    if (table) {
        const rows = table.querySelectorAll('tbody tr');
        rows.forEach(row => {
            row.style.display = (!q || row.textContent.toLowerCase().includes(q)) ? '' : 'none';
        });
    }
    
    // Mobile card view filtering (using dynamic ID tableId + 'MobileList')
    const mobileList = document.getElementById(tableId + 'MobileList');
    if (mobileList) {
        const cards = mobileList.querySelectorAll('.mobile-card-item');
        cards.forEach(card => {
            card.style.display = (!q || card.textContent.toLowerCase().includes(q)) ? '' : 'none';
        });
    }
}
</script>
@endpush
