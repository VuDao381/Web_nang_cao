<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PublisherController;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('books',BooksController::class);
Route::resource('categories',CategoryController::class);
Route::resource('publishers',PublisherController::class);