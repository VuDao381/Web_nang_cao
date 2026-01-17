<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AuthController;   
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('books',BooksController::class);
Route::resource('categories',CategoryController::class);
Route::resource('publishers',PublisherController::class);
Route::resource('users', UserController::class);
Route::patch('users/{id}/toggle-status', [UserController::class, 'toggleStatus'])
    ->name('users.toggleStatus');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');
