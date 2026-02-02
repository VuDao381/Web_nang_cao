<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProfileController,
    CartController,
    NotificationController
};

Route::middleware('auth')->group(function () {

    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::prefix('cart')->name('cart.')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::post('/add', [CartController::class, 'addToCart'])->name('add');
        Route::post('/update', [CartController::class, 'update'])->name('update');
        Route::delete('/{id}', [CartController::class, 'remove'])->name('remove');
    });

    Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');

    Route::post(
        '/notifications/mark-read',
        [NotificationController::class, 'markAsRead']
    )->name('notifications.markRead');
});
