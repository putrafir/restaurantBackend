<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'customer',
            'email' => 'customer@gmail.com',
            'password' => 'customer'
        ]);
        User::factory()->create([
            'name' => 'namaKasir',
            'email' => 'kasir@gmail.com',
            'password' => 'cashier123',
            'role' => 'cashier'
        ]);
    }
}
