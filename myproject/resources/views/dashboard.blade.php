<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/books.css') }}">
    <link rel="stylesheet" href="{{ asset('css/category.css') }}">
    <link rel="stylesheet" href="{{ asset('css/publisher.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>@yield('title', 'ABC Book Admin')</title>
</head>

<body>

    <aside class="sidebar">
        <div class="sidebar-header">
            📚 <span style="color: #a5d6a7">ABC</span> BOOK
        </div>

        <nav class="sidebar-menu">
            <div class="menu-label">Navigation</div>
            <a href="{{ route('dashboard') }}" class="menu-item {{ Request::is('dashboard') ? 'active' : '' }}">
                <div class="menu-content">
                    <i class="fa-solid fa-gauge-high"></i>
                    <span>Dashboard</span>
                </div>
            </a>

            <div class="menu-label">Quản lý nội dung</div>

            {{-- KHỐI 1: QUẢN LÝ SÁCH --}}
            <div class="menu-group {{ Request::is('books*') ? 'open' : '' }}">
                <div class="menu-item {{ Request::is('books*') ? 'active' : '' }}" onclick="toggleSubmenu(this)">
                    <div class="menu-content">
                        <i class="fa-solid fa-book"></i>
                        <span>Quản lý sách</span>
                    </div>
                    <i class="fa-solid fa-chevron-right arrow"></i>
                </div>
                <div class="submenu">
                    <a href="{{ route('books.index') }}"
                        style="{{ Request::is('books') ? 'color:#fff; font-weight:bold;' : '' }}">
                        <i class="fa-solid fa-list-ul" style="font-size: 11px; margin-right: 8px;"></i> Danh sách sách
                    </a>
                    <a href="{{ route('books.create') }}"
                        style="{{ Request::is('books/create') ? 'color:#fff; font-weight:bold;' : '' }}">
                        <i class="fa-solid fa-plus" style="font-size: 11px; margin-right: 8px;"></i> Thêm sách mới
                    </a>
                </div>
            </div>

            {{-- KHỐI 2: QUẢN LÝ THỂ LOẠI (Cùng cấp - Màu đồng bộ) --}}
            <div class="menu-group {{ Request::is('categories*') ? 'open' : '' }}">
                <div class="menu-item {{ Request::is('categories*') ? 'active' : '' }}" onclick="toggleSubmenu(this)">
                    <div class="menu-content">
                        <i class="fa-solid fa-layer-group"></i>
                        <span>Quản lý thể loại</span>
                    </div>
                    <i class="fa-solid fa-chevron-right arrow"></i>
                </div>
                <div class="submenu">
                    <a href="{{ route('categories.index') }}"
                        style="{{ Request::is('categories') ? 'color:#fff; font-weight:bold;' : '' }}">
                        <i class="fa-solid fa-list" style="font-size: 11px; margin-right: 8px;"></i> Danh sách thể loại
                    </a>
                    <a href="{{ route('categories.create') }}"
                        style="{{ Request::is('categories/create') ? 'color:#fff; font-weight:bold;' : '' }}">
                        <i class="fa-solid fa-plus" style="font-size: 11px; margin-right: 8px;"></i> Thêm thể loại
                    </a>
                </div>
            </div>

            {{-- KHỐI 3: QUẢN LÝ NHÀ XUẤT BẢN (Cùng cấp - Màu đồng bộ) --}}
            <div class="menu-group {{ Request::is('publishers*') ? 'open' : '' }}">
                <div class="menu-item {{ Request::is('publishers*') ? 'active' : '' }}" onclick="toggleSubmenu(this)">
                    <div class="menu-content">
                        <i class="fa-solid fa-print"></i>
                        <span>Quản lý nhà xuất bản</span>
                    </div>
                    <i class="fa-solid fa-chevron-right arrow"></i>
                </div>
                <div class="submenu">
                    <a href="{{ route('publishers.index') }}"
                        style="{{ Request::is('publishers') ? 'color:#fff; font-weight:bold;' : '' }}">
                        <i class="fa-solid fa-list-check" style="font-size: 11px; margin-right: 8px;"></i> Danh sách NXB
                    </a>
                    <a href="{{ route('publishers.create') }}"
                        style="{{ Request::is('publishers/create') ? 'color:#fff; font-weight:bold;' : '' }}">
                        <i class="fa-solid fa-plus" style="font-size: 11px; margin-right: 8px;"></i> Thêm NXB
                    </a>
                </div>
            </div>

            <div class="menu-label">Hệ thống</div>
            <div class="menu-group">
                <div class="menu-item" onclick="toggleSubmenu(this)">
                    <div class="menu-content">
                        <i class="fa-solid fa-user-gear"></i>
                        <span>Tài khoản</span>
                    </div>
                    <i class="fa-solid fa-chevron-right arrow"></i>
                </div>
                <div class="submenu">
                    <a href="{{ route('profile.edit') }}">Thông tin cá nhân</a>
                    <a href="#">Phân quyền</a>
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" class="menu-item"
                    onclick="event.preventDefault(); this.closest('form').submit();">
                    <div class="menu-content">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Đăng xuất</span>
                    </div>
                </a>
            </form>
        </nav>
    </aside>

    <main class="main-wrapper">
        <header class="topbar">
            <div class="search-area">
                <form action="{{ route('books.index') }}" method="GET"
                    style="display: flex; width: 100%; align-items:center;">
                    <button type="submit" style="border:none; background:none; cursor:pointer; padding: 0 5px;">
                        <i class="fa-solid fa-magnifying-glass" style="color:#2e7d32"></i>
                    </button>
                    <input type="text" name="keyword" placeholder="Tìm kiếm..." value="{{ request('keyword') }}">
                </form>
            </div>

            <div class="user-profile">
                <span style="margin-right: 12px; font-size: 14px;">Chào,
                    <strong>{{ Auth::user()->name ?? 'Admin' }}</strong></span>
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name ?? 'Admin' }}&background=2e7d32&color=fff"
                    width="38" style="border-radius: 50%; border: 2px solid #e8f5e9;">
            </div>
        </header>

        <div class="container">
            @yield('content')
        </div>

        <footer>
            © 2026 <strong>ABC Book Admin</strong>. All rights reserved.
        </footer>
    </main>

    <script>
        function toggleSubmenu(element) {
            const group = element.parentElement;
            group.classList.toggle('open');
        }
    </script>
</body>

</html>