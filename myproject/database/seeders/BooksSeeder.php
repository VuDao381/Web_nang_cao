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

        for ($i = 0; $i < 50; $i++) {
            $title = $faker->sentence(5);
            DB::table('books')->insert([
                'title' => $title,
                'slug' => \Illuminate\Support\Str::slug($title) . '-' . $faker->unique()->numberBetween(1, 1000), // Ensure unique slug
                'author' => $faker->name(),
                'price' => $faker->numberBetween(50, 500) * 1000,
                'quantity' => $faker->numberBetween(0, 100),
                'published_year' => $faker->year(),
                'pages' => $faker->numberBetween(100, 1000),
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
