<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            ['id_type' => 1, 'name' => 'Laptop', 'description' => 'High performance laptop', 'unit_price' => 1000.00, 'promotion_price' => 900.00, 'image' => 'download (1).jpg', 'new' => 1, 'quantity' => 50],
            ['id_type' => 1, 'name' => 'Smartphone', 'description' => 'Latest smartphone model', 'unit_price' => 800.00, 'promotion_price' => 700.00, 'image' => 'download (3).jpg', 'new' => 1, 'quantity' => 100],
            ['id_type' => 2, 'name' => 'T-Shirt', 'description' => 'Cotton t-shirt', 'unit_price' => 20.00, 'promotion_price' => 15.00, 'image' => 'download (4).jpg', 'new' => 1, 'quantity' => 200],
            ['id_type' => 2, 'name' => 'Jeans', 'description' => 'Denim jeans', 'unit_price' => 50.00, 'promotion_price' => 45.00, 'image' => 'download (5).jpg', 'new' => 1, 'quantity' => 150],
            ['id_type' => 3, 'name' => 'Sofa', 'description' => 'Comfortable sofa', 'unit_price' => 500.00, 'promotion_price' => 450.00, 'image' => 'download (6).jpg', 'new' => 1, 'quantity' => 20],
            ['id_type' => 3, 'name' => 'Table', 'description' => 'Wooden dining table', 'unit_price' => 300.00, 'promotion_price' => 250.00, 'image' => 'download (7).jpg', 'new' => 1, 'quantity' => 30],
            ['id_type' => 3, 'name' => 'Novel', 'description' => 'Bestselling novel', 'unit_price' => 15.00, 'promotion_price' => 10.00, 'image' => 'download (8).jpg', 'new' => 1, 'quantity' => 100],
            ['id_type' => 4, 'name' => 'Comic Book', 'description' => 'Popular comic book', 'unit_price' => 10.00, 'promotion_price' => 8.00, 'image' => 'download (9).jpg', 'new' => 1, 'quantity' => 80],
            ['id_type' => 1, 'name' => 'Action Figure', 'description' => 'Collectible action figure', 'unit_price' => 25.00, 'promotion_price' => 20.00, 'image' => 'download (10).jpg', 'new' => 1, 'quantity' => 50],
            ['id_type' => 5, 'name' => 'Doll', 'description' => 'Soft plush doll', 'unit_price' => 30.00, 'promotion_price' => 25.00, 'image' => 'download (11).jpg', 'new' => 1, 'quantity' => 40],
            ['id_type' => 6, 'name' => 'Soccer Ball', 'description' => 'Official soccer ball', 'unit_price' => 20.00, 'promotion_price' => 18.00, 'image' => 'download (12).jpg', 'new' => 1, 'quantity' => 100],
            ['id_type' => 6, 'name' => 'Tennis Racket', 'description' => 'Professional tennis racket', 'unit_price' => 50.00, 'promotion_price' => 45.00, 'image' => 'product_image_12.jpg', 'new' => 1, 'quantity' => 60],
            ['id_type' => 1, 'name' => 'Lipstick', 'description' => 'Long-lasting lipstick', 'unit_price' => 15.00, 'promotion_price' => 12.00, 'image' => 'product_image_13.jpg', 'new' => 1, 'quantity' => 150],
            ['id_type' => 7, 'name' => 'Perfume', 'description' => 'Floral scented perfume', 'unit_price' => 40.00, 'promotion_price' => 35.00, 'image' => 'product_image_14.jpg', 'new' => 1, 'quantity' => 70],
            ['id_type' => 1, 'name' => 'Car Wax', 'description' => 'Premium car wax', 'unit_price' => 25.00, 'promotion_price' => 20.00, 'image' => 'product_image_15.jpg', 'new' => 1, 'quantity' => 30],
        ]);
    }
}
