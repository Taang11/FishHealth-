<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Layanan;
use App\Models\Teknisi;
use App\Models\Pembayaran;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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

        // Monthly revenue chart - all technicians combined (current year)
        $year = date('Y');
        $monthlyRevenue = Pembayaran::where('status', 'paid')
            ->whereYear('created_at', $year)
            ->select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(jumlah) as total')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        $chartData = [];
        for ($m = 1; $m <= 12; $m++) {
            $chartData[$m] = $monthlyRevenue[$m] ?? 0;
        }

        // Per-technician revenue for the current year
        $perTeknisiRevenue = Pembayaran::where('pembayaran.status', 'paid')
            ->whereYear('pembayaran.created_at', $year)
            ->join('booking', 'pembayaran.booking_id', '=', 'booking.booking_id')
            ->join('teknisi', 'booking.teknisi_id', '=', 'teknisi.teknisi_id')
            ->select(
                'teknisi.nama',
                DB::raw('SUM(pembayaran.jumlah) as total')
            )
            ->groupBy('teknisi.teknisi_id', 'teknisi.nama')
            ->orderByDesc('total')
            ->get();

        return view('admin.dashboard', compact('stats', 'latest_bookings', 'latest_pembayaran', 'chartData', 'perTeknisiRevenue', 'year'));
    }
}
