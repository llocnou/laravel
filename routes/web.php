<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

// Route::get('/', function () {
//     return view('welcome');
// });

// Si no está logeado se le muestra el login.
Route::get('/', [AuthenticatedSessionController::class, 'create'])->middleware('guest');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard/{id}', [DashboardController::class, 'show'])->middleware(['auth', 'verified'])->name('dashboard.show');

// Edit & Update
Route::get('/dashboard/edit/{id}', [DashboardController::class, 'edit'])->middleware(['auth', 'verified'])->name('dashboard.edit');
Route::patch('/dashboard/{id}', [DashboardController::class, 'update'])->middleware(['auth', 'verified'])->name('dashboard.update');

// Create & Store
Route::get('/dashboard/create/{where}', [DashboardController::class, 'create'])->middleware(['auth', 'verified'])->name('dashboard.create.dir');
Route::post('/dashboard/', [DashboardController::class, 'store'])->middleware(['auth', 'verified'])->name('dashboard.store.dir');

// Delete
Route::delete('dashboard/{id}', [DashboardController::class, 'destroy'])->middleware(['auth', 'verified'])->name('dashboard.destroy.dir');

//Route::post('/dashboard/update', [DashboardController::class, 'update'])->middleware(['auth', 'verified'])->name('dashboard.update');
Route::get('/dashboard/upload/{where}', [DashboardController::class, 'upload'])->middleware(['auth', 'verified'])->name('dashboard.upload.file');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
