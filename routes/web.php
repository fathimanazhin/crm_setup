<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('dashboard');
});
// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Authenticated routes
Route::middleware(['auth', 'verified'])->group(function () {

    // Customers
    Route::resource('customers', CustomerController::class);

    // Leads
    Route::resource('leads', LeadController::class);
    Route::patch('leads/{lead}/convert', [LeadController::class, 'convertToCustomer'])
    ->name('leads.convertToCustomer');

    // Tasks
    Route::resource('tasks', TaskController::class);
    Route::patch('tasks/{task}/complete', [TaskController::class, 'markCompleted'])
        ->name('tasks.complete');

    // Profile
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

Route::get('/activities/download', [DashboardController::class, 'downloadActivities'])
    ->name('activities.download');
    });
Route::get('/calendar', [App\Http\Controllers\CalendarController::class, 'index'])->name('calendar.index');
Route::get('/calendar/events', [App\Http\Controllers\CalendarController::class, 'events'])->name('calendar.events');

// Auth routes
require __DIR__.'/auth.php';