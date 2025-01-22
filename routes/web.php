<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\FileController;
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
Route::get('/dashboard/create/{where?}', [DashboardController::class, 'create'])->middleware(['auth', 'verified'])->name('dashboard.create.dir');
Route::post('/dashboard', [DashboardController::class, 'store'])->middleware(['auth', 'verified'])->name('dashboard.store.dir');

// Delete
Route::delete('dashboard/{id}', [DashboardController::class, 'destroy'])->middleware(['auth', 'verified'])->name('dashboard.destroy.dir');

// FILE CONTROLLER
Route::get('/dashboard/upload/{where}', [FileController::class , 'draw'])->middleware(['auth', 'verified'])->name('file.create'); // Pinta el formulario
Route::post('/dashboard/upload/{where}', [FileController::class , 'upload'])->middleware(['auth', 'verified'])->name('file.upload'); // Sube el archivo
Route::get('/dashboard/download/{id}', [FileController::class, 'download'])->middleware(['auth', 'verified'])->name('file.download'); // Baja el archivo
Route::delete('/dashboard/delete/{id}', [FileController::class, 'delete'])->middleware(['auth', 'verified'])->name('file.delete'); // Elimina el archivo


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
