<?php

namespace App\Http\Controllers;

use App\Models\MeterReading;
use App\Models\LastBilledReading;
use Carbon\Carbon;
use Illuminate\Http\Request;


class MeterReadingController extends Controller
{
    public function index()
    {
        $meter1Readings = MeterReading::where('meter_name', 'meter1')->orderBy('created_at')->get();
        $meter2Readings = MeterReading::where('meter_name', 'meter2')->orderBy('created_at')->get();

        // Calculate daily consumption for each meter
        $meter1DailyConsumption = $this->calculateDailyConsumption($meter1Readings);
        $meter2DailyConsumption = $this->calculateDailyConsumption($meter2Readings);

        return view('meter_readings.index', compact('meter1DailyConsumption', 'meter2DailyConsumption'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'meter_name' => 'required|string|in:meter1,meter2',
            'reading' => 'required|numeric',
        ]);

        $today = Carbon::today();
        $existingReading = MeterReading::where('meter_name', $validated['meter_name'])
            ->whereDate('created_at', $today)
            ->first();

        $lastBilledReading = MeterReading::where('meter_name', $validated['meter_name'])
            ->whereNotNull('last_billed_reading')
            ->orderBy('created_at', 'desc')
            ->first();

        if ($existingReading) {
            // Update the existing reading
            $existingReading->update([
                'reading' => $validated['reading'],
                'created_at' => now(),
            ]);
        } else {
            // Create a new reading
            $validated['created_at'] = now();
            if ($lastBilledReading) {
                $validated['last_billed_reading'] = $lastBilledReading->last_billed_reading;
            }
            MeterReading::create($validated);
        }

        return redirect()->back();
    }

    private function calculateDailyConsumption($readings)
    {
        $dailyConsumption = [];
        $previousReading = null;

        foreach ($readings as $reading) {
            $date = Carbon::parse($reading->created_at)->format('Y-m-d');
            if (!isset($dailyConsumption[$date])) {
                $dailyConsumption[$date] = 0;
            }

            if ($previousReading) {
                $dailyConsumption[$date] += $reading->reading - $previousReading->reading;
            }

            $previousReading = $reading;
        }

        return $dailyConsumption;
    }

    public function setLastBilledReading(Request $request)
    {
        $validated = $request->validate([
            'meter_name' => 'required|string|in:meter1,meter2',
            'last_billed_reading' => 'required|numeric',
        ]);

        MeterReading::create([
            'meter_name' => $validated['meter_name'],
            'reading' => $validated['last_billed_reading'],
            'last_billed_reading' => $validated['last_billed_reading'],
            'created_at' => now(),
        ]);

        return redirect()->back();
    }

    public function showElectricityGraph()
    {
        // Retrieve last billed readings
        $lastBilledReadingMeter1 = LastBilledReading::where('meter_name', 'meter1')->value('reading');
        $lastBilledReadingMeter2 = LastBilledReading::where('meter_name', 'meter2')->value('reading');

        // Retrieve daily readings for the current month
        $currentMonth = Carbon::now()->startOfMonth();
        $meter1Readings = MeterReading::where('meter_name', 'meter1')
            ->whereDate('created_at', '>=', $currentMonth)
            ->orderBy('created_at')
            ->get();

        $meter2Readings = MeterReading::where('meter_name', 'meter2')
            ->whereDate('created_at', '>=', $currentMonth)
            ->orderBy('created_at')
            ->get();

        // Calculate cumulative readings since last billed reading
        $meter1Data = $this->calculateCumulativeReadings($lastBilledReadingMeter1, $meter1Readings);
        $meter2Data = $this->calculateCumulativeReadings($lastBilledReadingMeter2, $meter2Readings);

        // Pass data to the view
        return view('electricity_graph', compact('meter1Data', 'meter2Data'));
    }

    private function calculateCumulativeReadings($lastBilledReading, $readings)
    {
        $cumulativeReading = $lastBilledReading;
        $data = [];

        foreach ($readings as $reading) {
            $cumulativeReading += $reading->reading_value;
            $data[] = [
                'date' => $reading->created_at->format('Y-m-d'),
                'reading' => $cumulativeReading,
            ];
        }

        return $data;
    }
}