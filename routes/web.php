<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });

// Si no está logeado se le muestra el login.
Route::get('/', [AuthenticatedSessionController::class, 'create'])->middleware('guest');


Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard/{id}', [DashboardController::class, 'show'])->middleware(['auth', 'verified'])->name('dashboard.show');
Route::get('/dashboard/edit/{id}', [DashboardController::class, 'edit'])->middleware(['auth', 'verified'])->name('dashboard.edit');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
