<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // $faker = Faker::create();
        // for ($i = 0; $i < 50; $i++) {
        //     DB::table('books')->insert([
        //         'title' => $faker->sentence(5),
        //         'author' => $faker->name(5),
        //         'description' => $faker->paragraph(),
        //         'published_date' => $faker->date(),
        //         'pages' => $faker->numberBetween(100, 1000),
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]);
        // }
    }
}
