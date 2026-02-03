<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Books;
use Faker\Factory as Faker;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $users = User::pluck('id')->toArray();
        $books = Books::pluck('id')->toArray();

        if (empty($users) || empty($books)) {
            $this->command->warn('⚠ Chưa có users hoặc books, bỏ qua OrdersSeeder');
            return;
        }

        // Tạo 20 đơn hàng ngẫu nhiên
        for ($i = 0; $i < 20; $i++) {
            $userId = $faker->randomElement($users);

            $order = Order::create([
                'user_id' => $userId,
                'total_price' => 0, // Sẽ tính lại sau
                'status' => $faker->randomElement(['pending', 'processing', 'completed', 'cancelled']),
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
            ]);

            $totalPrice = 0;
            // Mỗi đơn hàng có 1-5 sản phẩm
            $itemCount = $faker->numberBetween(1, 5);

            for ($j = 0; $j < $itemCount; $j++) {
                $bookId = $faker->randomElement($books);
                $book = Books::find($bookId); // Lấy giá sách làm giá bán
                $qty = $faker->numberBetween(1, 3);
                $price = $book ? $book->price : 100000;

                OrderItem::create([
                    'order_id' => $order->id,
                    'book_id' => $bookId,
                    'quantity' => $qty,
                    'price' => $price,
                ]);

                $totalPrice += $qty * $price;
            }

            // Update lại total_price cho order
            $order->update(['total_price' => $totalPrice]);
        }
    }
}
