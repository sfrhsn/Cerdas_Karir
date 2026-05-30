<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'Admin Cerdas Karir',
            'email'    => 'admin@cerdaskarir.id',
            'password' => Hash::make('admin123456'),
            'role'     => 'admin',
        ]);

        User::create([
            'name'     => 'Budi Santoso',
            'email'    => 'budi@example.com',
            'password' => Hash::make('password123'),
            'role'     => 'user',
            'current_position' => 'Senior Developer',
            'bio' => 'Pengembang perangkat lunak berpengalaman lebih dari 8 tahun.',
        ]);
    }
}