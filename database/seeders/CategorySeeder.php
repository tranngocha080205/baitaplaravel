<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'Bánh Mì', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cơm Dĩa', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Bún Phở', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Món Chay', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
