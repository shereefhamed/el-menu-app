<?php

namespace App\Providers;

use App\Contracts\CartInterface;
use App\Models\User;
use App\Services\Cart\CartManager;
use App\Services\Paymob;
use App\View\Composers\NavComposer;
use App\View\Composers\SearchComposer;
use Illuminate\Foundation\Application;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        Gate::define('isAdmin', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('isOwner', function (User $user) {
            return $user->isOwner();
        });

        View::composer(['front.home.index', 'front.restaurants.index'], SearchComposer::class);
        View::composer(
            [
                'front.home.index',
                'front.restaurants.index',
                'front.favorites.index',
                'front.cart.index',
                'front.checkout.index',
                'front.checkout.thank-you',
                'front.my-account.index',
                'front.orders.show',
            ],
            NavComposer::class
        );

        // $this->app->bind(Paymob::class, function(Application $app){
        //     return new Paymob();
        // });

        $this->app->singleton(Paymob::class, function (Application $app) {
            return new Paymob(
                secretKey: env('PAYMOB_SECRET_KEY'),
                onlineCardId: env('PAYMOB_ONLINE_CARD_ID'),
                hmacKey: env('HMAC'),
            );
        });

        $this->app->bind(
            CartInterface::class,
            CartManager::class,
        );
    }
}
