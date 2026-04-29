<?php

use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JardinController;
use App\Http\Controllers\PlanteController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])//, 'role:admin'
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Categories
        Route::get('/categories', [CategorieController::class, 'index'])->name('categories.index');
        Route::post('/categories', [CategorieController::class, 'store'])->name('categories.store');
        Route::delete('/categories/{categorie}', [CategorieController::class, 'destroy'])->name('categories.destroy');
        Route::patch('/categories/{categorie}', [CategorieController::class, 'update'])->name('categories.edit');
        // Plantes
        Route::resource('plantes', PlanteController::class);

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::name('client.')->group(function (){
    // plantes
    Route::resource('plantes', PlanteController::class);

    // test
    Route::resource('my-garden', JardinController::class);
    Route::resource('calendar', CalendarController::class);
});

Route::post('/add-plant', [PlanteController::class, 'store'])->name('test');

require __DIR__.'/auth.php';