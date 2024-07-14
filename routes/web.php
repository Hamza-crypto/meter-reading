<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MeterReadingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [MeterReadingController::class, 'showElectricityGraph'])->name('electricity-graph');

Route::get('/last-billed-reading', [MeterReadingController::class, 'showLastBilledReadingForm'])->name('last-billed-reading-form');
Route::post('/last-billed-reading', [MeterReadingController::class, 'storeLastBilledReading'])->name('store-last-billed-reading');

Route::get('/meter-reading', [MeterReadingController::class, 'showMeterReadingForm'])->name('meter-reading-form');
Route::post('/meter-reading', [MeterReadingController::class, 'storeMeterReading'])->name('store-meter-reading');