<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KategoriController;

Route::post('/daftar', [AuthController::class, 'daftar'])->name('daftar');
Route::get('/kategoritoko', [KategoriController::class, 'index'])->name('kategoritoko');

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
