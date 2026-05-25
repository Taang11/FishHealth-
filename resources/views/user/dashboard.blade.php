@extends('layouts.app')

@section('title', 'Dashboard Saya')

@section('content')
<!-- Page Header -->
<div class="flex flex-col sm:flex-row sm:items-start md:items-center justify-between gap-3 mb-6 sm:mb-8">
    <div>
        <h1 class="page-title flex items-center gap-2 sm:gap-3">
            <i class="fa-solid fa-house-user text-teal-500 text-2xl sm:text-3xl"></i>
            <span>Dashboard Saya</span>
        </h1>
        <p class="text-slate-500 text-xs sm:text-sm mt-1">Selamat datang kembali, <span class="font-semibold text-[#0B2B40]">{{ Auth::user()->name }}</span>!</p>
    </div>
    <div class="badge-pill bg-emerald-50 border border-emerald-100 text-emerald-700 self-start sm:self-auto">
        <div class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></div>
        Akun Terverifikasi
    </div>
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-3 gap-2.5 sm:gap-6 mb-8">
    <!-- Total Booking -->
    <div class="glass-premium p-2.5 sm:p-6 relative overflow-hidden group">
        <div class="flex flex-col items-center text-center gap-1.5 sm:gap-3 relative z-10">
            <div class="hidden sm:flex w-12 h-12 bg-blue-50 rounded-xl items-center justify-center text-blue-600 text-xl shadow-sm">
                <i class="fa-regular fa-calendar-check"></i>
            </div>
            <div>
                <h3 class="text-base sm:text-2xl font-black text-[#0B2B40] leading-tight">{{ $stats['total_booking'] }}</h3>
                <p class="text-slate-400 text-[9px] sm:text-[10px] font-bold uppercase tracking-widest leading-tight mt-0.5">Total Booking</p>
            </div>
        </div>
    </div>

    <!-- Booking Pending -->
    <div class="glass-premium p-2.5 sm:p-6 relative overflow-hidden group">
        <div class="flex flex-col items-center text-center gap-1.5 sm:gap-3 relative z-10">
            <div class="hidden sm:flex w-12 h-12 bg-amber-50 rounded-xl items-center justify-center text-amber-600 text-xl shadow-sm">
                <i class="fa-solid fa-clock"></i>
            </div>
            <div>
                <h3 class="text-base sm:text-2xl font-black text-[#0B2B40] leading-tight">{{ $stats['booking_pending'] }}</h3>
                <p class="text-slate-400 text-[9px] sm:text-[10px] font-bold uppercase tracking-widest leading-tight mt-0.5">Menunggu</p>
            </div>
        </div>
    </div>

    <!-- Booking Selesai -->
    <div class="glass-premium p-2.5 sm:p-6 relative overflow-hidden group">
        <div class="flex flex-col items-center text-center gap-1.5 sm:gap-3 relative z-10">
            <div class="hidden sm:flex w-12 h-12 bg-emerald-50 rounded-xl items-center justify-center text-emerald-600 text-xl shadow-sm">
                <i class="fa-solid fa-check-circle"></i>
            </div>
            <div>
                <h3 class="text-base sm:text-2xl font-black text-[#0B2B40] leading-tight">{{ $stats['booking_selesai'] }}</h3>
                <p class="text-slate-400 text-[9px] sm:text-[10px] font-bold uppercase tracking-widest leading-tight mt-0.5">Selesai</p>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="glass-premium p-3.5 sm:p-6 lg:p-8 mb-6 sm:mb-8 relative overflow-hidden border-l-4 border-teal-500">
    <div class="flex flex-row items-center gap-3 sm:gap-6 lg:gap-8 relative z-10">
        <div class="w-10 h-10 sm:w-16 sm:h-16 lg:w-20 lg:h-20 bg-[#0B2B40] rounded-xl sm:rounded-2xl lg:rounded-3xl flex items-center justify-center text-white text-sm sm:text-2xl lg:text-3xl shadow-xl shadow-slate-200 flex-shrink-0">
            <i class="fa-regular fa-calendar-plus"></i>
        </div>
        <div class="flex-1 min-w-0">
            <h5 class="text-base sm:text-lg lg:text-xl font-bold text-[#0B2B40] mb-1 sm:mb-2">Butuh bantuan untuk ikan Anda?</h5>
            <p class="text-slate-500 text-xs sm:text-sm mb-3 sm:mb-5 leading-relaxed hidden sm:block">Jadwalkan kunjungan teknisi ahli kami sekarang juga untuk penanganan yang cepat dan profesional langsung ke rumah Anda.</p>
            <a href="{{ route('booking.create') }}" class="btn-teal px-3.5 sm:px-6 lg:px-8 py-2 sm:py-2.5 lg:py-3 text-xs sm:text-sm group inline-flex items-center">
                Booking Sekarang
                <i class="fa-solid fa-arrow-right ms-2 group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>
    </div>
