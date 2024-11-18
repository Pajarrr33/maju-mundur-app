<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Merchant A',
                'email' => 'merchantA@example.com',
                'password' => Hash::make('12345678'),
                'role' => 'merchant',
                'token' => null,
                'point' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Customer A',
                'email' => 'customerA@example.com',
                'password' => Hash::make('12345678'),
                'role' => 'customer',
                'token' => null,
                'point' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
