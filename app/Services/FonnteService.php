<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FonnteService
{
    private string $token;
    private string $apiUrl = 'https://api.fonnte.com/send';

    public function __construct()
    {
        $this->token = config('services.fonnte.token');
    }

    /**
     * Kirim pesan WhatsApp via Fonnte.
     *
     * @param  string  $target  Nomor WA tujuan (format: 628xxx atau 08xxx)
     * @param  string  $message Isi pesan (mendukung *bold*, _italic_)
     * @return bool
     */
    public function send(string $target, string $message): bool
    {
        if (empty($this->token)) {
            Log::warning('[Fonnte] Token belum dikonfigurasi di .env (FONNTE_TOKEN).');
            return false;
        }

        if (empty($target)) {
            Log::warning('[Fonnte] Nomor target kosong, pesan tidak dikirim.');
            return false;
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => $this->token,
            ])->asForm()->post($this->apiUrl, [
                'target'      => $this->normalizePhone($target),
                'message'     => $message,
                'countryCode' => '62',
            ]);

            $body = $response->json();

            if ($response->successful() && ($body['status'] ?? false)) {
                Log::info('[Fonnte] Pesan berhasil dikirim ke ' . $target);
                return true;
            }

            Log::warning('[Fonnte] Gagal kirim pesan.', [
                'target'   => $target,
                'response' => $body,
            ]);
            return false;

        } catch (\Throwable $e) {
            Log::error('[Fonnte] Exception: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Normalisasi nomor telepon ke format internasional.
     * 08xxx → 628xxx | +628xxx → 628xxx
     */
    private function normalizePhone(string $phone): string
    {
        $phone = preg_replace('/\D/', '', $phone); // hapus non-digit
        if (str_starts_with($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        } elseif (str_starts_with($phone, '+')) {
            $phone = ltrim($phone, '+');
        }
        return $phone;
    }
}
