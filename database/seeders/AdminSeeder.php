<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat akun admin
        User::create([
        'name' => 'Admin',
        'user_code' => 'ADM-01',
        'username' => 'admin',
        'password' => bcrypt('admin'),
        'role' => 'Administrator',
    ]);
    }
}
