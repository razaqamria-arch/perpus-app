<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Memanggil Controller
use App\Http\Controllers\BookController;
use App\Http\Controllers\MemberController;

// Halaman utama
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Route Dashboard dan CRUD
Route::middleware(['auth'])->group(function () {

    // Halaman Dashboard
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // CRUD Data Buku
    Route::resource('books', BookController::class);

    // CRUD Data Anggota
    Route::resource('members', MemberController::class);

});

// Route autentikasi
require __DIR__.'/auth.php';
