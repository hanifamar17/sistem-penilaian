<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        User::create([
            'username' => 'admin',
            'password' => Hash::make('password'), // Ganti 'password' dengan password yang diinginkan
            'role' => 'admin', // Pastikan role sesuai dengan kolom enum di tabel user
        ]);
    }
}
