<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;

Route::resource('books',BooksController::class);