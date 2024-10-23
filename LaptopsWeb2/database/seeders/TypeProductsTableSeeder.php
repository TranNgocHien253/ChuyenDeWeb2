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
            ['name_type' => 'Electronics', 'image' => 'type_image_1.jpg'],
            ['name_type' => 'Clothing', 'image' => 'type_image_2.jpg'],
            ['name_type' => 'Furniture', 'image' => 'type_image_3.jpg'],
            ['name_type' => 'Books', 'image' => 'type_image_4.jpg'],
            ['name_type' => 'Toys', 'image' => 'type_image_5.jpg'],
            ['name_type' => 'Sports', 'image' => 'type_image_6.jpg'],
            ['name_type' => 'Beauty', 'image' => 'type_image_7.jpg'],
            ['name_type' => 'Automotive', 'image' => 'type_image_8.jpg'],
            ['name_type' => 'Jewelry', 'image' => 'type_image_9.jpg'],
            ['name_type' => 'Gardening', 'image' => 'type_image_10.jpg'],
            ['name_type' => 'Office Supplies', 'image' => 'type_image_11.jpg'],
            ['name_type' => 'Health', 'image' => 'type_image_12.jpg'],
            ['name_type' => 'Home Improvement', 'image' => 'type_image_13.jpg'],
            ['name_type' => 'Pet Supplies', 'image' => 'type_image_14.jpg'],
            ['name_type' => 'Food', 'image' => 'type_image_15.jpg'],
        ]);
    }
}
