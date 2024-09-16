<?php

namespace Database\Seeders;

use App\Models\Instrument;
use App\Models\Stock;
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

        Instrument::factory(8)->create();
        //Stock::factory(8)->create();
    }
}
