<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\MeterReading;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MeterReadingSeeder extends Seeder
{
    public function run()
    {
        // Generate 30 days of readings for each meter
        foreach (range(0, 29) as $day) {
            MeterReading::factory()->create([
                'meter_name' => 'meter1',
                'created_at' => now()->subDays($day)->startOfDay(),
                'updated_at' => now()->subDays($day)->startOfDay(),
            ]);

            MeterReading::factory()->create([
                'meter_name' => 'meter2',
                'created_at' => now()->subDays($day)->startOfDay(),
                'updated_at' => now()->subDays($day)->startOfDay(),
            ]);
        }
    }
}