<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TicketCategoryController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\EmployeeDashboardController;
use App\Http\Controllers\EmployeeTicketController;
use App\Http\Controllers\TechnicianDashboardController;
use App\Http\Controllers\TechnicianTicketController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.process');
});

Route::middleware('auth')->group(function () {
    Route::prefix('admin')
        ->middleware('admin')
        ->name('admin.')
        ->group(function () {
            Route::get(
                '/dashboard',
                [AdminDashboardController::class, 'index']
            )->name('dashboard');

            Route::resource(
                'categories',
                TicketCategoryController::class
            )
                ->parameters([
                    'categories' => 'ticketCategory',
                ])
                ->except(['show']);

            Route::resource('users', UserController::class)
             ->except(['show']);

            Route::resource('tickets', TicketController::class)
            ->except(['show']);

        });

    Route::prefix('employee')
        ->middleware('employee')
        ->name('employee.')
        ->group(function () {
            Route::get(
                '/dashboard',
                [EmployeeDashboardController::class, 'index']
            )->name('dashboard');

            Route::get(
                '/tickets',
                [EmployeeTicketController::class, 'index']
            )->name('tickets.index');

            Route::get(
                '/tickets/create',
                [EmployeeTicketController::class, 'create']
            )->name('tickets.create');

            Route::post(
                '/tickets',
                [EmployeeTicketController::class, 'store']
            )->name('tickets.store');
        });
    
    Route::prefix('technician')
    ->middleware('technician')
    ->name('technician.')
    ->group(function () {
        Route::get(
            '/dashboard',
            [TechnicianDashboardController::class, 'index']
        )->name('dashboard');

        Route::get(
            '/tickets',
            [TechnicianTicketController::class, 'index']
        )->name('tickets.index');

        Route::get(
            '/tickets/{ticket}/edit',
            [TechnicianTicketController::class, 'edit']
        )->name('tickets.edit');

        Route::put(
            '/tickets/{ticket}',
            [TechnicianTicketController::class, 'update']
        )->name('tickets.update');
    });

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});