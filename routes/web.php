<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;

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
    return redirect('locations');
});

Route::resource('locations', LocationController::class);
Route::get('/distance', [LocationController::class, 'distance'])->name('locations.distance');
Route::get('/get-distance', [LocationController::class, 'distance'])->name('locations.get-distance');
