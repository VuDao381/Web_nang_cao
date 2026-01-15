<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Category;
use App\Models\Publisher;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Lấy danh sách ID thật từ DB
        $categoryIds = Category::pluck('id')->toArray();
        $publisherIds = Publisher::pluck('id')->toArray();

        // Nếu chưa có category hoặc publisher thì dừng
        if (empty($categoryIds) || empty($publisherIds)) {
            $this->command->warn('⚠ Chưa có category hoặc publisher, bỏ qua BooksSeeder');
            return;
        }

        for ($i = 0; $i < 10; $i++) {
            DB::table('books')->insert([
                'title' => $faker->sentence(5),
                'author' => $faker->name(),
                'price' => $faker->numberBetween(50, 500) * 1000, // giá tròn nghìn
                'quantity' => $faker->numberBetween(0, 100),
                'published_date' => $faker->date(),
                'description' => $faker->paragraph(),
                'image' => 'https://via.placeholder.com/200x300.png',
                'category_id' => $faker->randomElement($categoryIds),
                'publisher_id' => $faker->randomElement($publisherIds),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
