@extends('layouts.app')

@section('title', 'Checkout Pembayaran')

@section('content')
<div class="max-w-xl mx-auto">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-[#0B2B40] tracking-tight">
                <i class="fa-solid fa-credit-card text-teal-500 me-3"></i>Checkout
            </h1>
            <p class="text-slate-500 text-sm mt-1">Selesaikan pembayaran untuk mengkonfirmasi pesanan</p>
        </div>
        <a href="{{ route('booking.index') }}" class="btn-premium-outline flex items-center gap-2">
            <i class="fa-solid fa-arrow-left text-xs"></i>
            Batal
        </a>
    </div>

    <div class="glass-premium p-10 text-center relative overflow-hidden">
        <div class="absolute -right-20 -top-20 w-64 h-64 bg-teal-50 rounded-full blur-3xl"></div>
        
        <div class="w-20 h-20 bg-slate-50 border border-slate-100 rounded-3xl flex items-center justify-center text-[#0B2B40] text-3xl mx-auto mb-8 shadow-sm">
            <i class="fa-solid fa-file-invoice-dollar"></i>
        </div>
        
        <h3 class="text-xl font-bold text-[#0B2B40] mb-8">Detail Tagihan Layanan</h3>
        
        <div class="space-y-4 mb-12 text-left">
            <div class="flex justify-between items-center p-4 bg-slate-50 border border-slate-100 rounded-2xl shadow-sm">
                <span class="text-slate-400 text-[10px] font-bold uppercase tracking-widest">Layanan</span>
                <span class="text-[#0B2B40] font-bold">{{ $booking->layanan->nama_layanan }}</span>
            </div>
            <div class="flex justify-between items-center p-4 bg-slate-50 border border-slate-100 rounded-2xl shadow-sm">
                <span class="text-slate-400 text-[10px] font-bold uppercase tracking-widest">Teknisi</span>
                <span class="text-[#0B2B40] font-bold">{{ $booking->teknisi->nama ?? '-' }}</span>
            </div>
            <div class="flex justify-between items-center p-4 bg-slate-50 border border-slate-100 rounded-2xl shadow-sm">
                <span class="text-slate-400 text-[10px] font-bold uppercase tracking-widest">Jadwal</span>
                <span class="text-[#0B2B40] font-bold">{{ $booking->tanggal }} ({{ $booking->jam }})</span>
            </div>
            <div class="flex justify-between items-center p-6 bg-[#0B2B40] rounded-2xl shadow-xl shadow-blue-900/10 mt-8">
                <span class="text-white/50 text-[10px] font-bold uppercase tracking-widest">Total Pembayaran</span>
                <span class="text-3xl font-black text-white">Rp {{ number_format($booking->layanan->harga, 0, ',', '.') }}</span>
            </div>
        </div>

        <button id="pay-button" class="btn-teal w-full py-4 text-lg group shadow-xl shadow-teal-500/20">
            <i class="fa-solid fa-shield-halved me-2 group-hover:scale-110 transition-transform"></i>
            Bayar Sekarang Aman
        </button>
        
        <p class="text-slate-400 text-[10px] font-bold mt-8 flex items-center justify-center gap-2 uppercase tracking-widest">
            <i class="fa-solid fa-lock text-emerald-500"></i>
            Pembayaran Aman via Midtrans
        </p>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
<script type="text/javascript">
    document.getElementById('pay-button').onclick = function(){
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result){
                window.location.href = "{{ route('midtrans.finish') }}?order_id=" + result.order_id;
            },
            onPending: function(result){
                alert("Menunggu pembayaran! Silakan selesaikan transaksi Anda.");
            },
            onError: function(result){
                alert("Pembayaran gagal! Silakan coba lagi.");
            }
        });
    };
</script>
@endpush
