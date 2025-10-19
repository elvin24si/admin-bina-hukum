<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JenisDokumenController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\DashboardController;

Route::resource('jenis_dokumen', JenisDokumenController::class);
Route::resource('warga', WargaController::class);
Route::get('/', [DashboardController::class, 'index'])
->name('dashboard');