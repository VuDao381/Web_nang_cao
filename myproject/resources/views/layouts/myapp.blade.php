<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/books.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>@yield('title', 'ABC Book Admin')</title>
    <style>
        :root {
            --sidebar-width: 260px;
            --sidebar-bg: #1a3020; /* Xanh lá đậm cực tối */
            --header-height: 70px;
            --primary-green: #2e7d32; /* Xanh lá chủ đạo */
            --light-green: #e8f5e9;   /* Xanh lá cực nhạt */
            --active-item-bg: #388e3c; /* Màu item active */
        }

        body {
            margin: 0;
            display: flex;
            background-color: #f4fbf4;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* --- SIDEBAR --- */
        .sidebar {
            width: var(--sidebar-width);
            background: var(--sidebar-bg);
            height: 100vh;
            position: fixed;
            color: #dceddc;
            transition: all 0.3s;
            overflow-y: auto;
            z-index: 1000;
            box-shadow: 4px 0 10px rgba(0,0,0,0.1);
        }

        .sidebar-header {
            padding: 20px;
            text-align: center;
            background: var(--primary-green);
            color: #fff;
            font-size: 20px;
            font-weight: bold;
            letter-spacing: 1px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .menu-label {
            padding: 20px 25px 10px;
            font-size: 11px;
            text-transform: uppercase;
            font-weight: bold;
            color: #6a8e6a;
            letter-spacing: 1px;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 12px 25px;
            color: #dceddc;
            text-decoration: none;
            transition: 0.3s;
            cursor: pointer;
            justify-content: space-between;
        }

        .menu-item:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.05);
        }

        .menu-item.active {
            color: #fff;
            background: var(--active-item-bg);
            border-left: 4px solid #a5d6a7;
        }

        .menu-content { display: flex; align-items: center; }
        .menu-item i:first-child { margin-right: 15px; width: 20px; text-align: center; }
        .arrow { font-size: 10px; transition: transform 0.3s; }

        /* --- SUBMENU --- */
        .submenu {
            max-height: 0;
            overflow: hidden;
            background: rgba(0, 0, 0, 0.2);
            transition: max-height 0.3s ease-out;
        }

        .submenu a {
            display: block;
            padding: 10px 10px 10px 60px;
            color: #b9cfb9;
            text-decoration: none;
            font-size: 14px;
            transition: 0.3s;
        }

        .submenu a:hover { color: #fff; padding-left: 65px; }
        .menu-group.open .submenu { max-height: 500px; }
        .menu-group.open .arrow { transform: rotate(90deg); }

        /* --- MAIN CONTENT --- */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            width: calc(100% - var(--sidebar-width));
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            height: var(--header-height);
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .search-area {
            display: flex;
            align-items: center;
            background: #f1f8f1;
            border-radius: 20px;
            padding: 5px 15px;
            width: 380px;
            border: 1px solid #e0eee0;
        }

        .search-area input { border: none; background: transparent; outline: none; padding: 5px 10px; width: 100%; font-size: 14px; }
        .user-profile { display: flex; align-items: center; cursor: pointer; }
        .container { padding: 30px; flex: 1; }
        footer { padding: 15px; text-align: center; background: #fff; font-size: 13px; color: #666; border-top: 1px solid #eee; }
    </style>
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
                    <a href="{{ route('books.index') }}" style="{{ Request::is('books') ? 'color:#fff; font-weight:bold;' : '' }}">
                        <i class="fa-solid fa-list-ul" style="font-size: 11px; margin-right: 8px;"></i> Danh sách sách
                    </a>
                    <a href="{{ route('books.create') }}" style="{{ Request::is('books/create') ? 'color:#fff; font-weight:bold;' : '' }}">
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
                    <a href="{{ route('categories.create') }}" style="{{ Request::is('categories/create') ? 'color:#fff; font-weight:bold;' : '' }}">
                        <i class="fa-solid fa-tags" style="font-size: 11px; margin-right: 8px;"></i> Thể loại sách
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
                    <a href="{{ route('publishers.index') }}" style="{{ Request::is('publishers*') ? 'color:#fff; font-weight:bold;' : '' }}">
                        <i class="fa-solid fa-list-check" style="font-size: 11px; margin-right: 8px;"></i> Danh sách NXB
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
                <a href="{{ route('logout') }}" class="menu-item" onclick="event.preventDefault(); this.closest('form').submit();">
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
                <form action="{{ route('books.index') }}" method="GET" style="display: flex; width: 100%; align-items:center;">
                    <button type="submit" style="border:none; background:none; cursor:pointer; padding: 0 5px;">
                        <i class="fa-solid fa-magnifying-glass" style="color:#2e7d32"></i>
                    </button>
                    <input type="text" name="search" placeholder="Tìm kiếm sách, tác giả..." value="{{ request('search') }}">
                </form>
            </div>
            
            <div class="user-profile">
                <span style="margin-right: 12px; font-size: 14px;">Chào, <strong>{{ Auth::user()->name ?? 'Admin' }}</strong></span>
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name ?? 'Admin' }}&background=2e7d32&color=fff" width="38" style="border-radius: 50%; border: 2px solid #e8f5e9;">
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