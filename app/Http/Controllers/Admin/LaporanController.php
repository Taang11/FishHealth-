<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class LaporanController extends Controller
{
    /**
     * Export data ke Excel (format CSV agar kompatibel & tanpa library tambahan).
     */
    public function exportExcel()
    {
        $bookings = Booking::with(['user', 'teknisi.user', 'layanan', 'pembayaran'])->latest()->get();

        $filename = "Laporan_Klinik_Ikan_" . date('Y-m-d') . ".xls";

        return response()->view('admin.laporan.excel', [
            'bookings' => $bookings
        ])->withHeaders([
            'Content-Type' => 'application/vnd.ms-excel',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    /**
     * Tampilan Laporan untuk PDF / Print (Desain Profesional).
     */
    public function exportPdf()
    {
        $data = [
            'bookings' => Booking::with(['user', 'layanan', 'pembayaran'])->latest()->get(),
            'total_revenue' => Pembayaran::where('status', 'paid')->sum('jumlah'),
            'date' => date('d F Y'),
        ];

        return view('admin.laporan.pdf', $data);
    }
}
