<header>

    <div class="top-header">
        <span>📞 0987 654 321</span>
        <span>✉ abcbook@gmail.com</span>
        <span>📍 123 Đường ABC, Hà Nội</span>

        <nav>
            @auth
                <span>👋 Xin chào, <strong>{{ Auth::user()->name }}</strong></span>

                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="logout-btn">
                        Đăng xuất
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}">Đăng nhập</a>
                <a href="{{ route('register') }}" class="register-btn">Đăng ký</a>
            @endauth
        </nav>
    </div>

    <div class="main-header">
        <h1 class="logo">📚 ABC Book</h1>

        <div class="search-cart">
            <form class="search-box" action="{{ route('books.index') }}" method="GET">
                <input
                    type="text"
                    name="keyword"
                    placeholder="Tìm theo tên sách, tác giả, NXB, thể loại..."
                    value="{{ request('keyword') }}"
                >
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
        <a href="{{ route('categories.index') }}">Category</a>
        <a href="{{ route('publishers.index') }}">Publisher</a>
        <a href="{{ route('users.index') }}">User</a>

        @auth
            <a href="{{ route('dashboard') }}">Dashboard</a>
        @endauth
    </nav>

</header>
