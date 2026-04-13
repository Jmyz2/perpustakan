<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Anggota;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::create([
            'name' => 'Budi Santoso',
            'email' => 'siswa@pustaka.com',
            'password' => Hash::make('password123'),
            'role' => 'siswa'
        ]);

        Anggota::create([
            'user_id' => $user->id,
            'nis' => '10012024',
            'nama_lengkap' => 'Budi Santoso',
            'kelas' => 'XII RPL 1',
            'no_telp' => '081234567890',
        ]);
    }
}
