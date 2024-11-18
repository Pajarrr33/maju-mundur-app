<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RedemptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('redemptions')->insert([
            [
                'customer_id' => 2,
                'reward_id' => 1,
                'redeemed_at' => now(),
                'points' => 40,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'customer_id' => 2,
                'reward_id' => 2,
                'redeemed_at' => now(),
                'points' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
