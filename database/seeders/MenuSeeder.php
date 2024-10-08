<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Menu::create(['name' => 'Nasi Goreng', 'price' => 20000]);
        Menu::create(['name' => 'Sate Ayam', 'price' => 15000]);
        Menu::create(['name' => 'Teh Manis', 'price' => 9000]);
    }
}
