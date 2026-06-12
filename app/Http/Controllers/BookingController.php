<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Teknisi;
use App\Models\Layanan;
use App\Models\Ikan;
use App\Services\FonnteService;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            $booking = Booking::with(['teknisi', 'layanan', 'user', 'pembayaran'])->latest()->get();
        } elseif ($user->isTeknisi()) {
            $teknisi = $user->teknisi;
            $booking = $teknisi
                ? Booking::with(['layanan', 'user', 'pembayaran'])->where('teknisi_id', $teknisi->teknisi_id)->latest()->get()
                : collect();
        } else {
            $booking = Booking::with(['teknisi', 'layanan', 'pembayaran'])->where('user_id', $user->id)->latest()->get();
        }

        return view('booking.index', compact('booking'));
    }

    public function create()
    {
        if (!auth()->user()->isUser()) {
            abort(403, 'Akses ditolak. Hanya pelanggan yang dapat membuat booking baru.');
        }

        $teknisi = Teknisi::all();
        $layanan = Layanan::all();
        $master_ikan = Ikan::all();
        return view('booking.create', compact('teknisi', 'layanan', 'master_ikan'));
    }

    public function store(Request $request)
    {
        if (!auth()->user()->isUser()) {
            abort(403, 'Akses ditolak. Hanya pelanggan yang dapat membuat booking baru.');
        }

        $request->validate([
            'teknisi_id' => 'required|exists:teknisi,teknisi_id',
            'layanan_id' => 'required|exists:layanan,layanan_id',
            'ikan_nama'  => 'required|string|max:255',
            'ikan_jenis' => 'required|string|max:255',
            'ikan_foto'  => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal'    => 'required|date',
            'jam'        => 'required',
        ]);

        // ── Server-side: pastikan layanan sesuai subtype teknisi ──
        $teknisi = \App\Models\Teknisi::findOrFail($request->teknisi_id);
        $layanan = \App\Models\Layanan::findOrFail($request->layanan_id);

        if ($teknisi->subtype !== $layanan->subtype) {
            $label = $teknisi->subtype === 'dokter' ? 'Dokter Ikan' : 'Teknisi Kolam';
            return back()
                ->withInput()
                ->with('error', "Layanan yang dipilih tidak sesuai dengan tipe \"{$label}\". Silakan pilih layanan yang benar.");
        }

        // Cek double booking
        $cek = Booking::where('teknisi_id', $request->teknisi_id)
            ->where('tanggal', $request->tanggal)
            ->where('jam', $request->jam)
            ->exists();

        if ($cek) {
            return back()->with('error', 'Jadwal teknisi sudah diambil pada waktu tersebut. Silakan pilih waktu lain.');
        }

        // Handle upload foto ikan
        $fotoPath = null;
        if ($request->hasFile('ikan_foto')) {
            $file = $request->file('ikan_foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/ikan'), $filename);
            $fotoPath = 'uploads/ikan/' . $filename;
        }

        $booking = Booking::create([
            'user_id'    => auth()->id(),
            'teknisi_id' => $request->teknisi_id,
            'layanan_id' => $request->layanan_id,
            'ikan_nama'  => $request->ikan_nama,
            'ikan_jenis' => $request->ikan_jenis,
            'ikan_foto'  => $fotoPath,
            'tanggal'    => $request->tanggal,
            'jam'        => $request->jam,
            'status'     => 'pending',
        ]);

        // ── Kirim notifikasi WhatsApp ke teknisi via Fonnte ──────────
        $this->kirimNotifTeknisi($booking);

        return redirect()->route('booking.index')->with('success', 'Booking berhasil dibuat!');
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);

        // Hanya admin atau pemilik yang boleh hapus
        if (!auth()->user()->isAdmin() && $booking->user_id !== auth()->id()) {
            abort(403);
        }

        $booking->delete();
        return redirect()->route('booking.index')->with('success', 'Booking berhasil dihapus.');
    }

    // ────────────────────────────────────────────────────────────────
    // Private: Kirim notifikasi WA ke teknisi
    // ────────────────────────────────────────────────────────────────
    private function kirimNotifTeknisi(Booking $booking): void
    {
        // Load relasi yang dibutuhkan untuk pesan
        $booking->load(['teknisi', 'layanan', 'user']);

        $teknisi = $booking->teknisi;
        $layanan = $booking->layanan;
        $user    = $booking->user;

        // Pastikan teknisi punya nomor HP
        if (!$teknisi || empty($teknisi->no_hp)) {
            return;
        }

        $tanggal = \Carbon\Carbon::parse($booking->tanggal)->translatedFormat('l, d F Y');
        $jam     = \Carbon\Carbon::parse($booking->jam)->format('H:i');

        $pesan = "🐟 *BOOKING BARU - Klinik Ikan*\n\n"
               . "Halo *{$teknisi->nama}*, Anda mendapatkan booking baru!\n\n"
               . "📋 *Detail Booking:*\n"
               . "• Pelanggan : {$user->name}\n"
               . "• Layanan   : {$layanan->nama_layanan}\n"
               . "• Tanggal   : {$tanggal}\n"
               . "• Jam       : {$jam} WIB\n"
               . "• Status    : Pending\n\n"
               . "Silakan konfirmasi ketersediaan Anda melalui aplikasi.\n"
               . "_Pesan ini dikirim otomatis oleh sistem Klinik Ikan._";

        app(FonnteService::class)->send($teknisi->no_hp, $pesan);
    }
}
