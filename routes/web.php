<?php

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\PlanteController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])//, 'role:admin'
    ->name('admin.')
    ->group(function () {
        // Categories
        Route::get('/categories', [CategorieController::class, 'index'])->name('categories.index');
        Route::post('/categories', [CategorieController::class, 'store'])->name('categories.store');
        // Plantes
        Route::resource('plantes', PlanteController::class);
});

Route::get('/dashboard', [CategorieController::class, 'index'])->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';