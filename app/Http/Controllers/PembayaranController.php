<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Pembayaran;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction;

class PembayaranController extends Controller
{
    public function __construct()
    {
        Config::$serverKey    = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false;
        Config::$isSanitized  = true;
        Config::$is3ds        = true;
    }

    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            $data = Pembayaran::with(['booking.layanan', 'booking.user', 'booking.teknisi'])->latest()->get();
        } elseif ($user->isTeknisi()) {
            $teknisiId = $user->teknisi?->teknisi_id;
            $data = Pembayaran::whereHas('booking', fn($q) => $q->where('teknisi_id', $teknisiId))
                ->with(['booking.layanan', 'booking.user', 'booking.teknisi'])
                ->latest()
                ->get();
        } else {
            $data = Pembayaran::whereHas('booking', fn($q) => $q->where('user_id', $user->id))
                ->with(['booking.layanan', 'booking.teknisi'])
                ->latest()
                ->get();
        }

        return view('pembayaran.index', compact('data'));
    }

    public function bayar($booking_id)
    {
        $booking = Booking::with('layanan', 'user')->findOrFail($booking_id);

        // Pastikan hanya pemilik booking yang bisa bayar
        if (!auth()->user()->isAdmin() && $booking->user_id !== auth()->id()) {
            abort(403);
        }

        $order_id = 'ORDER-' . $booking->booking_id . '-' . time();

        $params = [
            'transaction_details' => [
                'order_id'    => $order_id,
                'gross_amount' => $booking->layanan->harga,
            ],
            'customer_details' => [
                'first_name' => $booking->user->name,
                'email'      => $booking->user->email,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('pembayaran.bayar', compact('snapToken', 'booking'));
    }

    public function callback(Request $request)
    {
        $data     = $request->all();
        $order_id = $data['order_id'];
        $status   = $data['transaction_status'];

        $explode    = explode('-', $order_id);
        $booking_id = $explode[1];

        $booking = Booking::find($booking_id);

        if ($booking && in_array($status, ['settlement', 'capture'])) {
            Pembayaran::firstOrCreate(
                ['booking_id' => $booking_id],
                [
                    'jumlah' => $data['gross_amount'],
                    'status' => 'paid',
                ]
            );

            $booking->update(['status' => 'accepted']);
        }

        return response()->json(['message' => 'OK']);
    }

    public function finish(Request $request)
    {
        $order_id = $request->order_id;
        
        try {
            $status = Transaction::status($order_id);
            $explode    = explode('-', $order_id);
            $booking_id = $explode[1];
            
            $booking = Booking::find($booking_id);

            if ($booking && in_array($status->transaction_status, ['settlement', 'capture'])) {
                Pembayaran::firstOrCreate(
                    ['booking_id' => $booking_id],
                    [
                        'jumlah' => $status->gross_amount,
                        'status' => 'paid',
                    ]
                );

                $booking->update(['status' => 'accepted']);
                return redirect()->route('booking.index')->with('success', 'Pembayaran berhasil dikonfirmasi.');
            }
        } catch (\Exception $e) {
            return redirect()->route('booking.index')->with('error', 'Gagal konfirmasi: ' . $e->getMessage());
        }

        return redirect()->route('booking.index')->with('error', 'Pembayaran belum diselesaikan.');
    }
}