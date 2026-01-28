<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'ABC Book') }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/books.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f9f9f9;
        }

        .main-container {
            display: flex;
            max-width: 1200px;
            margin: 20px auto;
            gap: 30px;
            padding: 0 15px;
        }

        .sidebar-left {
            width: 250px;
            flex-shrink: 0;
            background: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            align-self: flex-start;
        }

        .content-right {
            flex: 1;
        }

        .sidebar-title {
            color: #555;
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 20px;
            text-transform: capitalize;
        }

        .bestseller-item {
            display: flex;
            gap: 12px;
            margin-bottom: 20px;
            align-items: center;
        }

        .bestseller-item img {
            width: 60px;
            height: 80px;
            object-fit: cover;
            border-radius: 4px;
        }

        .bestseller-info h4 {
            font-size: 14px;
            color: #333;
            margin-bottom: 5px;
            line-height: 1.3;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .bestseller-price {
            color: #ff3b2f;
            font-weight: bold;
            font-size: 13px;
        }

        /* Customizing Grid for Welcome Page */
        .books-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }

        .book-card {
            border: 1px solid #eee;
            box-shadow: none;
            transition: 0.2s;
        }

        .book-card:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .book-card img {
            height: 250px;
        }

        .book-info {
            padding: 12px;
            text-align: center;
        }

        .book-info h3 {
            font-size: 15px;
            font-weight: 600;
            margin-bottom: 8px;
            height: 40px;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .book-info p {
            display: none;
            /* Hide author/other details as requested "chỉ cần hiển thị tên và giá tiền" */
        }

        .price {
            color: #ff3b2f;
            font-size: 15px;
        }

        /* Sticky Sidebar */
        .sidebar-left {
            position: sticky;
            top: 20px;
        }
    </style>
</head>

<body>

    <!-- Top Header -->
    <header class="top-header">
        <span>Hotline: <b>0912.345.678</b></span>
        <nav>
            <a href="#">Giới thiệu</a>
            <a href="#">Liên hệ</a>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                @else
                    <a href="{{ route('login') }}">Đăng nhập</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Đăng ký</a>
                    @endif
                @endauth
            @endif
        </nav>
    </header>

    <!-- Main Header -->
    <div class="main-header">
        <div class="logo">
            <i class="fa-solid fa-book-open"></i> ABC BOOK
        </div>

        <div class="search-cart">
            <div class="search-box">
                <input type="text" placeholder="Tìm kiếm sách, tác giả...">
                <button><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
            <a href="#" class="cart-btn">
                <i class="fa-solid fa-cart-shopping"></i>
                <span class="cart-count">0</span>
            </a>
        </div>
    </div>

    <!-- Main Menu -->
    <div class="main-menu">
        <a href="/">TRANG CHỦ</a>
        <a href="#">THỂ LOẠI</a>
        <a href="#">TÁC GIẢ</a>
        <a href="#">NHÀ XUẤT BẢN</a>
        <a href="#">KHUYẾN MÃI</a>
        <a href="#">TIN TỨC</a>
    </div>

    <!-- Main Content -->
    <div class="main-container">
        <!-- Sidebar -->
        <aside class="sidebar-left">
            <div class="sidebar-title">Sách Mới Bán Chạy</div>

            @foreach($books->take(5) as $book)
                <div class="bestseller-item">
                    <a href="#">
                        <img src="{{ $book->image ?: 'https://via.placeholder.com/60x80' }}"
                            alt="{{ $book->title }}">
                    </a>
                    <div class="bestseller-info">
                        <h4><a href="#" style="text-decoration: none; color: inherit;">{{ $book->title }}</a></h4>
                        <div class="bestseller-price">{{ number_format($book->price, 0, ',', '.') }}đ</div>
                    </div>
                </div>
            @endforeach

        </aside>

        <!-- Book List -->
        <main class="content-right">
            <div class="books-grid">
                @foreach($books as $book)
                    <div class="book-card" onclick="alert('Xem chi tiết sách: {{ $book->title }}')"
                        style="cursor: pointer;">
                        <img src="{{ $book->image ?: 'https://via.placeholder.com/200x280' }}" alt="{{ $book->title }}">
                        <div class="book-info">
                            <h3>{{ $book->title }}</h3>
                            <div class="price">{{ number_format($book->price, 0, ',', '.') }}đ</div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="pagination-wrapper" style="margin-top: 40px;">
                {{ $books->onEachSide(1)->links('pagination::numbers-only') }}
            </div>
        </main>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-box">
                <h3>Về ABC Book</h3>
                <p>Chúng tôi cung cấp hàng nghìn đầu sách đa dạng thể loại, phục vụ nhu cầu đọc sách của mọi lứa tuổi.
                    Cam kết sách thật, giá trị thật.</p>
                <div style="margin-top: 15px; font-size: 24px;">
                    <i class="fa-brands fa-facebook" style="margin-right: 15px;"></i>
                    <i class="fa-brands fa-instagram" style="margin-right: 15px;"></i>
                    <i class="fa-brands fa-twitter"></i>
                </div>
            </div>
            <div class="footer-box">
                <h4>Hỗ trợ khách hàng</h4>
                <ul>
                    <li><a href="#">Hướng dẫn mua hàng</a></li>
                    <li><a href="#">Chính sách đổi trả</a></li>
                    <li><a href="#">Phương thức thanh toán</a></li>
                    <li><a href="#">Vận chuyển & Giao nhận</a></li>
                </ul>
            </div>
            <div class="footer-box">
                <h4>Liên hệ</h4>
                <ul>
                    <li><i class="fa-solid fa-location-dot" style="margin-right: 8px;"></i> 123 Đường Sách, Q.1, TP.HCM
                    </li>
                    <li><i class="fa-solid fa-phone" style="margin-right: 8px;"></i> 0912.345.678</li>
                    <li><i class="fa-solid fa-envelope" style="margin-right: 8px;"></i> support@abcbook.com</li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; 2026 ABC Book. All rights reserved.
        </div>
    </footer>

</body>

</html>