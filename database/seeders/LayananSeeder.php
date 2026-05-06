<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Layanan;

class LayananSeeder extends Seeder
{
    public function run(): void
    {
        $layanan = [
            ['nama_layanan' => 'Konsultasi Kesehatan Ikan',   'harga' => 75000],
            ['nama_layanan' => 'Pengobatan Infeksi Jamur',    'harga' => 150000],
            ['nama_layanan' => 'Pengobatan Infeksi Bakteri',  'harga' => 200000],
            ['nama_layanan' => 'Water Treatment & Filtrasi',  'harga' => 100000],
            ['nama_layanan' => 'Perawatan Kolam Lengkap',     'harga' => 350000],
        ];

        foreach ($layanan as $item) {
            Layanan::create($item);
        }
    }
}
