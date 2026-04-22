<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategorieController;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])//, 'role:admin'
    ->name('admin.')
    ->group(function () {
    Route::get('/categories', [CategorieController::class, 'index'])->name('categories.index');
    // Route::get('/categories/create', [CategorieController::class, 'create'])->name('categories.create');
    Route::post('/categories/create', [CategorieController::class, 'store'])->name('categories.store');
});

Route::get('/dashboard', [CategorieController::class, 'index'])->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';