<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Layanan;
use App\Models\Teknisi;
use App\Models\Pembayaran;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users'      => User::where('role', 'user')->count(),
            'total_teknisi'    => Teknisi::count(),
            'total_booking'    => Booking::count(),
            'total_pembayaran' => Pembayaran::where('status', 'paid')->sum('jumlah'),
            'booking_pending'  => Booking::where('status', 'pending')->count(),
            'booking_accepted' => Booking::where('status', 'accepted')->count(),
        ];

        $latest_bookings = Booking::with(['user', 'teknisi', 'layanan'])
            ->latest()
            ->take(5)
            ->get();

        $latest_pembayaran = Pembayaran::with(['booking.user', 'booking.layanan'])
            ->where('status', 'paid')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'latest_bookings', 'latest_pembayaran'));
    }
}
