<?php

namespace Database\Factories;

use App\Models\MeterReading;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class MeterReadingFactory extends Factory
{
    protected $model = MeterReading::class;

    public function definition()
    {
        return [
            'meter_name' => $this->faker->randomElement(['meter1', 'meter2']),
            'reading' => $this->faker->numberBetween(100, 500),
            'created_at' => Carbon::now()->subDays(rand(0, 30))->startOfDay(), // Random day in the last 30 days
            'updated_at' => Carbon::now(),
        ];
    }
}