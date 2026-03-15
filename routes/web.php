<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;

Route::get('/produk', [ProdukController::class, 'index','indexsudahlog']);
Route::post('/daftar', [AuthController::class, 'daftar'])->name('daftar');
Route::post('/tampilan_login', [AuthController::class, 'login']);
Route::get('/kategoritoko', [KategoriController::class, 'category'])->name('kategoritoko');
Route::get('/profile', [AuthController::class, 'profile']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/', function(){
    return view('index');
})->name('index');

Route::get('/indexsudahlog', function(){
    return view('indexsudahlog');
})->name('indexsudahlog');

Route::get('/tampilan_login', function() {
    return view('tampilan_login');
})->name('tampilan_login');

Route::get('/hubungi', function(){
    return view('hubungi');
})->name('hubungi');

Route::get('/hubungi1', function(){
    return view('hubungi1');
})->name('hubungi1');

Route::get('/daftar', function(){
    return view('daftar');
})->name('daftar');

Route::get('/profile', function(){
    return view('profile');
})->name('profile');
