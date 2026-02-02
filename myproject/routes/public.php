<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BooksController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/book/{slug}', [BooksController::class, 'showBySlug'])
    ->name('book.detail');

Route::get('/category/{slug}', [BooksController::class, 'booksByCategory'])
    ->name('category.books');

Route::get('/publisher/{slug}', [BooksController::class, 'booksByPublisher'])
    ->name('publisher.books');
