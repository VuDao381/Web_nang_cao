<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PublisherController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Trang chủ
Route::get('/', function () {
    return view('welcome');
});

// Trang Dashboard (Yêu cầu đăng nhập)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Nhóm các Route yêu cầu xác thực người dùng (Auth)
Route::middleware('auth')->group(function () {
    
    // Quản lý Profile thành viên
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Quản lý Sách (Sử dụng Resource để có đầy đủ index, create, store, edit, update, destroy)
    Route::resource('books', BookController::class);

    // Quản lý Thể loại
    Route::resource('categories', CategoryController::class);

    // Quản lý Nhà xuất bản
    Route::resource('publishers', PublisherController::class);
});

// Các file Route tách rời (Đảm bảo các file này tồn tại trong thư mục routes/)
require __DIR__.'/auth.php';
require __DIR__.'/books.php';
require __DIR__.'/category.php';
require __DIR__.'/publisher.php';
require __DIR__.'/user.php';