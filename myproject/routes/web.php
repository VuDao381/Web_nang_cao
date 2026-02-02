<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Books;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\NotificationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Trang chủ
Route::get('/', function (Request $request) {
    $keyword = $request->input('keyword');

    $books = Books::when($keyword, function ($query, $keyword) {
        return $query->where('title', 'like', "%{$keyword}%")
            ->orWhere('author', 'like', "%{$keyword}%");
    })->latest()->paginate(20);

    // Lấy sách bán chạy (tính tổng quantity trong order_items)
    $bestsellers = Books::withSum('orderItems', 'quantity')
        ->orderByDesc('order_items_sum_quantity')
        ->take(5)
        ->get();

    // Nếu dữ liệu order ít, có thể lấy tạm sách mới nhất để không bị trống
    if ($bestsellers->isEmpty() || $bestsellers->sum('order_items_sum_quantity') == 0) {
        $bestsellers = Books::inRandomOrder()->take(5)->get();
    }

    $categories = Category::all();

    return view('user.welcome', compact('books', 'categories', 'bestsellers'));
})->name('home');

// Trang chi tiết sách
Route::get('/book/{slug}', function ($slug) {
    // Tìm trong toàn bộ sách xem cuốn nào có slug (tạo từ title) trùng khớp
    // Lưu ý: Cách này tiện lợi cho BTL nhưng không tối ưu nếu dữ liệu quá lớn (nên thêm cột slug vào DB)
    $books = Books::with(['category', 'publisher'])->get();

    $book = $books->first(function ($item) use ($slug) {
        return Str::slug($item->title) === $slug;
    });

    if (!$book) {
        abort(404);
    }

    return view('user.detail', compact('book'));
})->name('book.detail');

// Trang danh sách sách theo thể loại
Route::get('/category/{slug}', [BooksController::class, 'booksByCategory'])->name('category.books');

// Trang danh sách sách theo nhà xuất bản
Route::get('/publisher/{slug}', [BooksController::class, 'booksByPublisher'])->name('publisher.books');

// --- ADMIN ROUTES (Yêu cầu đăng nhập + Role Admin) ---
Route::middleware(['auth', 'admin'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');



    // Quản lý Sách
    Route::resource('books', BooksController::class);

    // Quản lý Thể loại
    Route::resource('categories', CategoryController::class);

    // Quản lý Nhà xuất bản
    Route::resource('publishers', PublisherController::class);

    // Quản lý Người dùng
    Route::resource('users', UserController::class);

    // Quản lý Đơn hàng
    Route::resource('orders', OrderController::class)->only(['index', 'show', 'update']);
});

// --- USER ROUTES (Yêu cầu đăng nhập) ---
Route::middleware('auth')->group(function () {
    // Quản lý Profile thành viên (Ai đăng nhập cũng được sửa)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- CART ROUTES ---
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');

    // Notifications
    Route::post('/notifications/mark-read', [NotificationController::class, 'markAsRead'])->name('notifications.markRead');
});

// Các file Route tách rời (Đảm bảo các file này tồn tại trong thư mục routes/)
require __DIR__ . '/auth.php';
require __DIR__ . '/user.php';