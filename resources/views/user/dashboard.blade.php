@extends('layouts.app')

@section('title', 'Dashboard Saya')

@section('content')
<!-- Page Header -->
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
    <div>
        <h1 class="text-3xl font-extrabold text-[#0B2B40] tracking-tight">
            <i class="fa-solid fa-house-user text-teal-500 me-3"></i>Dashboard Saya
        </h1>
        <p class="text-slate-500 text-sm mt-1">Selamat datang kembali, {{ Auth::user()->name }}!</p>
    </div>
    <div class="flex items-center gap-2 bg-emerald-50 border border-emerald-100 px-4 py-2 rounded-2xl shadow-sm">
        <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></div>
        <span class="text-xs font-bold uppercase tracking-wider text-emerald-700">Akun Terverifikasi</span>
    </div>
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-3 gap-6 mb-8">
    <!-- Total Booking -->
    <div class="glass-premium p-6 relative overflow-hidden group">
        <div class="flex flex-col items-center text-center gap-3 relative z-10">
            <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600 text-xl shadow-sm">
                <i class="fa-regular fa-calendar-check"></i>
            </div>
            <div>
                <h3 class="text-2xl font-black text-[#0B2B40]">{{ $stats['total_booking'] }}</h3>
                <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest">Total Booking</p>
            </div>
        </div>
    </div>

    <!-- Booking Pending -->
    <div class="glass-premium p-6 relative overflow-hidden group">
        <div class="flex flex-col items-center text-center gap-3 relative z-10">
            <div class="w-12 h-12 bg-amber-50 rounded-xl flex items-center justify-center text-amber-600 text-xl shadow-sm">
                <i class="fa-solid fa-clock"></i>
            </div>
            <div>
                <h3 class="text-2xl font-black text-[#0B2B40]">{{ $stats['booking_pending'] }}</h3>
                <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest">Menunggu</p>
            </div>
        </div>
    </div>

    <!-- Booking Selesai -->
    <div class="glass-premium p-6 relative overflow-hidden group">
        <div class="flex flex-col items-center text-center gap-3 relative z-10">
            <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 text-xl shadow-sm">
                <i class="fa-solid fa-check-circle"></i>
            </div>
            <div>
                <h3 class="text-2xl font-black text-[#0B2B40]">{{ $stats['booking_selesai'] }}</h3>
                <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest">Selesai</p>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="glass-premium p-8 mb-8 relative overflow-hidden border-l-4 border-teal-500">
    <div class="flex flex-col md:flex-row items-center gap-8 relative z-10">
        <div class="w-20 h-20 bg-[#0B2B40] rounded-3xl flex items-center justify-center text-white text-3xl shadow-xl shadow-slate-200 flex-shrink-0">
            <i class="fa-regular fa-calendar-plus"></i>
        </div>
        <div class="text-center md:text-left">
            <h5 class="text-xl font-bold text-[#0B2B40] mb-2">Butuh bantuan untuk ikan Anda?</h5>
            <p class="text-slate-500 text-sm mb-6 max-w-lg leading-relaxed">Jadwalkan kunjungan teknisi ahli kami sekarang juga untuk penanganan yang cepat dan profesional langsung ke rumah Anda.</p>
            <a href="{{ route('booking.create') }}" class="btn-teal px-8 py-3 group">
                Booking Sekarang
                <i class="fa-solid fa-arrow-right ms-2 group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>
    </div>
</div>

<!-- Recent Bookings Table -->
<div class="glass-premium p-6">
    <div class="flex items-center justify-between mb-8">
        <h5 class="font-bold flex items-center gap-3 text-[#0B2B40]">
            <i class="fa-regular fa-calendar text-teal-500"></i>
            Booking Terbaru Saya
        </h5>
        <a href="{{ route('booking.index') }}" class="text-xs font-bold text-teal-600 hover:text-teal-700 transition-colors uppercase tracking-wider">
            Lihat Semua
        </a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="table-premium">
            <thead>
                <tr>
                    <th>Teknisi</th>
                    <th>Layanan</th>
                    <th>Jadwal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recent_bookings as $booking)
                <tr>
                    <td class="font-bold text-[#0B2B40]">{{ $booking->teknisi->nama ?? '-' }}</td>
                    <td class="text-slate-600 text-sm">{{ $booking->layanan->nama_layanan ?? '-' }}</td>
                    <td>
                        <div class="text-sm font-bold text-[#0B2B40]">{{ $booking->tanggal }}</div>
                        <div class="text-[10px] text-slate-400 font-medium uppercase tracking-wider">{{ $booking->jam }}</div>
                    </td>
                    <td>
                        @if($booking->status == 'pending')
                            <span class="px-2 py-1 bg-amber-100 text-amber-700 rounded-lg text-[10px] font-bold uppercase tracking-wider border border-amber-200">Pending</span>
                        @elseif($booking->status == 'accepted')
                            <span class="px-2 py-1 bg-emerald-100 text-emerald-700 rounded-lg text-[10px] font-bold uppercase tracking-wider border border-emerald-200">Accepted</span>
                        @else
                            <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-lg text-[10px] font-bold uppercase tracking-wider border border-blue-200">Selesai</span>
                        @endif
                    </td>
                    <td>
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
