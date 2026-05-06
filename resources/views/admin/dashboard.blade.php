@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<!-- Page Header -->
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
    <div>
        <h1 class="text-3xl font-extrabold text-[#0B2B40] tracking-tight">
            <i class="fa-solid fa-gauge-high text-teal-500 me-3"></i>Dashboard Admin
        </h1>
        <p class="text-slate-500 text-sm mt-1">Ringkasan operasional FishHealth +</p>
    </div>
    <div class="flex items-center gap-3">
        <div class="flex items-center gap-2 bg-slate-100 border border-slate-200 px-4 py-2 rounded-2xl mr-2">
            <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></div>
            <span class="text-xs font-bold uppercase tracking-wider text-slate-600">Administrator</span>
        </div>
        
        <!-- Export Buttons -->
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.laporan.excel') }}" class="btn-premium px-4 py-2 text-xs flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700">
                <i class="fa-solid fa-file-excel"></i> Excel
            </a>
            <a href="{{ route('admin.laporan.pdf') }}" target="_blank" class="btn-premium px-4 py-2 text-xs flex items-center gap-2 bg-rose-600 hover:bg-rose-700">
                <i class="fa-solid fa-file-pdf"></i> PDF / Cetak
            </a>
        </div>
    </div>
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Users -->
    <div class="glass-premium p-6 relative overflow-hidden group">
        <div class="absolute -right-4 -bottom-4 text-slate-50 text-6xl transform group-hover:scale-110 transition-transform">
            <i class="fa-solid fa-users"></i>
        </div>
        <div class="flex items-center gap-4 relative z-10">
            <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600 text-xl shadow-sm">
                <i class="fa-solid fa-users"></i>
            </div>
            <div>
                <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest">Total Users</p>
                <h3 class="text-2xl font-black text-[#0B2B40]">{{ $stats['total_users'] }}</h3>
            </div>
        </div>
    </div>

    <!-- Total Teknisi -->
    <div class="glass-premium p-6 relative overflow-hidden group">
        <div class="absolute -right-4 -bottom-4 text-slate-50 text-6xl transform group-hover:scale-110 transition-transform">
            <i class="fa-solid fa-user-doctor"></i>
        </div>
        <div class="flex items-center gap-4 relative z-10">
            <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 text-xl shadow-sm">
                <i class="fa-solid fa-user-doctor"></i>
            </div>
            <div>
                <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest">Total Teknisi</p>
                <h3 class="text-2xl font-black text-[#0B2B40]">{{ $stats['total_teknisi'] }}</h3>
            </div>
        </div>
    </div>

    <!-- Total Booking -->
    <div class="glass-premium p-6 relative overflow-hidden group">
        <div class="absolute -right-4 -bottom-4 text-slate-50 text-6xl transform group-hover:scale-110 transition-transform">
            <i class="fa-regular fa-calendar-check"></i>
        </div>
        <div class="flex items-center gap-4 relative z-10">
            <div class="w-12 h-12 bg-amber-50 rounded-xl flex items-center justify-center text-amber-600 text-xl shadow-sm">
                <i class="fa-regular fa-calendar-check"></i>
            </div>
            <div>
                <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest">Total Booking</p>
                <h3 class="text-2xl font-black text-[#0B2B40]">{{ $stats['total_booking'] }}</h3>
            </div>
        </div>
    </div>

    <!-- Total Revenue -->
    <div class="glass-premium p-6 relative overflow-hidden group">
        <div class="absolute -right-4 -bottom-4 text-slate-50 text-6xl transform group-hover:scale-110 transition-transform">
            <i class="fa-solid fa-money-bill-wave"></i>
        </div>
        <div class="flex items-center gap-4 relative z-10">
            <div class="w-12 h-12 bg-purple-50 rounded-xl flex items-center justify-center text-purple-600 text-xl shadow-sm">
                <i class="fa-solid fa-money-bill-wave"></i>
            </div>
            <div>
                <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest">Pemasukan</p>
                <h3 class="text-2xl font-black text-[#0B2B40]">Rp {{ number_format($stats['total_pembayaran'], 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>
</div>

<!-- Booking Status Summary -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    <div class="glass-premium p-8 flex items-center justify-between group">
        <div>
            <div class="flex items-center gap-3 mb-2">
                <div class="w-2 h-2 bg-amber-500 rounded-full animate-pulse"></div>
                <h5 class="text-slate-400 font-bold uppercase tracking-widest text-[10px]">Booking Pending</h5>
            </div>
            <div class="text-5xl font-black text-amber-500 mb-2">{{ $stats['booking_pending'] }}</div>
            <p class="text-slate-500 text-sm">Menunggu konfirmasi pembayaran</p>
        </div>
        <a href="{{ route('booking.index') }}" class="w-12 h-12 rounded-full bg-slate-50 border border-slate-100 flex items-center justify-center hover:bg-[#0B2B40] hover:text-white transition-all shadow-sm">
            <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>

    <div class="glass-premium p-8 flex items-center justify-between group">
        <div>
            <div class="flex items-center gap-3 mb-2">
                <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></div>
                <h5 class="text-slate-400 font-bold uppercase tracking-widest text-[10px]">Booking Accepted</h5>
            </div>
            <div class="text-5xl font-black text-emerald-500 mb-2">{{ $stats['booking_accepted'] }}</div>
            <p class="text-slate-500 text-sm">Sudah dikonfirmasi dan dibayar</p>
        </div>
        <a href="{{ route('booking.index') }}" class="w-12 h-12 rounded-full bg-slate-50 border border-slate-100 flex items-center justify-center hover:bg-[#0B2B40] hover:text-white transition-all shadow-sm">
            <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>
</div>

<!-- Latest Data Tables -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Latest Bookings -->
    <div class="glass-premium p-6">
        <div class="flex items-center justify-between mb-6">
            <h5 class="font-bold flex items-center gap-3 text-[#0B2B40]">
                <i class="fa-regular fa-calendar text-teal-500"></i>
                Booking Terbaru
            </h5>
            <a href="{{ route('booking.index') }}" class="text-xs font-bold text-teal-600 hover:text-teal-700 transition-colors uppercase tracking-wider">
                Lihat Semua
            </a>
        </div>
        
        <div class="overflow-x-auto">
            <table class="table-premium">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Layanan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($latest_bookings as $booking)
                    <tr>
                        <td class="font-bold text-[#0B2B40]">
                            {{ $booking->user->name ?? '-' }}
                            <div class="text-[10px] text-slate-400 font-medium">{{ $booking->tanggal }}</div>
                        </td>
                        <td class="text-slate-600 text-sm">{{ $booking->layanan->nama_layanan ?? '-' }}</td>
                        <td>
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
    <div class="glass-premium p-6">
        <div class="flex items-center justify-between mb-6">
            <h5 class="font-bold flex items-center gap-3 text-[#0B2B40]">
                <i class="fa-solid fa-wallet text-emerald-500"></i>
                Pembayaran Terbaru
            </h5>
            <a href="{{ route('pembayaran.index') }}" class="text-xs font-bold text-emerald-600 hover:text-emerald-700 transition-colors uppercase tracking-wider">
                Lihat Semua
            </a>
        </div>
        
        <div class="overflow-x-auto">
            <table class="table-premium">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($latest_pembayaran as $p)
                    <tr>
                        <td class="font-bold text-[#0B2B40]">
                            {{ $p->booking->user->name ?? '-' }}
                            <div class="text-[10px] text-slate-400 font-medium">ID: {{ $p->order_id }}</div>
                        </td>
                        <td class="text-emerald-600 font-black text-sm">Rp {{ number_format($p->jumlah, 0, ',', '.') }}</td>
                        <td>
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
