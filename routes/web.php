<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\VerifieldEmailController;

Route::get('/signin', [LoginController::class, 'index']);
Route::get('/signup', [RegisterController::class, 'index']);
Route::get('/VerifieldEmail/{token}', [VerifieldEmailController::class, 'index']);






Route::get('/', function () {
    return view('dashboard.index');
})->name('dashboard');
Route::get('/InsertDevice', function () {
    return view('dashboard.insert_device');
})->name('dashboard.insert_device');
Route::get('/Device/{id}', [DeviceController::class, 'show'])->name('device.show');

Route::get('/Setting', function () {
    return view('setting.setting');
})->name('setting');

