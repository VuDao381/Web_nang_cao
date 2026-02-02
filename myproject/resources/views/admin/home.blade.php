@extends('admin.dashboard')

@section('title', 'Admin Dashboard')

@section('admin_content')
    <div class="dashboard-home">
        <h2 style="margin-bottom: 20px; color: #333;">Tổng quan</h2>

        @if(isset($pendingOrders) && $pendingOrders > 0)
            <div
                style="background: #e3f2fd; border-left: 5px solid #2196f3; padding: 15px; margin-bottom: 25px; border-radius: 4px; display: flex; align-items: center; justify-content: space-between;">
                <div style="display: flex; align-items: center;">
                    <i class="fa-solid fa-bell" style="color: #2196f3; font-size: 24px; margin-right: 15px;"></i>
                    <div>
                        <div style="font-weight: bold; color: #0d47a1; font-size: 16px;">Bạn có {{ $pendingOrders }} đơn hàng
                            mới chờ duyệt!</div>
                        <div style="font-size: 13px; color: #555;">Hãy kiểm tra và xử lý sớm nhất có thể.</div>
                    </div>
                </div>
                <a href="{{ route('admin.orders.index') }}"
                    style="background: #2196f3; color: white; padding: 8px 15px; border-radius: 4px; text-decoration: none; font-weight: bold; font-size: 13px;">
                    Xem đơn hàng <i class="fa-solid fa-arrow-right" style="margin-left: 5px;"></i>
                </a>
            </div>
        @endif

        <div class="stats-grid">
            {{-- Thẻ Books --}}
            <div class="stat-card">
                <div class="stat-icon" style="background: #e8f5e9; color: #2e7d32;">
                    <i class="fa-solid fa-book"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $bookCount }}</h3>
                    <p>Sách</p>
                </div>
            </div>

            {{-- Thẻ Categories --}}
            <div class="stat-card">
                <div class="stat-icon" style="background: #e3f2fd; color: #1565c0;">
                    <i class="fa-solid fa-layer-group"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $categoryCount }}</h3>
                    <p>Thể loại</p>
                </div>
            </div>

            {{-- Thẻ Publishers --}}
            <div class="stat-card">
                <div class="stat-icon" style="background: #fff3e0; color: #ef6c00;">
                    <i class="fa-solid fa-print"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $publisherCount }}</h3>
                    <p>Nhà xuất bản</p>
                </div>
            </div>

            {{-- Thẻ Revenue --}}
            <div class="stat-card">
                <div class="stat-icon" style="background: #fce4ec; color: #c2185b;">
                    <i class="fa-solid fa-coins"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ number_format($revenue, 0, ',', '.') }}đ</h3>
                    <p>Doanh thu</p>
                </div>
            </div>
        </div>

        <div class="welcome-banner"
            style="margin-top: 30px; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
            <h3>Chào mừng trở lại, {{ Auth::user()->name ?? 'Admin' }}!</h3>
            <p style="color: #666; margin-top: 10px;">
                Hệ thống đang hoạt động ổn định. Bạn có thể quản lý sách, danh mục và người dùng từ thanh bên trái.
            </p>
        </div>
    </div>

    <style>
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            transition: transform 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-right: 20px;
        }

        .stat-info h3 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        .stat-info p {
            margin: 5px 0 0;
            color: #888;
            font-size: 14px;
        }
    </style>
@endsection