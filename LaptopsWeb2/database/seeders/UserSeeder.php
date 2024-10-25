<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tạo tài khoản người dùng
        User::create([
            'full_name' => 'Nguyen Van A',
            'email' => 'nguyenvana@example.com',
            'password' => Hash::make('password123'),
            'imageAvatar' => 'default.jpg',
            'gender' => 'Male',
            'address' => '123 Đường ABC, Thành phố XYZ',
            'phone' => '0123456789',
        ]);

        //admin
        User::create([
            'full_name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'imageAvatar' => 'admin.jpg',
            'gender' => 'Male',
            'address' => '456 Đường DEF, Thành phố XYZ',
            'phone' => '0987654321',
            'role' => 'admin',
        ]);
    }
}
