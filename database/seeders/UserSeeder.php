<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name'     => 'Admin Klinik Ikan',
            'email'    => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'role'     => 'admin',
        ]);

        // User biasa
        User::create([
            'name'     => 'Budi Santoso',
            'email'    => 'budi@gmail.com',
            'password' => Hash::make('12345678'),
            'role'     => 'user',
        ]);

        User::create([
            'name'     => 'Siti Rahayu',
            'email'    => 'siti@gmail.com',
            'password' => Hash::make('12345678'),
            'role'     => 'user',
        ]);

        // User dengan role teknisi (untuk login)
        User::create([
            'name'     => 'Rudi Teknisi',
            'email'    => 'rudi@gmail.com',
            'password' => Hash::make('12345678'),
            'role'     => 'teknisi',
        ]);

        User::create([
            'name'     => 'Agus Spesialis',
            'email'    => 'agus@gmail.com',
            'password' => Hash::make('12345678'),
            'role'     => 'teknisi',
        ]);
    }
}
