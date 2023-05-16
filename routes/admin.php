<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();
Route::name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::middleware('auth')
            ->group(function () {
                Route::name('profile.')
                    ->prefix('profile')
                    ->group(function () {
                        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
                        Route::put('/edit', [ProfileController::class, 'update'])->name('update');
                        Route::put('/password', [ProfileController::class, 'password'])->name('password');
                    });

                Route::name('user.')
                    ->prefix('user')
                    ->group(function () {
                        Route::get('/', [UserController::class, 'index'])->name('index');
                        Route::match(['get', 'post'], '/edit/{id?}', [UserController::class, 'edit'])->name('edit');
                        Route::get('/delete/{id?}', [UserController::class, 'delete'])->name('delete');
                    });

                Route::name('category.')
                    ->prefix('category')
                    ->group(function () {
                        Route::get('/', [CategoryController::class, 'index'])->name('index');
                        Route::match(['get', 'post'], '/edit/{id?}', [CategoryController::class, 'edit'])->name('edit');
                        Route::get('/delete/{id?}', [CategoryController::class, 'delete'])->name('delete');
                    });

                Route::name('product.')
                    ->prefix('product')
                    ->group(function () {
                        Route::get('/', [ProductController::class, 'index'])->name('index');
                        Route::match(['get', 'post'], '/edit/{id?}', [ProductController::class, 'edit'])->name('edit');
                        Route::get('/delete/{id?}', [ProductController::class, 'delete'])->name('delete');
                        Route::post('/delete-photo', [ProductController::class, 'deletePhoto'])->name('delete-photo');
                        Route::match(['get', 'post'], '/edit/{id?}/specification', [ProductController::class, 'editSpecification'])->name('edit-specification');
                    });

                Route::name('config.')
                    ->prefix('config')
                    ->group(function () {
                        Route::match(['get', 'post'], '/', [ConfigController::class, 'edit'])->name('edit');
                    });
            });
    });
