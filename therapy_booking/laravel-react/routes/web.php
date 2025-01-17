<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/appointments/create', function () {
    return Inertia::render('BookAppointment');
})->middleware(['auth'])->name('appointments.create');

// Route::middleware('auth')->group(function () {
//     Route::get('/', [ProfileController::class, 'create'])->name('appointments.create');
//     Route::post('/', [ProfileController::class, 'store'])->name('appointments.store');
//     Route::get('/', [ProfileController::class, 'edit'])->name('appointments.edit');
//     Route::patch('/', [ProfileController::class, 'update'])->name('appointments.update');
//     Route::delete('/', [ProfileController::class, 'destroy'])->name('appointments.destroy');
// });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
