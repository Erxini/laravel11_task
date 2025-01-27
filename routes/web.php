<?php

use App\Http\Controllers\DashboardController;
use App\Livewire\TaskComponent;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/tasks', TaskComponent::class)->name('tasks');
});

Route::get('/tasks', TaskComponent::class)->middleware('auth');

// Route::view('/', 'welcome');

Route::redirect('/', '/dashboard');

Route::get('dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('dashboard.nuevo', 'dashboard.nuevo')
    ->middleware(['auth', 'verified'])
    ->name('dashboard.nuevo');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
