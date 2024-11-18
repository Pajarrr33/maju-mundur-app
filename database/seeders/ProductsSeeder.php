<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'merchant_id' => 1, // Assuming Merchant A's ID is 1
                'name' => 'T-Shirt',
                'description' => 'High-quality cotton T-Shirt.',
                'price' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'merchant_id' => 1,
                'name' => 'Jeans',
                'description' => 'Stylish denim jeans.',
                'price' => 200,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
