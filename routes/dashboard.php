<?php

use App\Http\Controllers\Dashboard\DashboardCityController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\DashboardCountryController;
use App\Http\Controllers\Dashboard\DashboardPaymentController;
use App\Http\Controllers\Dashboard\DashboardPlanController;
use App\Http\Controllers\Dashboard\DashboardUserController;
Route::prefix('/dashboard')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

        Route::resource('countries', DashboardCountryController::class)
            ->names('dashboard.countries')
            ->except(['show']);
        Route::delete('/countries/{country}/force-delete', [DashboardCountryController::class, 'forceDelete'])
            ->name('dashboard.countries.force-delete');
        Route::put('/countries/{country}/restore', [DashboardCountryController::class, 'restore'])
            ->name('dashboard.countries.restore');

        Route::resource('cities', DashboardCityController::class)
            ->names('dashboard.cities')
            ->except(['show']);
        Route::delete('/cities/{city}/force-delete', [DashboardCityController::class, 'forceDelete'])
            ->name('dashboard.cities.force-delete');
        Route::put('/cities/{city}/restore', [DashboardCityController::class, 'restore'])
            ->name('dashboard.cities.restore');

        Route::resource('plans', DashboardPlanController::class)
            ->names('dashboard.plans')
            ->except(['show']);
        Route::put('/plans/{plan}/restore', [DashboardPlanController::class, 'restore'])
            ->name('dashboard.plans.restore');
        Route::delete('/plans/{plan}/force-delete', [DashboardPlanController::class, 'forceDelete'])
            ->name('dashboard.plans.force-delete');

        Route::resource('payments', DashboardPaymentController::class)
            ->names('dashboard.payments');

        Route::resource('users', DashboardUserController::class)
            ->names('dashboard.users');
    });
