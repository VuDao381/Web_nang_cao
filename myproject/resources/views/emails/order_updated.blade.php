<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .header {
            background: #2e7d32;
            color: #fff;
            padding: 15px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }

        .content {
            padding: 20px;
        }

        .footer {
            font-size: 12px;
            color: #777;
            text-align: center;
            margin-top: 20px;
        }

        .status-badge {
            display: inline-block;
            padding: 5px 10px;
            background: #e8f5e9;
            color: #2e7d32;
            border-radius: 4px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Cập nhật trạng thái đơn hàng</h2>
        </div>
        <div class="content">
            <p>Xin chào <strong>{{ $order->user->name }}</strong>,</p>
            <p>Đơn hàng <strong>#{{ $order->id }}</strong> của bạn vừa được cập nhật trạng thái:</p>

            <p style="text-align: center; margin: 20px 0;">
                <span class="status-badge" style="font-size: 18px;">
                    @if($order->status == 'confirmed') Đã xác nhận
                    @elseif($order->status == 'shipping') Đang giao hàng
                    @elseif($order->status == 'completed') Giao hàng thành công
                    @elseif($order->status == 'cancelled') Đã bị hủy
                    @else {{ $order->status }}
                    @endif
                </span>
            </p>

            <p>Tổng giá trị đơn hàng: <strong>{{ number_format($order->total_price, 0, ',', '.') }}đ</strong></p>

            <p>Cảm ơn bạn đã mua sắm tại ABC Book!</p>
        </div>
        <div class="footer">
            &copy; 2026 ABC Book. All rights reserved.
        </div>
    </div>
</body>

</html>