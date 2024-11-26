<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SlideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('slides')->insert([
            [
                'link' => 'http://127.0.0.1:8000/product/5',
                'image' => 'images/download.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'link' => 'http://127.0.0.1:8000/product/3',
                'image' => 'images/education_overview__ccmf0v3aqnjm_og.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'link' => 'http://127.0.0.1:8000/product/4',
                'image' => 'images/download.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'link' => 'http://127.0.0.1:8000/product/10',
                'image' => 'images/download (8).jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Thêm nhiều bản ghi nếu cần
        ]);
    }
}
