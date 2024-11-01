<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('orders')->insert([
            ['category_id' => 1, 'product_id' => 1, 'name' => 'John Doe', 'phone' => '0901234567', 'quantity' => 1, 'address' => '123 Main St', 'total' => 1000.00, 'price' => 1000.00, 'status' => 'approved', 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 1, 'product_id' => 2, 'name' => 'Jane Smith', 'phone' => '0902345678', 'quantity' => 2, 'address' => '456 Oak Ave', 'total' => 1400.00, 'price' => 700.00, 'status' => 'approved', 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 2, 'product_id' => 3, 'name' => 'Alice Johnson', 'phone' => '0903456789', 'quantity' => 3, 'address' => '789 Pine Dr', 'total' => 45.00, 'price' => 15.00, 'status' => 'approved', 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 2, 'product_id' => 4, 'name' => 'Bob Brown', 'phone' => '0904567890', 'quantity' => 1, 'address' => '101 Maple Ct', 'total' => 45.00, 'price' => 45.00, 'status' => 'approved', 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 3, 'product_id' => 5, 'name' => 'Chris White', 'phone' => '0905678901', 'quantity' => 1, 'address' => '102 Cedar St', 'total' => 500.00, 'price' => 500.00, 'status' => 'rejected', 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 3, 'product_id' => 6, 'name' => 'Diana Green', 'phone' => '0906789012', 'quantity' => 1, 'address' => '103 Birch St', 'total' => 300.00, 'price' => 300.00, 'status' => 'rejected', 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 4, 'product_id' => 7, 'name' => 'Eve Black', 'phone' => '0907890123', 'quantity' => 4, 'address' => '104 Elm St', 'total' => 40.00, 'price' => 10.00, 'status' => 'approved', 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 4, 'product_id' => 8, 'name' => 'Frank Blue', 'phone' => '0908901234', 'quantity' => 1, 'address' => '105 Spruce St', 'total' => 8.00, 'price' => 8.00, 'status' => 'approved', 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 5, 'product_id' => 9, 'name' => 'Grace Red', 'phone' => '0909012345', 'quantity' => 1, 'address' => '106 Cherry St', 'total' => 20.00, 'price' => 20.00, 'status' => 'approved', 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 5, 'product_id' => 10, 'name' => 'Henry Yellow', 'phone' => '0900123456', 'quantity' => 2, 'address' => '107 Willow St', 'total' => 50.00, 'price' => 25.00, 'status' => 'approved', 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 6, 'product_id' => 11, 'name' => 'Ivy Orange', 'phone' => '0901234567', 'quantity' => 1, 'address' => '108 Poplar St', 'total' => 20.00, 'price' => 20.00, 'status' => 'approved', 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 6, 'product_id' => 12, 'name' => 'Jack Purple', 'phone' => '0902345678', 'quantity' => 1, 'address' => '109 Maple St', 'total' => 50.00, 'price' => 50.00, 'status' => 'approved', 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 7, 'product_id' => 13, 'name' => 'Kelly Pink', 'phone' => '0903456789', 'quantity' => 5, 'address' => '110 Cedar St', 'total' => 60.00, 'price' => 12.00, 'status' => 'approved', 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 7, 'product_id' => 14, 'name' => 'Leo Grey', 'phone' => '0904567890', 'quantity' => 1, 'address' => '111 Birch St', 'total' => 35.00, 'price' => 35.00, 'status' => 'approved', 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 8, 'product_id' => 15, 'name' => 'Mia White', 'phone' => '0905678901', 'quantity' => 1, 'address' => '112 Pine St', 'total' => 20.00, 'price' => 20.00, 'status' => 'rejected', 'created_at' => now(), 'updated_at' => now()],
        ]);        
    }
}
