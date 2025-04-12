<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Gọi các seeder cần thiết tại đây
        $this->call([
            // RestaurantSeeder::class, // Bỏ comment nếu bạn đã tạo
            // CategorySeeder::class,
            // ProductSeeder::class,
            // UserSeeder::class,
        ]);
    }
}
