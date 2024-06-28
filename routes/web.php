<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeviceController;

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
    return view('dashboard.index');
})->name('dashboard');
Route::get('/InsertDevice', function () {
    return view('dashboard.insert_device');
})->name('dashboard.insert_device');

Route::get('/Device/{id}', [DeviceController::class, 'show'])->name('device.show');
