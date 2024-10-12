<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\VaccineCenter;
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
        VaccineCenter::create(['name' => 'Mirpur 1', 'daily_limit' => 20]);
        VaccineCenter::create(['name' => 'Mirpur 2', 'daily_limit' => 15]);
        VaccineCenter::create(['name' => 'Dhanmondi', 'daily_limit' => 10]);
        VaccineCenter::create(['name' => 'Mohakhali', 'daily_limit' => 5]);
    }
}
