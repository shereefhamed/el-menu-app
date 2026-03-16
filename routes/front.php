<?php

use App\Http\Controllers\Front\HomeController;

Route::prefix('{locale?}')
    ->middleware('set.local')
    ->group(function () {
        Route::get('/', [HomeController::class, 'index']);
    });