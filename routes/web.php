<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataTransaksiController;
use App\Http\Controllers\AturanAsosiasiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PromosiController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'guest'], function () {
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::post('/cekLogin', [AuthController::class, 'cekLogin']);
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('/dashboard', DashboardController::class);

    Route::resource('/data-transaksi', DataTransaksiController::class);
    Route::get('/tabel-data-transaksi', [DataTransaksiController::class, 'tabelDataTransaksi']);
    Route::get('/tabel-data-barang', [DataTransaksiController::class, 'tabelDataBarang']);

    Route::resource('/aturan-asosiasi', AturanAsosiasiController::class);
    Route::post('/proses-aturan-asosiasi', [AturanAsosiasiController::class, 'prosesAturanAsosiasi']);
    Route::get('/tabel-aturan-asosiasi', [AturanAsosiasiController::class, 'dtHasil']);

    Route::resource('/riwayat', RiwayatController::class);
    Route::get('/get-riwayat/{riwayat}', [RiwayatController::class, 'getRiwayat']);

    Route::get('/get-riwayat-promosi/{riwayat}', [PromosiController::class, 'getRiwayatPromosi']);

    Route::get('/get-barang-laris', [PromosiController::class, 'getBarangLarisPromosi']);

    Route::get('/get-barang-kurang-laris', [PromosiController::class, 'getBarangKurangLarisPromosi']);

    Route::put('/akun/{user}', [UserController::class, 'update']);

    Route::resource('/promosi', PromosiController::class);
});
