<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('type_products')->insert([
            ['name_type' => 'Apple', 'image' => 'images/education_overview__ccmf0v3aqnjm_og.png', 'created_at' => '2023-10-01'],
            ['name_type' => 'HP', 'image' => 'images/download (1).png', 'created_at' => '2023-10-02'],
            ['name_type' => 'Asus', 'image' => 'images/download.png', 'created_at' => '2023-10-03'],
            ['name_type' => 'Books', 'image' => 'images/1731588736.jpg', 'created_at' => '2023-10-04'],
            ['name_type' => 'Toys', 'image' => 'images/1729731408.jpg', 'created_at' => '2023-10-05'],
            ['name_type' => 'Sports', 'image' => 'images/1731549795.jpg', 'created_at' => '2023-10-06'],
            ['name_type' => 'Beauty', 'image' => 'images/1731720843.jpg', 'created_at' => '2023-10-07'],
            ['name_type' => 'Automotive', 'image' => 'images/1729731408.jpg', 'created_at' => '2023-10-08'],
            ['name_type' => 'Jewelry', 'image' => 'images/1731549795.jpg', 'created_at' => '2023-10-09'],
            ['name_type' => 'Gardening', 'image' => 'images/1731720843.jpg', 'created_at' => '2023-10-10'],
            ['name_type' => 'Office Supplies', 'image' => 'images/1731588736.jpg', 'created_at' => '2023-10-11'],
            ['name_type' => 'Health', 'image' => 'images/1731720843.jpg', 'created_at' => '2023-10-12'],
            ['name_type' => 'Home Improvement', 'image' => 'images/1729731408.jpg', 'created_at' => '2023-10-13'],
            ['name_type' => 'Pet Supplies', 'image' => 'images/1731588736.jpg', 'created_at' => '2023-10-14'],
            ['name_type' => 'Food', 'image' => 'images/1729731408.jpg', 'created_at' => '2023-10-15'],
        ]);
    }
}
