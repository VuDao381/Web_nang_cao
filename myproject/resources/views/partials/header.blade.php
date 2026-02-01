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
                <a href="{{ route('profile.edit') }}"
                    style="display: inline-flex; align-items: center; gap: 8px; text-decoration: none;">
                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=2e7d32&color=fff"
                        style="width: 24px; height: 24px; border-radius: 50%; border: 1px solid #fff;">
                    <span>{{ Auth::user()->name }}</span>
                </a>
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
        @php
            // Lấy thông báo chưa đọc (Logic đơn giản cho view, chuẩn hơn nên dùng ViewComposer)
            $notifications = collect();
            $unreadCount = 0;
            if (Auth::check()) {
                $notifications = \App\Models\SystemNotification::where('user_id', Auth::id())
                    ->latest()->take(5)->get();
                $unreadCount = \App\Models\SystemNotification::where('user_id', Auth::id())
                    ->where('is_read', false)->count();
            }
        @endphp


        <div class="notification-wrapper" style="position: relative; margin-right: 15px;">
            <a href="javascript:void(0)" class="notification-btn" id="user-notif-btn" onclick="markUserRead()"
                style="color: #333; font-size: 18px; text-decoration: none;">
                <i class="fa-solid fa-bell"></i>
                @if($unreadCount > 0)
                    <span id="user-notif-badge"
                        style="position: absolute; top: -5px; right: -5px; background: red; color: white; border-radius: 50%; padding: 2px 5px; font-size: 10px;">{{ $unreadCount }}</span>
                @endif
            </a>

            <div class="notification-dropdown" id="user-notif-dropdown">
                <div style="padding: 10px; border-bottom: 1px solid #eee; font-weight: bold;">Thông báo</div>
                @forelse($notifications as $notif)
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
            function markUserRead() {
                // 1. Toggle dropdown
                const dropdown = document.getElementById('user-notif-dropdown');
                if (dropdown.style.display === 'block') {
                    dropdown.style.display = 'none';
                    return; // Nếu đang mở thì đóng lại, ko gọi API nữa (hoặc tùy logic)
                } else {
                    dropdown.style.display = 'block';
                }

                // 2. Ẩn badge
                const badge = document.getElementById('user-notif-badge');
                if (badge) badge.style.display = 'none';

                // 3. Gửi request báo đã đọc
                fetch('{{ route("notifications.markRead") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({})
                });
            }

            // Đóng dropdown khi click ra ngoài
            window.addEventListener('click', function (e) {
                if (!document.getElementById('user-notif-btn').contains(e.target) &&
                    !document.getElementById('user-notif-dropdown').contains(e.target)) {
                    document.getElementById('user-notif-dropdown').style.display = 'none';
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
        <a href="{{ route('cart.index') }}" class="cart-btn">
            <i class="fa-solid fa-cart-shopping"></i>
            <span class="cart-count">
                @auth
                    {{ Auth::user()->cart ? Auth::user()->cart->items->sum('quantity') : 0 }}
                @else
                    0
                @endauth
            </span>
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