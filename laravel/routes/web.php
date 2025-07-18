<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Livewire\MyBookings;

Route::get('/admin/login', fn () => redirect()->to('/login'))
    ->name('filament.admin.auth.login');

Route::middleware(['auth'])->group(function () {
    Route::get('/mes-reservations', MyBookings::class)
        ->name('my-bookings');
});
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/test-ui', function () {
    return view('test-ui');
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/bookings', function () {
        return view('bookings');
    })->name('bookings');
});

require __DIR__.'/auth.php';
