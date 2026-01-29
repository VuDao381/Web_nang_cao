@extends('layouts.myapp')

@section('title', 'Giỏ hàng của bạn')

@section('styles')
<style>
    .cart-container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .cart-title {
        font-size: 24px;
        color: #2b6d2c;
        margin-bottom: 25px;
        font-weight: 700;
        border-bottom: 2px solid #eee;
        padding-bottom: 10px;
    }

    .cart-table {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        border-radius: 8px;
        overflow: hidden;
    }

    .cart-table th, .cart-table td {
        padding: 15px 20px;
        text-align: left;
    }

    .cart-table th {
        background-color: #2b6d2c;
        color: #fff;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 14px;
    }

    .cart-table td {
        border-bottom: 1px solid #f0f0f0;
        vertical-align: middle;
    }

    .cart-item-info {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .cart-item-img {
        width: 60px;
        height: 80px;
        object-fit: cover;
        border-radius: 4px;
        border: 1px solid #ddd;
    }

    .cart-item-title {
        font-weight: 600;
        color: #333;
        font-size: 15px;
    }

    .qty-input {
        width: 60px;
        padding: 5px 10px;
        text-align: center;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .btn-update {
        background: none;
        border: none;
        color: #3498db;
        cursor: pointer;
        margin-left: 5px;
    }

    .btn-remove {
        color: #e74c3c;
        text-decoration: none;
        font-size: 18px;
        transition: 0.2s;
    }

    .btn-remove:hover {
        color: #c0392b;
    }

    .cart-summary {
        margin-top: 30px;
        background: #fff;
        padding: 25px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        display: flex;
        justify-content: flex-end;
    }

    .summary-box {
        width: 300px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        font-size: 16px;
    }

    .summary-row.total {
        font-weight: 700;
        font-size: 20px;
        color: #2b6d2c;
        border-top: 1px solid #eee;
        padding-top: 15px;
    }

    .btn-checkout {
        display: block;
        width: 100%;
        background: #2b6d2c;
        color: #fff;
        text-align: center;
        padding: 12px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 600;
        margin-top: 20px;
        transition: 0.2s;
    }

    .btn-checkout:hover {
        background: #245b26;
    }

    .empty-cart {
        text-align: center;
        padding: 60px 20px;
        background: #fff;
        border-radius: 8px;
    }

    .empty-cart i {
        font-size: 60px;
        color: #ddd;
        margin-bottom: 20px;
    }

    .empty-cart p {
        font-size: 18px;
        color: #777;
        margin-bottom: 20px;
    }

    .alert {
        padding: 12px 20px;
        margin-bottom: 20px;
        border-radius: 6px;
        background: #d4edda;
        color: #155724;
    }
</style>
@endsection

@section('content')
    @include('partials.header')

    <div class="cart-container">
        <h1 class="cart-title">Giỏ hàng của bạn</h1>

        @if(session('success'))
            <div class="alert">
                <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @if($cart && $cart->items->count() > 0)
            <table class="cart-table">
                <thead>
                    <tr>
                        <th style="width: 40%;">Sản phẩm</th>
                        <th style="width: 15%;">Đơn giá</th>
                        <th style="width: 20%;">Số lượng</th>
                        <th style="width: 15%;">Thành tiền</th>
                        <th style="width: 10%;"></th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach($cart->items as $item)
                        @php 
                            $subtotal = $item->price * $item->quantity;
                            $total += $subtotal;
                        @endphp
                        <tr>
                            <td>
                                <div class="cart-item-info">
                                    <img src="{{ $item->book->image ?: 'https://via.placeholder.com/60x80' }}" alt="{{ $item->book->title }}" class="cart-item-img">
                                    <div>
                                        <div class="cart-item-title">{{ $item->book->title }}</div>
                                        <small style="color: #777;">{{ $item->book->category->name ?? 'N/A' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ number_format($item->price, 0, ',', '.') }} đ</td>
                            <td>
                                <form action="{{ route('cart.update') }}" method="POST" style="display: flex; align-items: center;">
                                    @csrf
                                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="qty-input">
                                    <button type="submit" class="btn-update" title="Cập nhật"><i class="fa-solid fa-rotate"></i></button>
                                </form>
                            </td>
                            <td style="font-weight: 600; color: #333;">{{ number_format($subtotal, 0, ',', '.') }} đ</td>
                            <td style="text-align: center;">
                                <a href="{{ route('cart.remove', $item->id) }}" class="btn-remove" onclick="return confirm('Bạn có chắc muốn xóa không?')">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="cart-summary">
                <div class="summary-box">
                    <div class="summary-row">
                        <span>Tạm tính:</span>
                        <span>{{ number_format($total, 0, ',', '.') }} đ</span>
                    </div>
                    <div class="summary-row total">
                        <span>Tổng cộng:</span>
                        <span>{{ number_format($total, 0, ',', '.') }} đ</span>
                    </div>
                    <a href="#" class="btn-checkout" onclick="alert('Chức năng thanh toán đang phát triển!')">Tiến hành thanh toán</a>
                    <a href="{{ route('home') }}" style="display: block; text-align: center; margin-top: 15px; color: #555; text-decoration: none;">
                        <i class="fa-solid fa-arrow-left"></i> Tiếp tục mua sắm
                    </a>
                </div>
            </div>
        @else
            <div class="empty-cart">
                <i class="fa-solid fa-basket-shopping"></i>
                <p>Giỏ hàng của bạn đang trống</p>
                <a href="{{ route('home') }}" class="btn-checkout" style="width: auto; display: inline-block; padding: 12px 30px;">
                    Mua sắm ngay
                </a>
            </div>
        @endif
    </div>

    @include('partials.footer')
@endsection
