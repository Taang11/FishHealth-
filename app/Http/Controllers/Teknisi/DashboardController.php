<?php

namespace App\Http\Controllers\Teknisi;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user    = auth()->user();
        $teknisi = $user->teknisi;

        if (!$teknisi) {
            return view('teknisi.dashboard', [
                'teknisi'           => null,
                'stats'             => [],
                'upcoming_bookings' => collect(),
                'chartData'         => array_fill(1, 12, 0),
                'year'              => date('Y'),
                'totalRevenue'      => 0,
            ]);
        }

        $stats = [
            'total_booking' => Booking::where('teknisi_id', $teknisi->teknisi_id)->count(),
            'pending'       => Booking::where('teknisi_id', $teknisi->teknisi_id)->where('status', 'pending')->count(),
            'accepted'      => Booking::where('teknisi_id', $teknisi->teknisi_id)->where('status', 'accepted')->count(),
            'selesai'       => Booking::where('teknisi_id', $teknisi->teknisi_id)->where('status', 'selesai')->count(),
        ];

        $upcoming_bookings = Booking::with(['user', 'layanan'])
            ->where('teknisi_id', $teknisi->teknisi_id)
            ->whereIn('status', ['pending', 'accepted'])
            ->orderBy('tanggal')
            ->orderBy('jam')
            ->take(10)
            ->get();

        // Monthly revenue chart - this technician only (current year)
        $year = date('Y');
        $monthlyRevenue = Pembayaran::where('pembayaran.status', 'paid')
            ->whereYear('pembayaran.created_at', $year)
            ->join('booking', 'pembayaran.booking_id', '=', 'booking.booking_id')
            ->where('booking.teknisi_id', $teknisi->teknisi_id)
            ->select(
                DB::raw('MONTH(pembayaran.created_at) as month'),
                DB::raw('SUM(pembayaran.jumlah) as total')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        $chartData = [];
        for ($m = 1; $m <= 12; $m++) {
            $chartData[$m] = $monthlyRevenue[$m] ?? 0;
        }

        $totalRevenue = array_sum($chartData);

        return view('teknisi.dashboard', compact('teknisi', 'stats', 'upcoming_bookings', 'chartData', 'year', 'totalRevenue'));
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
