<?php

use App\Http\Controllers\Dashboard\DashbaordMenuItemController;
use App\Http\Controllers\Dashboard\DashboardAddonController;
use App\Http\Controllers\Dashboard\DashboardAttributeController;
use App\Http\Controllers\Dashboard\DashboardCategoryController;
use App\Http\Controllers\Dashboard\DashboardCityController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\DashboardCountryController;
use App\Http\Controllers\Dashboard\DashboardInfoController;
use App\Http\Controllers\Dashboard\DashboardPaymentController;
use App\Http\Controllers\Dashboard\DashboardPlanController;
use App\Http\Controllers\Dashboard\DashboardQRController;
use App\Http\Controllers\Dashboard\DashboardRestaurantController;
use App\Http\Controllers\Dashboard\DashboardRestaurantTypeController;
use App\Http\Controllers\Dashboard\DashboardSocialMediaController;
use App\Http\Controllers\Dashboard\DashboardUpgradeSubscription;
use App\Http\Controllers\Dashboard\DashboardUserController;
use App\Http\Controllers\Dashboard\DashboardRestaurantBranchController;
use App\Http\Controllers\Dashboard\DashboardRestaurantSocialMediaController;

Route::prefix('/dashboard')
    ->middleware(['auth', 'dashboard'])
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
        Route::put('/users/{user}/update-password', [DashboardUserController::class, 'updatePassword'])
            ->name('dashboard.users.update-password');
        Route::delete('/users/{user}/force-delete', [DashboardUserController::class, 'forceDelete'])
            ->name('dashboard.users.force-delete');
        Route::put('/users/{user}/restore', [DashboardUserController::class, 'restore'])
            ->name('dashboard.users.restore');

        Route::resource('attributes', DashboardAttributeController::class)
            ->names('dashboard.attributes');

        Route::resource('restaurant-types', DashboardRestaurantTypeController::class)
            ->names('dashboard.restaurant-types');

        Route::resource('social-media', DashboardSocialMediaController::class)
            ->names('dashboard.social-media');

        Route::get('/info', [DashboardInfoController::class, 'index'])
            ->name('dashboard.info.index');
        Route::post('/info', [DashboardInfoController::class, 'store'])
            ->name('dashboard.info.store');

        // Categories
        Route::resource('categories', DashboardCategoryController::class)
            ->names('dashboard.categories');
        Route::put('/categories/{category}/restore', [DashboardCategoryController::class, 'restore'])
            ->name('dashboard.categories.restore');
        Route::delete('/categories/{category}/force-delete', [DashboardCategoryController::class, 'forceDelete'])
            ->name('dashboard.categories.force-delete');

        // MenuItems
        Route::resource('menu-items', DashbaordMenuItemController::class)
            ->names('dashboard.menu-items');
        Route::put('/menu-items/{menu_item}/restore', [DashbaordMenuItemController::class, 'restore'])
            ->name('dashboard.menu-items.restore');
        Route::delete('/menu-items/{menu_item}/force-delete', [DashbaordMenuItemController::class, 'forceDelete'])
            ->name('dashboard.menu-items.force-delete');

        // Route::resource('restaurants.categories', DashboardRestaurantCategoryController::class)->only(['show']);
    
        //Restaurants
        Route::resource('restaurants', DashboardRestaurantController::class)
            ->names('dashboard.restaurants');
        Route::delete('/restauarnts/{resturant}/force-delete', [DashboardRestaurantController::class, 'forceDelete'])
            ->name('dashboard.restaurants.force-delete');
        Route::put('/restaurants/{restaurant}/restore', [DashboardRestaurantController::class, 'restore'])
            ->name('dashboard.restaurants.restore');
        Route::get('/restaurants/{restaurant}/categories', [DashboardRestaurantController::class, 'categories'])
            ->name('dashboard.restaurants.categories');

        //Addons
        Route::resource('addons', DashboardAddonController::class)
            ->names('dashboard.addons');

        // Restaurant Branche
        Route::resource('restaurants.branches', DashboardRestaurantBranchController::class)
            ->names('dashboard.restaurants.branches')
            ->only(['store', 'update', 'destroy']);

        //Resataurant Socail Media
        Route::resource('restaurants.socailMedia', DashboardRestaurantSocialMediaController::class)
            ->only(['store', 'update', 'destroy'])
            ->names('dashbaord.restaurant.social-media');

        //QR code
        Route::get('/qr-code/download/{restaurant}', [DashboardQRController::class, 'download'])
            ->name('dashboard.qr.download');

        //Upgrade subscription
        Route::get('/upgrade-subscription', [DashboardUpgradeSubscription::class, 'index'])
            ->name('dashboard.upgrade-subscription.index');
        Route::get('/upgrade-subscription/payment-success', [DashboardUpgradeSubscription::class, 'paymentSuccess'])
            ->name('dashboard.upgrade-subscription.payment-success');
        Route::get('/upgrade-subscription/{planId}', [DashboardUpgradeSubscription::class, 'subscripe'])
            ->name('dashboard.upgrade-subscription.subscripe');
        
    });
