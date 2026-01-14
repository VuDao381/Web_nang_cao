<header>

    <div class="top-header">
        <span>📞 0987 654 321</span>
        <span>✉ abcbook@gmail.com</span>
        <span>📍 123 Đường ABC, Hà Nội</span>

        <nav>
            <a href="#">Đăng nhập</a>
            <a href="#" class="register-btn">Đăng ký</a>
        </nav>
    </div>

    <div class="main-header">
        <h1 class="logo">📚 ABC Book</h1>

        <div class="search-cart">
            <form class="search-box">
                <input type="text" placeholder="Tìm kiếm sách..." aria-label="Search books">
                <button type="submit">Search</button>
            </form>

            <a href="#" class="cart-btn">
                🛒
                <span class="cart-count">0</span>
            </a>
        </div>
    </div>

    <nav class="main-menu">
        <a href="{{ url('/') }}">Home</a>
        <a href="{{ route('books.index') }}">Books</a>
    </nav>

</header>
