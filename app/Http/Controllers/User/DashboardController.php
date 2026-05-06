<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Ikan;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $stats = [
            'total_booking'    => Booking::where('user_id', $user->id)->count(),
            'booking_pending'  => Booking::where('user_id', $user->id)->where('status', 'pending')->count(),
            'booking_selesai'  => Booking::where('user_id', $user->id)->where('status', 'selesai')->count(),
        ];

        $recent_bookings = Booking::with(['teknisi', 'layanan'])
            ->where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        return view('user.dashboard', compact('stats', 'recent_bookings'));
    }

    public function markSelesai(Booking $booking)
    {
        $user = auth()->user();

        if ($booking->user_id !== $user->id) {
            abort(403);
        }

        if ($booking->status !== 'accepted') {
            return back()->with('error', 'Booking belum bisa diselesaikan.');
        }

        $booking->is_user_selesai = true;
        if ($booking->is_teknisi_selesai) {
            $booking->status = 'selesai';
        }
        $booking->save();

        return redirect()->route('user.dashboard')->with('success', 'Anda telah mengonfirmasi pesanan selesai.');
    }
}
