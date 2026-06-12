<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Layanan;

class LayananSeeder extends Seeder
{
    public function run(): void
    {
        $layanan = [
            // ── Layanan Dokter Ikan ────────────────────────────────
            ['nama_layanan' => 'Konsultasi & Diagnosa Penyakit Ikan',  'harga' => 75000,  'subtype' => 'dokter'],
            ['nama_layanan' => 'Pengobatan Infeksi Jamur (Saprolegnia)', 'harga' => 150000, 'subtype' => 'dokter'],
            ['nama_layanan' => 'Pengobatan Infeksi Bakteri (Aeromonas)', 'harga' => 200000, 'subtype' => 'dokter'],
            ['nama_layanan' => 'Penanganan Parasit Kulit (Ich/Costia)',  'harga' => 175000, 'subtype' => 'dokter'],
            ['nama_layanan' => 'Operasi Tumor / Benjolan Ikan',          'harga' => 350000, 'subtype' => 'dokter'],
            ['nama_layanan' => 'Terapi Swim Bladder Disorder',           'harga' => 125000, 'subtype' => 'dokter'],
            ['nama_layanan' => 'Pemeriksaan Mikroskopis Parasit',        'harga' => 100000, 'subtype' => 'dokter'],

            // ── Layanan Teknisi Kolam ──────────────────────────────
            ['nama_layanan' => 'Pemasangan Filter Kolam',               'harga' => 250000, 'subtype' => 'teknisi'],
            ['nama_layanan' => 'Pemasangan Lampu UV Sterilizer',        'harga' => 200000, 'subtype' => 'teknisi'],
            ['nama_layanan' => 'Water Treatment & Kondisioner Air',     'harga' => 100000, 'subtype' => 'teknisi'],
            ['nama_layanan' => 'Perawatan & Bersih Kolam Lengkap',      'harga' => 350000, 'subtype' => 'teknisi'],
            ['nama_layanan' => 'Instalasi Sistem Aerasi (Pompa Udara)', 'harga' => 180000, 'subtype' => 'teknisi'],
            ['nama_layanan' => 'Penggantian Media Filter Biologi',      'harga' => 150000, 'subtype' => 'teknisi'],
            ['nama_layanan' => 'Kalibrasi & Uji Kualitas Air Kolam',    'harga' => 80000,  'subtype' => 'teknisi'],
        ];

        foreach ($layanan as $item) {
            Layanan::create($item);
        }
    }
}
