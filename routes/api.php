<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/detail/{id}', [DashboardController::class, 'detail']); // detail per post
    Route::get('/dashboard', [DashboardController::class, 'dashboard']); // isi dashboard
    Route::post('/logout', [LoginController::class, 'logout']); // Logout
    Route::post('/create', [PostController::class, 'store']); // Membuat Postingan
    Route::delete('/delete/{id}', [PostController::class, 'delete']); // Menghapus Postingan
    Route::delete('/done/{id}', [PostController::class, 'doneCost']); // Membersihkan postingan salah
    Route::get('/edit/{id}', [PostController::class, 'edit']); // view untuk edit
    Route::post('/edit/{id}', [PostController::class, 'update']); // post update
    Route::post('/storeincome/{id}', [PostController::class, 'storeIncome']); // masukin income
    Route::get('/incomeEdit', [PostController::class, 'incomeEdit']); // show income untuk diedit
    Route::post('/editincome/{id}', [PostController::class, 'editIncome']); // simpan perubahan income yang diedit
    Route::get('/category/{id}', [DashboardController::class, 'category']); // halaman per kategori
});

Route::post('/auth', [LoginController::class, 'authenticate']); // login
Route::post('/register', [LoginController::class, 'tambah']); // tambah user

