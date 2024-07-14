<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MeterReading;
use App\Models\LastBilledReading;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        LastBilledReading::factory([
            'reading_value' => 1000
        ])->count(2)->create(); // Create last billed readings for both meters
        $this->call(MeterReadingSeeder::class);
    }
}