@extends('layouts.app')

@section('title', 'Dashboard Teknisi')

@section('content')
<!-- Page Header -->
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
    <div>
        <h1 class="text-3xl font-extrabold text-[#0B2B40] tracking-tight">
            <i class="fa-solid {{ $teknisi && $teknisi->subtype == 'dokter' ? 'fa-user-doctor' : 'fa-user-gear' }} text-teal-500 me-3"></i>
            Dashboard {{ $teknisi ? ucfirst($teknisi->subtype ?? 'Teknisi') : 'Teknisi' }}
        </h1>
        <p class="text-slate-500 text-sm mt-1">Ringkasan pekerjaan dan profil Anda</p>
    </div>
    @if($teknisi)
    <div class="flex items-center gap-2 bg-amber-50 border border-amber-100 px-4 py-2 rounded-2xl shadow-sm">
        <div class="w-2 h-2 bg-amber-500 rounded-full animate-pulse"></div>
        <span class="text-xs font-bold uppercase tracking-wider text-amber-700">{{ $teknisi->nama }}</span>
    </div>
    @endif
</div>

@if(!$teknisi)
<div class="glass-premium p-12 text-center border-l-4 border-amber-500">
    <div class="w-20 h-20 bg-amber-50 rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-sm">
        <i class="fa-solid fa-triangle-exclamation text-amber-500 text-3xl"></i>
    </div>
    <h4 class="text-xl font-bold text-[#0B2B40] mb-2">Profil Teknisi Belum Dibuat</h4>
    <p class="text-slate-500 max-w-md mx-auto leading-relaxed">Silakan hubungi administrator untuk melengkapi data profil teknisi Anda agar dapat mulai menerima pesanan pelanggan.</p>
</div>
@else

<!-- Stats Grid -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8">
    <div class="glass-premium p-6 text-center group hover:scale-[1.02]">
        <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600 mx-auto mb-3 shadow-sm">
            <i class="fa-solid fa-list"></i>
        </div>
        <h3 class="text-2xl font-black text-[#0B2B40]">{{ $stats['total_booking'] }}</h3>
        <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest">Total Booking</p>
    </div>

    <div class="glass-premium p-6 text-center group hover:scale-[1.02]">
        <div class="w-10 h-10 bg-amber-50 rounded-xl flex items-center justify-center text-amber-600 mx-auto mb-3 shadow-sm">
            <i class="fa-solid fa-clock"></i>
        </div>
        <h3 class="text-2xl font-black text-[#0B2B40]">{{ $stats['pending'] }}</h3>
        <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest">Menunggu</p>
    </div>

    <div class="glass-premium p-6 text-center group hover:scale-[1.02]">
        <div class="w-10 h-10 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 mx-auto mb-3 shadow-sm">
            <i class="fa-solid fa-thumbs-up"></i>
        </div>
        <h3 class="text-2xl font-black text-[#0B2B40]">{{ $stats['accepted'] }}</h3>
        <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest">Diterima</p>
    </div>

    <div class="glass-premium p-6 text-center group hover:scale-[1.02]">
        <div class="w-10 h-10 bg-purple-50 rounded-xl flex items-center justify-center text-purple-600 mx-auto mb-3 shadow-sm">
            <i class="fa-solid fa-star"></i>
        </div>
        <h3 class="text-2xl font-black text-[#0B2B40]">{{ $stats['selesai'] }}</h3>
        <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest">Selesai</p>
    </div>
</div>

<!-- Profile Info -->
<div class="glass-premium p-8 mb-8 border-l-4 border-[#0B2B40]">
    <div class="flex items-center gap-4 mb-8">
        <div class="w-1.5 h-6 bg-[#0B2B40] rounded-full"></div>
        <h5 class="text-lg font-bold text-[#0B2B40]">Profil Saya</h5>
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
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 shadow-sm">
                <i class="fa-solid fa-user"></i>
            </div>
            <div>
                <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest">Nama Lengkap</p>
                <p class="text-[#0B2B40] font-bold">{{ $teknisi->nama }}</p>
            </div>
        </div>
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 shadow-sm">
                <i class="fa-brands fa-whatsapp"></i>
            </div>
            <div>
                <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest">No. WhatsApp</p>
                <p class="text-[#0B2B40] font-bold">{{ $teknisi->no_hp }}</p>
            </div>
        </div>
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-600 shadow-sm">
                <i class="fa-solid fa-location-dot"></i>
            </div>
            <div>
                <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest">Wilayah Tugas</p>
                <p class="text-[#0B2B40] font-bold">{{ \Illuminate\Support\Str::limit($teknisi->alamat, 30) }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Bookings Table -->
<div class="glass-premium p-6">
    <div class="flex items-center gap-4 mb-8">
        <div class="w-1.5 h-6 bg-teal-500 rounded-full"></div>
        <h5 class="text-lg font-bold text-[#0B2B40]">Jadwal Booking Saya</h5>
    </div>
    
    <div class="overflow-x-auto">
        <table class="table-premium">
            <thead>
                <tr>
                    <th>Pelanggan</th>
                    <th>Ikan</th>
                    <th>Layanan</th>
                    <th>Jadwal</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($upcoming_bookings as $booking)
                <tr>
                    <td class="font-bold text-[#0B2B40]">{{ $booking->user->name ?? '-' }}</td>
                    <td>
                        <div class="flex items-center gap-3">
                            @if($booking->ikan_foto)
                                <img src="{{ asset($booking->ikan_foto) }}" class="w-10 h-10 object-cover rounded-lg border border-slate-100 shadow-sm">
                            @endif
                            <div>
                                <p class="text-sm font-bold text-[#0B2B40]">{{ $booking->ikan_nama ?? '-' }}</p>
                                <p class="text-[10px] text-slate-400 font-medium uppercase tracking-wider">{{ $booking->ikan_jenis ?? '-' }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="text-slate-600 text-sm">{{ $booking->layanan->nama_layanan ?? '-' }}</td>
                    <td>
                        <div class="text-xs text-slate-600 flex flex-col gap-1">
                            <span class="flex items-center gap-2 font-bold text-[#0B2B40]"><i class="fa-regular fa-calendar text-teal-500"></i>{{ $booking->tanggal }}</span>
                            <span class="flex items-center gap-2 font-medium text-slate-400 uppercase tracking-widest"><i class="fa-regular fa-clock text-amber-500"></i>{{ $booking->jam }}</span>
                        </div>
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
                    <td class="text-center">
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
                <tr>
                    <td colspan="6" class="text-center text-slate-400 py-8 italic">Tidak ada jadwal booking.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endif
@endsection
