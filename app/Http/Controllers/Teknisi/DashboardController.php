<?php

namespace App\Http\Controllers\Teknisi;

use App\Http\Controllers\Controller;
use App\Models\Booking;

class DashboardController extends Controller
{
    public function index()
    {
        $user    = auth()->user();
        $teknisi = $user->teknisi;

        if (!$teknisi) {
            return view('teknisi.dashboard', [
                'teknisi'          => null,
                'stats'            => [],
                'upcoming_bookings' => collect(),
            ]);
        }

        $stats = [
            'total_booking'   => Booking::where('teknisi_id', $teknisi->teknisi_id)->count(),
            'pending'         => Booking::where('teknisi_id', $teknisi->teknisi_id)->where('status', 'pending')->count(),
            'accepted'        => Booking::where('teknisi_id', $teknisi->teknisi_id)->where('status', 'accepted')->count(),
            'selesai'         => Booking::where('teknisi_id', $teknisi->teknisi_id)->where('status', 'selesai')->count(),
        ];

        $upcoming_bookings = Booking::with(['user', 'layanan'])
            ->where('teknisi_id', $teknisi->teknisi_id)
            ->whereIn('status', ['pending', 'accepted'])
            ->orderBy('tanggal')
            ->orderBy('jam')
            ->take(10)
            ->get();

        return view('teknisi.dashboard', compact('teknisi', 'stats', 'upcoming_bookings'));
    }

    public function updateStatus(Booking $booking, $status)
    {
        $user    = auth()->user();
        $teknisi = $user->teknisi;

        if (!$teknisi || $booking->teknisi_id !== $teknisi->teknisi_id) {
            abort(403);
        }

        $allowed = ['accepted', 'selesai'];
        if (!in_array($status, $allowed)) {
            abort(400);
        }

        if ($status === 'selesai') {
            $booking->is_teknisi_selesai = true;
            if ($booking->is_user_selesai) {
                $booking->status = 'selesai';
            }
            $booking->save();
            return redirect()->route('teknisi.dashboard')->with('success', 'Anda telah mengonfirmasi selesai. Menunggu konfirmasi dari pelanggan.');
        }

        $booking->update(['status' => $status]);

        return redirect()->route('teknisi.dashboard')->with('success', 'Status booking berhasil diupdate.');
    }
}
