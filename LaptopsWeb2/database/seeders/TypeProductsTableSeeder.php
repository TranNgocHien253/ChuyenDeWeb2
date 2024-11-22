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
            ['name_type' => 'Electronics', 'image' => 'images/1729731408.jpg'],
            ['name_type' => 'Clothing', 'image' => 'images/1731549795.jpg'],
            ['name_type' => 'Furniture', 'image' => 'images/1731720843.jpg'],
            ['name_type' => 'Books', 'image' => 'images/1731588736.jpg'],
            ['name_type' => 'Toys', 'image' => 'images/1729731408.jpg'],
            ['name_type' => 'Sports', 'image' => 'images/1731549795.jpg'],
            ['name_type' => 'Beauty', 'image' => 'images/1731720843.jpg'],
            ['name_type' => 'Automotive', 'image' => 'images/1729731408.jpg'],
            ['name_type' => 'Jewelry', 'image' => 'images/1731549795.jpg'],
            ['name_type' => 'Gardening', 'image' => 'images/1731720843.jpg'],
            ['name_type' => 'Office Supplies', 'image' => 'images/1731588736.jpg'],
            ['name_type' => 'Health', 'image' => 'images/1731720843.jpg'],
            ['name_type' => 'Home Improvement', 'image' => 'images/1729731408.jpg'],
            ['name_type' => 'Pet Supplies', 'image' => 'images/1731588736.jpg'],
            ['name_type' => 'Food', 'image' => 'images/1729731408.jpg'],
        ]);
    }
}
