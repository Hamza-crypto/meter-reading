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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/', [MeterReadingController::class, 'index']);
Route::post('/meter-readings', [MeterReadingController::class, 'store']);
Route::get('/set-last-billed-reading', function () {
    return view('settings.set_last_billed_reading');
})->name('set-last-billed-reading');
Route::post('/set-last-billed-reading', [MeterReadingController::class, 'setLastBilledReading']);

Route::get('/electricity-graph', [MeterReadingController::class, 'showElectricityGraph'])->name('electricity-graph');