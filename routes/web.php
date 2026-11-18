<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Inertia;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;

// Halaman utama
Route::get('/', [HomeController::class, 'index']);

// Halaman tentang
Route::get('/tentang', [HomeController::class, 'tentang']);

// Halaman kontak
Route::get('/kontak', [HomeController::class, 'kontak']);

// Route yang membutuhkan login
Route::middleware(['auth'])->group(function () {

    // Route Dashboard
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // CRUD Buku
    Route::resource('books', BookController::class);

});

// Autentikasi
require __DIR__.'/auth.php';
