<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Car;

class CarSeeder extends Seeder {
    public function run(): void {
        Car::factory()
            ->count(50) // Tạo 50 dữ liệu giả
            ->create();
    }
}
