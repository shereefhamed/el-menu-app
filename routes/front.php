<?php

use App\Http\Controllers\Front\AboutController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\CountryController;
use App\Http\Controllers\Front\FavoriteController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\MyAccountController;
use App\Http\Controllers\Front\OrderController;
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
        Route::get('/favorites/items', [FavoriteController::class, 'getItems'])->name('favorites.items');
        Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
        Route::post('/cart/add-item/{menuItem}', [CartController::class, 'addItem'])->name('cart.add');
        Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
        Route::delete('/cart/remove-item/{id}', [CartController::class, 'removeItem'])->name('cart.remove');
        Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
        Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
        Route::get('/checkout/{orderId}/thank-you', [CheckoutController::class, 'thankyou'])->name('checkout.thankyou');
        Route::get('/my-account', [MyAccountController::class, 'index'])->name('my-account.index');
        Route::put('/my-account/update-profile', [MyAccountController::class, 'updateProfile'])->name('my-account.update-profile');
        Route::put('my-account/update-address', [MyAccountController::class, 'updateAddress'])->name('my-account.update-address');
        Route::resource('orders', OrderController::class)->only(['show', 'update']);
   

        // Route::get('/send-test-email', function () {
        //     // dd(public_path('images/download.jpg'), storage_path('app/public/logos/0NRXlIvwKV0TAEWuVJFDFEn2W2gHhiJ0ZLOD9wFb.png'));
        //     $restautant = Restaurant::onlyTrashed()->find(3);
        //     Mail::to('test@test.com')->send(new TestMail($restautant));
        //     // Mail::to('test@test.com')->queue(new TestMail($restautant));
        // });

    });
// Route::resource('restaurants', RestaurantController::class)->only(['index', 'show']);

