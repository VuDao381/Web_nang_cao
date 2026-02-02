@extends('layouts.myapp')

@section('title', 'ABC Book Admin')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/books.css') }}">
    <link rel="stylesheet" href="{{ asset('css/category.css') }}">
    <link rel="stylesheet" href="{{ asset('css/publisher.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin-custom.css') }}">
@endsection

@section('content')
    <aside class="sidebar">
        <div class="sidebar-header">
            📚 <span style="color: #a5d6a7">ABC</span> BOOK
        </div>

        <nav class="sidebar-menu">
            <div class="menu-label">Navigation</div>
            <a href="{{ route('admin.dashboard') }}" class="menu-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
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
                    <a href="{{ route('admin.books.index') }}"
                        style="{{ Request::is('admin/books') ? 'color:#fff; font-weight:bold;' : '' }}">
                        <i class="fa-solid fa-list-ul" style="font-size: 11px; margin-right: 8px;"></i> Danh sách sách
                    </a>
                    <a href="{{ route('admin.books.create') }}"
                        style="{{ Request::is('admin/books/create') ? 'color:#fff; font-weight:bold;' : '' }}">
                        <i class="fa-solid fa-plus" style="font-size: 11px; margin-right: 8px;"></i> Thêm sách mới
                    </a>
                </div>
            </div>

            {{-- KHỐI 2: QUẢN LÝ THỂ LOẠI --}}
            <div class="menu-group {{ Request::is('categories*') ? 'open' : '' }}">
                <div class="menu-item {{ Request::is('categories*') ? 'active' : '' }}" onclick="toggleSubmenu(this)">
                    <div class="menu-content">
                        <i class="fa-solid fa-layer-group"></i>
                        <span>Quản lý thể loại</span>
                    </div>
                    <i class="fa-solid fa-chevron-right arrow"></i>
                </div>
                <div class="submenu">
                    <a href="{{ route('admin.categories.index') }}"
                        style="{{ Request::is('admin/categories') ? 'color:#fff; font-weight:bold;' : '' }}">
                        <i class="fa-solid fa-list" style="font-size: 11px; margin-right: 8px;"></i> Danh sách thể loại
                    </a>
                    <a href="{{ route('admin.categories.create') }}"
                        style="{{ Request::is('admin/categories/create') ? 'color:#fff; font-weight:bold;' : '' }}">
                        <i class="fa-solid fa-plus" style="font-size: 11px; margin-right: 8px;"></i> Thêm thể loại
                    </a>
                </div>
            </div>

            {{-- KHỐI 3: QUẢN LÝ NHÀ XUẤT BẢN --}}
            <div class="menu-group {{ Request::is('publishers*') ? 'open' : '' }}">
                <div class="menu-item {{ Request::is('publishers*') ? 'active' : '' }}" onclick="toggleSubmenu(this)">
                    <div class="menu-content">
                        <i class="fa-solid fa-print"></i>
                        <span>Quản lý nhà xuất bản</span>
                    </div>
                    <i class="fa-solid fa-chevron-right arrow"></i>
                </div>
                <div class="submenu">
                    <a href="{{ route('admin.publishers.index') }}"
                        style="{{ Request::is('admin/publishers') ? 'color:#fff; font-weight:bold;' : '' }}">
                        <i class="fa-solid fa-list-check" style="font-size: 11px; margin-right: 8px;"></i> Danh sách NXB
                    </a>
                    <a href="{{ route('admin.publishers.create') }}"
                        style="{{ Request::is('admin/publishers/create') ? 'color:#fff; font-weight:bold;' : '' }}">
                        <i class="fa-solid fa-plus" style="font-size: 11px; margin-right: 8px;"></i> Thêm NXB
                    </a>
                </div>
            </div>

            {{-- KHỐI 5: QUẢN LÝ ĐƠN HÀNG --}}
            <div class="menu-group {{ Request::is('admin/orders*') ? 'open' : '' }}">
                <a href="{{ route('admin.orders.index') }}"
                    class="menu-item {{ Request::is('admin/orders*') ? 'active' : '' }}">
                    <div class="menu-content">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span>Quản lý đơn hàng</span>
                    </div>
                </a>
            </div>

            {{-- KHỐI 4: QUẢN LÝ NGƯỜI DÙNG --}}
            <div class="menu-group {{ Request::is('users*') ? 'open' : '' }}">
                <div class="menu-item {{ Request::is('users*') ? 'active' : '' }}" onclick="toggleSubmenu(this)">
                    <div class="menu-content">
                        <i class="fa-solid fa-users"></i>
                        <span>Quản lý người dùng</span>
                    </div>
                    <i class="fa-solid fa-chevron-right arrow"></i>
                </div>
                <div class="submenu">
                    <a href="{{ route('admin.users.index') }}"
                        style="{{ Request::is('admin/users') ? 'color:#fff; font-weight:bold;' : '' }}">
                        <i class="fa-solid fa-list" style="font-size: 11px; margin-right: 8px;"></i> Danh sách User
                    </a>
                    <a href="{{ route('admin.users.create') }}"
                        style="{{ Request::is('admin/users/create') ? 'color:#fff; font-weight:bold;' : '' }}">
                        <i class="fa-solid fa-user-plus" style="font-size: 11px; margin-right: 8px;"></i> Thêm User mới
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
                <form action="{{ route('admin.books.index') }}" method="GET"
                    style="display: flex; width: 100%; align-items:center;">
                    <button type="submit" style="border:none; background:none; cursor:pointer; padding: 0 5px;">
                        <i class="fa-solid fa-magnifying-glass" style="color:#2e7d32"></i>
                    </button>
                    <input type="text" name="keyword" placeholder="Tìm kiếm..." value="{{ request('keyword') }}">
                </form>
            </div>

            <div style="display: flex; align-items: center; gap: 20px;">
                <!-- User Profile -->
                <div class="user-profile">
                    <span style="margin-right: 12px; font-size: 14px;">Chào,
                        <strong>{{ Auth::user()->name ?? 'Admin' }}</strong></span>
                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name ?? 'Admin' }}&background=2e7d32&color=fff"
                        width="38" style="border-radius: 50%; border: 2px solid #e8f5e9;">
                </div>

                <!-- Notification -->
                @php
                    // Lấy thông báo chưa đọc của Admin
                    $adminNotifs = collect();
                    $unreadAdminCount = 0;
                    if (Auth::check()) {
                        $adminNotifs = \App\Models\SystemNotification::where('user_id', Auth::id())
                            ->latest()->take(5)->get();
                        $unreadAdminCount = \App\Models\SystemNotification::where('user_id', Auth::id())
                            ->where('is_read', false)->count();
                    }
                @endphp
                <div class="notification-wrapper" style="position: relative;">
                    <a href="javascript:void(0)" class="notification-btn" id="admin-notif-btn" onclick="markAdminRead()"
                        style="color: #333; font-size: 20px; text-decoration: none;">
                        <i class="fa-solid fa-bell"></i>
                        @if($unreadAdminCount > 0)
                            <span id="admin-notif-badge"
                                style="position: absolute; top: -5px; right: -5px; background: red; color: white; border-radius: 50%; padding: 2px 5px; font-size: 10px;">{{ $unreadAdminCount }}</span>
                        @endif
                    </a>
                    <div class="notification-dropdown" id="admin-notif-dropdown">
                        <div style="padding: 10px; border-bottom: 1px solid #eee; font-weight: bold; color:#333;">Thông báo
                            Admin</div>
                        @forelse($adminNotifs as $notif)
                            <div
                                style="padding: 10px; border-bottom: 1px solid #eee; font-size: 13px; background: {{ $notif->is_read ? '#fff' : '#f0f8ff' }}">
                                <div style="font-weight: 600; color: #2e7d32;">{{ $notif->title }}</div>
                                <div style="color: #666;">{{ $notif->message }}</div>
                                <small style="color: #999;">{{ $notif->created_at->diffForHumans() }}</small>
                            </div>
                        @empty
                            <div style="padding: 10px; color: #999; text-align: center;">Không có thông báo mới</div>
                        @endforelse
                    </div>
                </div>

                <script>
                    function markAdminRead() {
                        const dropdown = document.getElementById('admin-notif-dropdown');

                        // Toggle Logic
                        if (dropdown.style.display === 'block') {
                            dropdown.style.display = 'none';
                            return;
                        } else {
                            dropdown.style.display = 'block';
                        }

                        const badge = document.getElementById('admin-notif-badge');
                        if (badge) badge.style.display = 'none';

                        fetch('{{ route("notifications.markRead") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({})
                        });
                    }

                    // Click outside to close
                    window.addEventListener('click', function (e) {
                        if (!document.getElementById('admin-notif-btn').contains(e.target) &&
                            !document.getElementById('admin-notif-dropdown').contains(e.target)) {
                            document.getElementById('admin-notif-dropdown').style.display = 'none';
                        }
                    });
                </script>

                <style>
                    /* .notification-wrapper:hover .notification-dropdown {
                                    display: block;
                                } REMOVED HOVER */
                    .notification-dropdown {
                        display: none;
                        position: absolute;
                        top: 100%;
                        right: 0;
                        width: 300px;
                        background: white;
                        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                        border-radius: 8px;
                        z-index: 1000;
                        border: 1px solid #eee;
                    }
                </style>
            </div>
        </header>

        <div class="container">
            @yield('admin_content')
        </div>

        <footer>
            © 2026 <strong>ABC Book Admin</strong>. All rights reserved.
        </footer>
    </main>
@endsection

@section('scripts')
    <script>
        function toggleSubmenu(element) {
            const group = element.parentElement;
            group.classList.toggle('open');
        }
    </script>
@endsection