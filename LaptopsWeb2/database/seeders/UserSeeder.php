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
        // Tạo người dùng mẫu
        User::create([
            'full_name' => 'Nguyen Van A',
            'email' => 'nguyenvana@example.com',
            'password' => Hash::make('password123'),
            'imageAvatar' => 'avatar1.jpg',
            'gender' => 'Male',
            'address' => '123 Pham Van Dong, Hanoi',
            'phone' => '0123456789',
        ]);

        User::create([
            'full_name' => 'Tran Thi B',
            'email' => 'tranthib@example.com',
            'password' => Hash::make('password123'),
            'imageAvatar' => 'avatar2.jpg',
            'gender' => 'Female',
            'address' => '456 Le Loi, Ho Chi Minh City',
            'phone' => '0987654321',
        ]);
    }
}
