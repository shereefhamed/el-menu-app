<?php

use App\Http\Controllers\Front\AboutController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\RestaurantController;
use App\Http\Controllers\Front\RestaurantMenuItemController;

Route::prefix('{locale?}')
    ->middleware('set.locale')
    ->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::resource('restaurants', RestaurantController::class)->only(['index', 'show']);
        Route::resource('restaurants.menuItems', RestaurantMenuItemController::class)->only(['show']);
        Route::get('/about/{restaurant}', [AboutController::class, 'index'])->name('about.index');
    });
// Route::resource('restaurants', RestaurantController::class)->only(['index', 'show']);