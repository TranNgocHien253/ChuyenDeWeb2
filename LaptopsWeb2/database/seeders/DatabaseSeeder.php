<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\OrdersTableSeeder;
use Database\Seeders\TypeProductsTableSeeder;
use Database\Seeders\ProductsTableSeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            TypeProductsTableSeeder::class,
            ProductsTableSeeder::class,
            OrdersTableSeeder::class,
            UserSeeder::class,
            SlideSeeder::class,
        ]);
    }
}
