@extends('admin.dashboard')

@section('title', 'Chi tiết đơn hàng #' . $order->id)

@section('admin_content')
    <div class="container-fluid">
        <div class="header-flex">
            <h2 style="color: #1a3020; margin: 0;">🧾 Đơn hàng #{{ $order->id }}</h2>
            <a href="{{ route('admin.orders.index') }}" class="btn-back-list">
                <i class="fa-solid fa-arrow-left"></i> Quay lại danh sách
            </a>
        </div>

        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="order-detail-grid">

            {{-- Cột trái: Thông tin sản phẩm --}}
            <div class="admin-card">
                <h3 class="section-title">
                    Sản phẩm
                </h3>

                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Sách</th>
                            <th>Đơn giá</th>
                            <th>Số lượng</th>
                            <th style="text-align: right;">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                            <tr>
                                <td>
                                    <div style="font-weight: bold;">{{ $item->book->title ?? 'Sách đã bị xóa' }}</div>
                                    <div style="font-size: 12px; color: #888;">{{ $item->book->author ?? '' }}</div>
                                </td>
                                <td>{{ number_format($item->price, 0, ',', '.') }}đ</td>
                                <td>x{{ $item->quantity }}</td>
                                <td style="text-align: right; font-weight: bold;">
                                    {{ number_format($item->price * $item->quantity, 0, ',', '.') }}đ
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" style="text-align: right; font-weight: bold; padding: 20px 0;">Tổng cộng:</td>
                            <td class="total-price-large" style="text-align: right; padding: 20px 0;">
                                {{ number_format($order->total_price, 0, ',', '.') }}đ
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            {{-- Cột phải: Thông tin khách hàng & Trạng thái --}}
            <div>
                {{-- Thông tin khách hàng --}}
                <div class="admin-card">
                    <h3 class="section-title">
                        Thông tin khách hàng
                    </h3>
                    <p><b>Họ tên:</b> {{ $order->user->name ?? 'N/A' }}</p>
                    <p><b>Số điện thoại:</b> {{ $order->phone }}</p>
                    <p><b>Địa chỉ:</b> {{ $order->address }}</p>
                    <p><b>Ngày đặt:</b> {{ $order->created_at->format('d/m/Y H:i:s') }}</p>
                </div>

                {{-- Cập nhật trạng thái --}}
                <div class="admin-card">
                    <h3 class="section-title">
                        Trạng thái đơn hàng
                    </h3>

                    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div style="margin-bottom: 15px;">
                            <select name="status" class="admin-select">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                                <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>Đã xác nhận
                                </option>
                                <option value="shipping" {{ $order->status == 'shipping' ? 'selected' : '' }}>Đang giao hàng
                                </option>
                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Hoàn thành
                                </option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Đã hủy
                                </option>
                            </select>
                        </div>

                        <button type="submit" class="btn-update">
                            Cập nhật trạng thái
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection