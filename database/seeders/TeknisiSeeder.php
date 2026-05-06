<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Teknisi;
use App\Models\User;

class TeknisiSeeder extends Seeder
{
    public function run(): void
    {
        $rudi  = User::where('email', 'rudi@gmail.com')->first();
        $agus  = User::where('email', 'agus@gmail.com')->first();

        Teknisi::create([
            'user_id' => $rudi?->id,
            'nama'    => 'Rudi Teknisi',
            'no_hp'   => '6281234567890',
            'alamat'  => 'Jl. Aquarium No. 5, Jakarta Selatan',
            'lat'     => -6.2607,
            'lng'     => 106.7816,
        ]);

        Teknisi::create([
            'user_id' => $agus?->id,
            'nama'    => 'Agus Spesialis',
            'no_hp'   => '6289876543210',
            'alamat'  => 'Jl. Kolam Indah No. 12, Depok',
            'lat'     => -6.4025,
            'lng'     => 106.7942,
        ]);
    }
}
