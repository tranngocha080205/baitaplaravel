<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'], // Kiểm tra nếu đã tồn tại email này
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
            ]
        );
    }
}
