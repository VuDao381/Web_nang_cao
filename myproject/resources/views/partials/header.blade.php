<header class="top-header">
    <span>Hotline: <b>0912.345.678</b></span>
    <nav>
        <a href="#">Giới thiệu</a>
        <a href="#">Liên hệ</a>
        @if (Route::has('login'))
            @auth
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('dashboard') }}">Quản trị</a>
                @endif
                <a href="{{ route('profile.edit') }}">Tài khoản</a>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                        Đăng xuất
                    </a>
                </form>
            @else
                <a href="{{ route('login') }}">Đăng nhập</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Đăng ký</a>
                @endif
            @endauth
        @endif
    </nav>
</header>

<div class="main-header">
    <div class="logo">
        <i class="fa-solid fa-book-open"></i> ABC BOOK
    </div>

    <div class="search-cart">
        <form action="/" method="GET" class="search-box">
            <input type="text" name="keyword" placeholder="Tìm kiếm sách, tác giả..." value="{{ request('keyword') }}">
            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
        <a href="#" class="cart-btn">
            <i class="fa-solid fa-cart-shopping"></i>
            <span class="cart-count">0</span>
        </a>
    </div>
</div>

<div class="main-menu">
    <a href="/">TRANG CHỦ</a>
    <a href="#">THỂ LOẠI</a>
    <a href="#">TÁC GIẢ</a>
    <a href="#">NHÀ XUẤT BẢN</a>
    <a href="#">KHUYẾN MÃI</a>
    <a href="#">TIN TỨC</a>
</div>