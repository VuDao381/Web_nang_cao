@extends('admin.dashboard')

@section('title', 'Danh sách đơn hàng')

@section('admin_content')
    <div class="container-fluid">
        <h2 class="page-header-title">📦 Quản lý đơn hàng</h2>

        <div class="admin-card">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Khách hàng</th>
                        <th>Ngày đặt</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>
                                <div>{{ $order->user->name ?? 'N/A' }}</div>
                                <div style="font-size: 12px; color: #888;">{{ $order->phone }}</div>
                            </td>
                            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td style="font-weight: bold; color: #d32f2f;">
                                {{ number_format($order->total_price, 0, ',', '.') }}đ
                            </td>
                            <td>
                                @php
                                    $statusLabels = [
                                        'pending' => 'Chờ xử lý',
                                        'confirmed' => 'Đã xác nhận',
                                        'shipping' => 'Đang giao',
                                        'completed' => 'Hoàn thành',
                                        'cancelled' => 'Đã hủy',
                                    ];
                                @endphp
                                <span class="status-badge badge-{{ $order->status }}">
                                    {{ $statusLabels[$order->status] ?? $order->status }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn-view-detail">
                                    <i class="fa-solid fa-eye"></i> Xem
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="empty-row">
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