<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DashboardController,
    BooksController,
    CategoryController,
    PublisherController,
    UserController,
    OrderController
};

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('books', BooksController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('publishers', PublisherController::class);
        Route::resource('users', UserController::class);
        Route::resource('orders', OrderController::class)
            ->only(['index', 'show', 'update']);
    });
