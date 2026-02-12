<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;

Route::get('/', [ProdukController::class, 'index'])->name('dashboard');
Route::get('/produk', [ProdukController::class, 'admin'])->name('produk.admin');
Route::post('/produk/store', [ProdukController::class, 'store'])->name('produk.store');
Route::post('/produk/update/{id}', [ProdukController::class, 'update'])->name('produk.update');
Route::get('/produk/delete/{id}', [ProdukController::class, 'destroy'])->name('produk.delete');