</div>

<!-- Recent Bookings Table -->
<div class="glass-premium p-4 sm:p-6">
    <div class="flex items-center justify-between mb-4 sm:mb-6">
        <h5 class="font-bold flex items-center gap-2 sm:gap-3 text-[#0B2B40] text-sm sm:text-base">
            <i class="fa-regular fa-calendar text-teal-500"></i>
            Booking Terbaru Saya
        </h5>
        <a href="{{ route('booking.index') }}" class="text-[10px] sm:text-xs font-bold text-teal-600 hover:text-teal-700 transition-colors uppercase tracking-wider whitespace-nowrap">
            Lihat Semua
        </a>
    </div>
    <!-- Mobile Card List View -->
    <div class="block sm:hidden space-y-3.5" id="userBookingMobileList">
        @forelse($recent_bookings as $booking)
        <div class="mobile-card-item bg-slate-50/50 p-4 rounded-xl border border-slate-100 shadow-sm space-y-3" data-status="{{ $booking->status }}">
            <!-- Header: Teknisi & Status -->
            <div class="flex items-start justify-between gap-3">
                <div>
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Teknisi</p>
                    <p class="font-bold text-[#0B2B40] text-sm mt-0.5">{{ $booking->teknisi->nama ?? '-' }}</p>
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
            @if($booking->status == 'pending' || $booking->status == 'accepted')
            <div class="pt-2 border-t border-slate-100 flex justify-end">
                @if($booking->status == 'pending')
                    <a href="{{ route('bayar', $booking->booking_id) }}" class="w-full text-center text-xs font-black bg-teal-500 hover:bg-teal-600 text-white py-2.5 rounded-xl transition-all shadow-md shadow-teal-50 uppercase tracking-widest flex items-center justify-center gap-2">
                        <i class="fa-solid fa-money-bill-wave"></i> Bayar Sekarang
                    </a>
                @elseif($booking->status == 'accepted')
                    @if(!$booking->is_user_selesai)
                        <form action="{{ route('user.booking.mark-selesai', $booking->booking_id) }}" method="POST" class="w-full">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="w-full text-center text-xs font-black bg-emerald-500 hover:bg-emerald-600 text-white py-2.5 rounded-xl transition-all shadow-md shadow-emerald-50 uppercase tracking-widest flex items-center justify-center gap-2">
                                <i class="fa-solid fa-circle-check"></i> Selesaikan Pesanan
                            </button>
                        </form>
                    @else
                        <span class="w-full block text-center text-xs font-bold text-slate-400 uppercase tracking-wider py-2 bg-slate-100/50 border border-slate-100 rounded-xl italic">Menunggu Konfirmasi</span>
                    @endif
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

    <!-- Desktop Tabular View -->
    <div class="hidden sm:block overflow-x-auto">
        <table class="table-premium">
            <thead>
                <tr>
                    <th class="whitespace-nowrap">Teknisi</th>
                    <th class="whitespace-nowrap">Layanan</th>
                    <th class="whitespace-nowrap">Jadwal</th>
                    <th class="whitespace-nowrap">Status</th>
                    <th class="whitespace-nowrap">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recent_bookings as $booking)
                <tr>
                    <td class="font-bold text-[#0B2B40] whitespace-nowrap">{{ $booking->teknisi->nama ?? '-' }}</td>
                    <td class="text-slate-600 text-sm whitespace-nowrap">{{ $booking->layanan->nama_layanan ?? '-' }}</td>
                    <td class="whitespace-nowrap">
                        <div class="text-sm font-bold text-[#0B2B40]">{{ $booking->tanggal }}</div>
                        <div class="text-[10px] text-slate-400 font-medium uppercase tracking-wider">{{ $booking->jam }}</div>
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
                    <td class="whitespace-nowrap">
                        @if($booking->status == 'pending')
                            <a href="{{ route('bayar', $booking->booking_id) }}" class="inline-flex items-center justify-center w-9 h-9 bg-teal-500 text-white rounded-xl hover:bg-teal-600 transition-all shadow-lg shadow-teal-100" title="Bayar Sekarang">
                                <i class="fa-solid fa-money-bill-wave"></i>
                            </a>
                        @elseif($booking->status == 'accepted')
                            @if(!$booking->is_user_selesai)
                                <form action="{{ route('user.booking.mark-selesai', $booking->booking_id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-[10px] font-bold bg-emerald-500 hover:bg-emerald-600 text-white px-3 py-2 rounded-lg transition-all uppercase tracking-widest">
                                        Selesai
                                    </button>
                                </form>
                            @else
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider italic">Menunggu Teknisi</span>
                            @endif
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-slate-400 py-12 italic">Belum ada data booking.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
