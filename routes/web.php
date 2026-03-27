<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;

Route::get('/', [ProdukController::class, 'index'])->name('index');
Route::get('/produk', [ProdukController::class, 'index']);
Route::get('/indexsudahlog', [ProdukController::class, 'indexsudahlog'])->name('indexsudahlog');
Route::post('/daftar', [AuthController::class, 'daftar'])->name('daftar');
Route::get('/kategoritoko', [KategoriController::class, 'category'])->name('kategoritoko');
Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/kategori/{id}', [KategoriController::class, 'show'])->name('kategori.show');
Route::post('/keranjang/tambah', [ProdukController::class, 'tambahKeranjang']);
Route::post('/pesanan/tambah', [ProdukController::class, 'tambahPesanan']);
Route::get('/keranjang', [ProdukController::class, 'keranjang'])->name('keranjang');
    
Route::get('/login', function () {
    return view('tampilan_login');
})->name('login');

Route::get('/hubungi', function () {
    return view('hubungi');
})->name('hubungi');

Route::get('/hubungi1', function () {
    return view('hubungi1');
})->name('hubungi1');

Route::get('/daftar', function () {
    return view('daftar');
})->name('daftar');
