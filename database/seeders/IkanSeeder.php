<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IkanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('ikan')->insert([
            [
                'nama' => 'Nemo',
                'jenis' => 'Ikan Badut',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Dory',
                'jenis' => 'Blue Tang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Cupang Merah',
                'jenis' => 'Cupang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Arwana Super Red',
                'jenis' => 'Arwana',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Lele Dumbo',
                'jenis' => 'Lele',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}