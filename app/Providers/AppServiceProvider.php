<?php

namespace App\Providers;

use App\Models\User;
use App\View\Composers\NavComposer;
use App\View\Composers\SearchComposer;
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
            ],
            NavComposer::class
        );
    }
}
