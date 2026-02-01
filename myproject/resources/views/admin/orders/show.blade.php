@extends('admin.dashboard')

@section('title', 'Chi tiết đơn hàng #' . $order->id)

@section('admin_content')
    <div class="container-fluid">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
            <h2 style="color: #1a3020; margin: 0;">🧾 Đơn hàng #{{ $order->id }}</h2>
            <a href="{{ route('orders.index') }}" style="text-decoration: none; color: #666;">
                <i class="fa-solid fa-arrow-left"></i> Quay lại danh sách
            </a>
        </div>

        @if(session('success'))
            <div
                style="background: #e8f5e9; color: #2e7d32; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #c8e6c9;">
                {{ session('success') }}
            </div>
        @endif

        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px;">

            {{-- Cột trái: Thông tin sản phẩm --}}
            <div class="card"
                style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
                <h3 style="margin-top: 0; color: #2e7d32; border-bottom: 1px solid #eee; padding-bottom: 10px;">
                    Sản phẩm
                </h3>

                <table style="width: 100%; border-collapse: collapse; margin-top: 15px;">
                    <thead>
                        <tr style="text-align: left; color: #666; font-size: 13px; border-bottom: 1px solid #eee;">
                            <th style="padding: 10px 0;">Sách</th>
                            <th style="padding: 10px 0;">Đơn giá</th>
                            <th style="padding: 10px 0;">Số lượng</th>
                            <th style="padding: 10px 0; text-align: right;">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                            <tr style="border-bottom: 1px solid #eee;">
                                <td style="padding: 15px 0;">
                                    <div style="font-weight: bold;">{{ $item->book->title ?? 'Sách đã bị xóa' }}</div>
                                    <div style="font-size: 12px; color: #888;">{{ $item->book->author ?? '' }}</div>
                                </td>
                                <td style="padding: 15px 0;">{{ number_format($item->price, 0, ',', '.') }}đ</td>
                                <td style="padding: 15px 0;">x{{ $item->quantity }}</td>
                                <td style="padding: 15px 0; text-align: right; font-weight: bold;">
                                    {{ number_format($item->price * $item->quantity, 0, ',', '.') }}đ
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" style="padding: 20px 0; text-align: right; font-weight: bold;">Tổng cộng:</td>
                            <td
                                style="padding: 20px 0; text-align: right; font-weight: bold; color: #d32f2f; font-size: 18px;">
                                {{ number_format($order->total_price, 0, ',', '.') }}đ
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            {{-- Cột phải: Thông tin khách hàng & Trạng thái --}}
            <div>
                {{-- Thông tin khách hàng --}}
                <div class="card"
                    style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); margin-bottom: 20px;">
                    <h3 style="margin-top: 0; color: #2e7d32; border-bottom: 1px solid #eee; padding-bottom: 10px;">
                        Thông tin khách hàng
                    </h3>
                    <p><b>Họ tên:</b> {{ $order->user->name ?? 'N/A' }}</p>
                    <p><b>Số điện thoại:</b> {{ $order->phone }}</p>
                    <p><b>Địa chỉ:</b> {{ $order->address }}</p>
                    <p><b>Ngày đặt:</b> {{ $order->created_at->format('d/m/Y H:i:s') }}</p>
                </div>

                {{-- Cập nhật trạng thái --}}
                <div class="card"
                    style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
                    <h3 style="margin-top: 0; color: #2e7d32; border-bottom: 1px solid #eee; padding-bottom: 10px;">
                        Trạng thái đơn hàng
                    </h3>

                    <form action="{{ route('orders.update', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div style="margin-bottom: 15px;">
                            <select name="status"
                                style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ddd;">
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

                        <button type="submit"
                            style="width: 100%; background: #2e7d32; color: white; padding: 12px; border: none; border-radius: 6px; font-weight: bold; cursor: pointer; transition: 0.3s;">
                            Cập nhật trạng thái
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection