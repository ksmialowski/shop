<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\Route;

Route::name('front.')
    ->group(function () {
        Route::name('home.')
            ->group(function () {
                Route::get('/', [HomeController::class, 'index'])->name('index');
            });
        Route::name('about.')
            ->prefix('about')
            ->group(function () {
                Route::get('/', [AboutController::class, 'index'])->name('index');
            });
        Route::name('shop.')
            ->prefix('shop')
            ->group(function () {
                Route::get('/', [ShopController::class, 'index'])->name('index');
            });
        Route::name('contact.')
            ->prefix('contact')
            ->group(function () {
                Route::get('/', [ContactController::class, 'index'])->name('index');
            });
    });
