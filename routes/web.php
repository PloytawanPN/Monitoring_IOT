<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\VerifieldEmailController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\MqttController;
use App\Http\Controllers\DashboardController;

Route::get('/verifieldEmail/{token}', [VerifieldEmailController::class, 'index']);

Route::middleware('checktoken')->group(function () {

    Route::get('/signin', [LoginController::class, 'index'])->name('signin');
    Route::get('/signup', [RegisterController::class, 'index']);

    Route::get('/InsertDevice', [DashboardController::class, 'insert_device'])->name('insert_device');

    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
        Route::get('/device/edit/{id}', [DashboardController::class, 'edit'])->name('dashboard.edit');
        Route::get('/device/view/{id}', [DashboardController::class, 'view'])->name('dashboard.view');
    });

    Route::prefix('setting')->group(function () {
        Route::get('/users', [UsersController::class, 'setting'])->name('setting.users');
        Route::get('/mqtt', [MqttController::class, 'mqtt'])->name('setting.mqtt');
    });

});
