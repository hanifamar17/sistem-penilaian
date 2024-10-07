<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use App\Models\user;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'username' => 'admin',
            'password' => Hash::make('admin'), // Password yang dienkripsi
            'role' => 'admin', // Sesuaikan dengan enum role jika ada
        ]);
    }
}
