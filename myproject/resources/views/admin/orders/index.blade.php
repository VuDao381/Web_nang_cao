@extends('admin.dashboard')

@section('title', 'Danh sách đơn hàng')

@section('admin_content')
    <div class="container-fluid">
        <h2 style="margin-bottom: 20px; color: #1a3020;">📦 Quản lý đơn hàng</h2>

        <div class="card"
            style="background: white; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); overflow: hidden;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #f1f8f1; text-align: left; border-bottom: 2px solid #e0eee0;">
                        <th style="padding: 15px; color: #2e7d32;">ID</th>
                        <th style="padding: 15px; color: #2e7d32;">Khách hàng</th>
                        <th style="padding: 15px; color: #2e7d32;">Ngày đặt</th>
                        <th style="padding: 15px; color: #2e7d32;">Tổng tiền</th>
                        <th style="padding: 15px; color: #2e7d32;">Trạng thái</th>
                        <th style="padding: 15px; color: #2e7d32;">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr style="border-bottom: 1px solid #eee;">
                            <td style="padding: 15px;">#{{ $order->id }}</td>
                            <td style="padding: 15px;">
                                <div>{{ $order->user->name ?? 'N/A' }}</div>
                                <div style="font-size: 12px; color: #888;">{{ $order->phone }}</div>
                            </td>
                            <td style="padding: 15px;">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td style="padding: 15px; font-weight: bold; color: #d32f2f;">
                                {{ number_format($order->total_price, 0, ',', '.') }}đ
                            </td>
                            <td style="padding: 15px;">
                                @php
                                    $statusColors = [
                                        'pending' => '#ff9800',
                                        'confirmed' => '#2196f3',
                                        'shipping' => '#03a9f4',
                                        'completed' => '#4caf50',
                                        'cancelled' => '#f44336',
                                    ];
                                    $statusLabels = [
                                        'pending' => 'Chờ xử lý',
                                        'confirmed' => 'Đã xác nhận',
                                        'shipping' => 'Đang giao',
                                        'completed' => 'Hoàn thành',
                                        'cancelled' => 'Đã hủy',
                                    ];
                                @endphp
                                <span style="
                                            background: {{ $statusColors[$order->status] ?? '#999' }};
                                            color: white;
                                            padding: 5px 10px;
                                            border-radius: 15px;
                                            font-size: 12px;
                                            font-weight: bold;
                                        ">
                                    {{ $statusLabels[$order->status] ?? $order->status }}
                                </span>
                            </td>
                            <td style="padding: 15px;">
                                <a href="{{ route('orders.show', $order->id) }}" style="
                                               background: #e8f5e9;
                                               color: #2e7d32;
                                               padding: 8px 12px;
                                               border-radius: 4px;
                                               text-decoration: none;
                                               font-size: 13px;
                                               font-weight: bold;
                                               border: 1px solid #c8e6c9;
                                           ">
                                    <i class="fa-solid fa-eye"></i> Xem
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="padding: 30px; text-align: center; color: #888;">
                                Không có đơn hàng nào.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div style="padding: 20px;">
                {{ $orders->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection