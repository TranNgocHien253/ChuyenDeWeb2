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
                'link' => 'https://example.com/slide1',
                'image' => 'https://via.placeholder.com/600x400.png?text=Slide+1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'link' => 'https://example.com/slide2',
                'image' => 'https://via.placeholder.com/600x400.png?text=Slide+2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'link' => 'https://example.com/slide3',
                'image' => 'https://via.placeholder.com/600x400.png?text=Slide+3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'link' => 'https://example.com/slide4',
                'image' => 'https://via.placeholder.com/600x400.png?text=Slide+4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Thêm nhiều bản ghi nếu cần
        ]);
    }
}
