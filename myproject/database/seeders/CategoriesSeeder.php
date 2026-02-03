<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('categories')->insert([
            ['name' => 'Văn học', 'slug' => 'van-hoc'],
            ['name' => 'CNTT', 'slug' => 'cntt'],
            ['name' => 'Kinh tế', 'slug' => 'kinh-te'],
            ['name' => 'Tiểu thuyết', 'slug' => 'tieu-thuyet'],
            ['name' => 'Sách thiếu nhi', 'slug' => 'sach-thieu-nhi'],
            ['name' => 'Tâm lý - Kỹ năng sống', 'slug' => 'tam-ly-ky-nang-song'],
            ['name' => 'Sách giáo khoa', 'slug' => 'sach-giao-khoa'],
        ]);
    }
}
