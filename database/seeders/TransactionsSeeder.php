<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('transactions')->insert([
            [
                'customer_id' => 2, // Assuming Customer A's ID is 2
                'product_id' => 1, // Assuming T-Shirt's ID is 1
                'points' => 20,    // Points earned in this transaction
                'quantity' => 1,
                'total_price' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'customer_id' => 2,
                'product_id' => 2, // Assuming Jeans' ID is 2
                'points' => 40,
                'quantity' => 1,
                'total_price' => 200,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
