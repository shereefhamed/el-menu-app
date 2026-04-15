<?php

use App\Http\Controllers\Front\AboutController;
use App\Http\Controllers\Front\CountryController;
use App\Http\Controllers\Front\FavoriteController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\RestaurantController;
use App\Http\Controllers\Front\RestaurantMenuItemController;
use App\Mail\TestMail;
use App\Models\Restaurant;

Route::prefix('{locale?}')
    ->middleware('set.locale')
    ->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::post('/send-mail', [HomeController::class, 'sendMail'])->name('send-mail');
        Route::resource('restaurants', RestaurantController::class)->only(['index', 'show', 'create', 'store']);
        Route::resource('restaurants.menuItems', RestaurantMenuItemController::class)->only(['show']);
        Route::get('/about/{restaurant}', [AboutController::class, 'index'])->name('about.index');
        Route::get('/countries/{cointryId}/cities', [CountryController::class, 'cities'])->named('country.cities');
        Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');

        // Route::get('/send-test-email', function () {
        //     // dd(public_path('images/download.jpg'), storage_path('app/public/logos/0NRXlIvwKV0TAEWuVJFDFEn2W2gHhiJ0ZLOD9wFb.png'));
        //     $restautant = Restaurant::onlyTrashed()->find(3);
        //     Mail::to('test@test.com')->send(new TestMail($restautant));
        //     // Mail::to('test@test.com')->queue(new TestMail($restautant));
        // });

    });
// Route::resource('restaurants', RestaurantController::class)->only(['index', 'show']);

