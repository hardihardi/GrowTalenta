<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'nama_pegawai' => 'Admin',
            'google_id' => null,
            'email' => 'admin@gmail.com',
            // 'password' => Hash::make('12345678'),
            'password' => Hash::make('password'),
            'is_admin' => 1,
            'status_pegawai' => 1,
        ]);
    }
}
