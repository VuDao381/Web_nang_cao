<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PublishersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('publishers')->insert([
            ['name' => 'NXB Trẻ', 'slug' => 'nxb-tre'],
            ['name' => 'NXB Kim Đồng', 'slug' => 'nxb-kim-dong'],
            ['name' => 'NXB Giáo Dục', 'slug' => 'nxb-giao-duc'],
            ['name' => 'NXB Hội Nhà Văn', 'slug' => 'nxb-hoi-nha-van'],
            ['name' => 'NXB Lao Động', 'slug' => 'nxb-lao-dong'],
            ['name' => 'Nhã Nam', 'slug' => 'nha-nam'],
        ]);
    }
}
