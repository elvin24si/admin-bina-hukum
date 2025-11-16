<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JenisDokumenController;
use App\Http\Controllers\DokumenHukumController;
use App\Http\Controllers\KategoriDokumenController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

Route::resource('jenis_dokumen', JenisDokumenController::class);
Route::resource('kategori_dokumen', KategoriDokumenController::class);
Route::resource('dokumen_hukum', DokumenHukumController::class);
Route::resource('warga', WargaController::class);
Route::get('/dashboard', [DashboardController::class, 'index'])
->name('dashboard');
Route::resource('user', UserController::class);
