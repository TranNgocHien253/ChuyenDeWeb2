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
        // Tạo người dùng thường
        User::create([
            'full_name' => 'Nguyen Van A',
            'email' => 'nguyenvana@example.com',
            'password' => Hash::make('password123'),
            'imageAvatar' => 'avatar1.jpg',
            'gender' => 'Male',
            'address' => '123 Pham Van Dong, Hanoi',
            'phone' => '0123456789',
            'role' => 0, // Người dùng thường
        ]);

        // Tạo tài khoản admin
        User::create([
            'full_name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('adminpassword'),
            'imageAvatar' => 'admin_avatar.jpg',
            'gender' => 'Male',
            'address' => '456 Admin Street, Hanoi',
            'phone' => '0987654321',
            'role' => 1, // Tài khoản admin
        ]);

        // Tạo thêm người dùng với role 1 (admin) và role 0 (người dùng thường)
        User::create([
            'full_name' => 'Tran Thi C',
            'email' => 'tranthic@example.com',
            'password' => Hash::make('password123'),
            'imageAvatar' => 'avatar2.jpg',
            'gender' => 'Female',
            'address' => '456 Le Loi, Ho Chi Minh City',
            'phone' => '0987654321',
            'role' => 1, // Tài khoản admin
        ]);

        User::create([
            'full_name' => 'Pham Van D',
            'email' => 'phamvand@example.com',
            'password' => Hash::make('password123'),
            'imageAvatar' => 'avatar3.jpg',
            'gender' => 'Male',
            'address' => '789 Tran Phu, Da Nang',
            'phone' => '0909090909',
            'role' => 0, // Người dùng thường
        ]);
    }
}
