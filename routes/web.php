<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// Home route
Route::get('/', [HomeController::class, 'home']);

// Dashboard route
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes (grouped under 'auth' middleware)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Authentication routes
require __DIR__ . '/auth.php';

// Admin routes (with 'auth' and 'admin' middleware)
Route::get('admin/dashboard', [HomeController::class, 'index'])
    ->middleware(['auth', 'admin']);

Route::get('view_category', [AdminController::class, 'view_category'])
    ->middleware(['auth', 'admin']);

Route::post('add_category', [AdminController::class, 'add_category'])
    ->middleware(['auth', 'admin']);

Route::get('delete_category/{id}', [AdminController::class, 'delete_category'])
->middleware(['auth', 'admin']);