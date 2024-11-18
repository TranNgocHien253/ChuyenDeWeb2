<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
   // database/seeders/ProductSeeder.php
use App\Models\Product;

public function run()
{
    Product::create([
        'product_code' => 'P001',
        'name' => 'Sample Product 1',
        'price' => 1200,
        'image' => 'path/to/your/image1.jpg',
        'sales' => 89000,
    ]);
    // Thêm các sản phẩm khác nếu cần
}

}
