<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Tạo Admin cố định
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '0909000000',
            'address' => 'Hanoi, Vietnam',
            'is_active' => true,
        ]);

        // 2. Tạo User thường cố định
        User::create([
            'name' => 'Test User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'phone' => '0909111111',
            'address' => 'HCMC, Vietnam',
            'is_active' => true,
        ]);

        // 3. Tạo thêm 10 User ngẫu nhiên bằng Factory
        User::factory(10)->create();
    }
}
