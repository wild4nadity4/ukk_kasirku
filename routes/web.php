<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminKategoriController;
use App\Http\Controllers\AdminProdukController;
use App\Http\Controllers\AdminTransaksiController;
use App\Http\Controllers\AdminTransaksiDetailController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RiwayatController;






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

Route::get('/', [AdminAuthController::class, 'index']);
Route::get('/login', [AdminAuthController::class, 'index'])->name('login');
Route::post('/login/do', [AdminAuthController::class, 'doLogin'])->name('doLogin');

Route::get('/dashboard', [DashboardController::class, 'index']);

Route::get('/register', [AdminAuthController::class, 'register'])->name('register');
Route::post('/register-proses', [AdminAuthController::class, 'register_proses'])->name('register-proses');







Route::middleware(['auth', 'userAkses:admin,pengguna'])->prefix('kasir')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/transaksi/detail/selesai/{id}', [AdminTransaksiDetailController::class, 'done']);
    Route::get('/transaksi/detail/delete', [AdminTransaksiDetailController::class, 'delete']);
    Route::post('/transaksi/detail/create', [AdminTransaksiDetailController::class, 'create']);
    Route::resource('/transaksi', AdminTransaksiController::class);
    Route::post('invoice/print/{id}', [AdminTransaksiController::class, 'print_invoice'])->name('print.invoice');
});

Route::middleware(['auth', 'userAkses:admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::resource('/produk', AdminProdukController::class);
    Route::resource('/kategori', AdminKategoriController::class);
    Route::resource('/user', AdminUserController::class);
    Route::resource('/riwayat', RiwayatController::class);
    Route::post('/riwayat/print', [RiwayatController::class, 'print'])->name('riwayat.print');
    Route::get('/riwayat/pdf', [RiwayatController::class, 'generatePDF'])->name('riwayat.pdf');
    Route::delete('/riwayat/destroy/{id}', [RiwayatController::class, 'destroy'])->name('riwayat.destroy');
});