<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RewardsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rewards')->insert([
            [
                'name' => 'Reward A',
                'points_required' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Reward B',
                'points_required' => 40,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
