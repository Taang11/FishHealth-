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
    <div class="overflow-x-auto">
        <table class="table-premium">
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
                <tr>
                    <td class="text-slate-400 font-bold text-center text-sm">{{ $index + 1 }}</td>
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
                <tr>
                    <td colspan="8" class="text-center text-slate-400 py-12 italic">Belum ada riwayat pembayaran.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
