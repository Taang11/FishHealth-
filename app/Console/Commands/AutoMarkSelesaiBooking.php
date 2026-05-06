<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use Carbon\Carbon;

class AutoMarkSelesaiBooking extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'booking:auto-selesai';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Marks accepted bookings as selesai if 24 hours have passed since the scheduled date and time.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();

        // Cari booking berstatus accepted yang jadwalnya (tanggal & jam) sudah lewat + 1 hari (24 jam)
        $bookings = Booking::where('status', 'accepted')
            ->where(function ($query) use ($now) {
                // Konversi tanggal dan jam di DB menjadi raw timestamp dan compare.
                $query->whereRaw("CONCAT(tanggal, ' ', jam) <= ?", [$now->subDay()->format('Y-m-d H:i:s')]);
            })
            ->get();

        $count = 0;
        foreach ($bookings as $booking) {
            $booking->update([
                'status' => 'selesai',
                'is_teknisi_selesai' => true,
                'is_user_selesai' => true,
            ]);
            $count++;
        }

        $this->info("Berhasil meng-update $count booking menjadi selesai.");
    }
}
