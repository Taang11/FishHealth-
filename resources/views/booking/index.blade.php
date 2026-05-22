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
    <div class="overflow-x-auto">
        <table class="table-premium">
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
                <tr>
                    <td class="text-slate-400 font-bold text-center text-sm">{{ $index + 1 }}</td>
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
                                <a href="{{ route('bayar', $item->booking_id) }}" class="w-8 h-8 flex items-center justify-center bg-teal-500 text-white rounded-lg hover:bg-teal-600 transition-all shadow-lg shadow-teal-100" title="Bayar Sekarang">
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
                <tr>
                    <td colspan="7" class="text-center text-slate-400 py-12 italic">Belum ada data booking.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
