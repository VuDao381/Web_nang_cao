@extends('layouts.myapp')

@section('title', $book->title . ' - ABC Book')

@section('styles')
    <style>
        body {
            background-color: #f9f9f9;
        }

        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 15px;
        }

        .breadcrumb {
            margin-bottom: 20px;
            font-size: 14px;
        }

        .breadcrumb a {
            text-decoration: none;
            color: #555;
        }

        .breadcrumb span {
            color: #999;
            margin: 0 5px;
        }

        .breadcrumb .current {
            color: #2b6d2c;
            font-weight: 600;
        }

        .book-detail-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            padding: 30px;
            gap: 40px;
        }

        .book-image {
            width: 300px;
            flex-shrink: 0;
            text-align: center;
        }

        .book-image img {
            width: 100%;
            height: auto;
            border-radius: 4px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .book-info {
            flex: 1;
        }

        .book-title {
            font-size: 26px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
            line-height: 1.4;
        }

        .book-meta {
            display: grid;
            grid-template-columns: auto 1fr;
            gap: 10px 40px;
            margin-bottom: 20px;
            font-size: 14px;
            color: #555;
        }

        .meta-label {
            font-weight: 600;
            color: #777;
        }

        .book-price {
            font-size: 28px;
            color: #ff3b2f;
            font-weight: bold;
            margin: 20px 0;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .old-price {
            font-size: 16px;
            color: #999;
            text-decoration: line-through;
            font-weight: normal;
        }

        .btn-buy-now {
            display: inline-block;
            background: #ff3b2f;
            color: #fff;
            padding: 12px 40px;
            border-radius: 4px;
            font-weight: bold;
            font-size: 16px;
            text-decoration: none;
            transition: 0.2s;
            border: none;
            cursor: pointer;
        }

        .btn-buy-now:hover {
            background: #d32f2f;
        }

        .book-desc {
            margin-top: 30px;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }

        .desc-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 15px;
            color: #333;
        }

        .desc-content {
            font-size: 15px;
            line-height: 1.6;
            color: #444;
            text-align: justify;
        }

        /* Icon list */
        .specs-list {
            margin-top: 15px;
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .spec-item {
            background: #f5f5f5;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        @media (max-width: 768px) {
            .book-detail-card {
                flex-direction: column;
                padding: 20px;
            }

            .book-image {
                width: 100%;
                max-width: 250px;
                margin: 0 auto;
            }
        }

        .quantity-selector {
            display: flex;
            align-items: center;
            border: 1px solid #ddd;
            border-radius: 4px;
            height: 44px;
        }

        .quantity-selector button {
            background: #f5f5f5;
            border: none;
            width: 40px;
            height: 100%;
            font-size: 18px;
            cursor: pointer;
            color: #333;
        }

        .quantity-selector button:hover {
            background: #e0e0e0;
        }

        .quantity-selector input {
            width: 50px;
            height: 100%;
            border: none;
            border-left: 1px solid #ddd;
            border-right: 1px solid #ddd;
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            outline: none;
        }

        /* Chrome, Safari, Edge, Opera */
        .quantity-selector input::-webkit-outer-spin-button,
        .quantity-selector input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
@endsection

@section('content')
    @include('partials.header')

    <div class="container">
        <div class="breadcrumb">
            <a href="/">Trang chủ</a> <span>/</span>
            <a href="#">{{ $book->category->name ?? 'Sách' }}</a> <span>/</span>
            <span class="current">{{ $book->title }}</span>
        </div>

        <div class="book-detail-card">
            <div class="book-image">
                <img src="{{ $book->image ?: 'https://via.placeholder.com/300x450' }}" alt="{{ $book->title }}">
            </div>

            <div class="book-info">
                <h1 class="book-title">{{ $book->title }}</h1>

                <div class="book-meta">
                    <span class="meta-label">Tác giả:</span>
                    <span>{{ $book->author }}</span>

                    <span class="meta-label">Thể loại:</span>
                    <span>{{ $book->category->name ?? 'N/A' }}</span>

                    <span class="meta-label">Nhà xuất bản:</span>
                    <span>{{ $book->publisher->name ?? 'N/A' }}</span>

                    <span class="meta-label">Năm xuất bản:</span>
                    <span>{{ $book->published_year ?? 'N/A' }}</span>

                    <span class="meta-label">Số trang:</span>
                    <span>{{ $book->pages ?? 'N/A' }}</span>

                    <span class="meta-label">Số lượng:</span>
                    <span>{{ $book->quantity }}</span>
                </div>

                <div class="specs-list">
                    @if($book->pages)
                        <div class="spec-item"><i class="fa-solid fa-file-lines"></i> {{ $book->pages }} trang</div>
                    @endif
                </div>

                <div class="book-price">
                    {{ number_format($book->price, 0, ',', '.') }}đ
                    {{-- <span class="old-price">150.000đ</span> --}}
                </div>

                <form action="{{ route('cart.add') }}" method="POST" class="actions"
                    style="display: flex; gap: 20px; align-items: center;">
                    @csrf
                    <input type="hidden" name="book_id" value="{{ $book->id }}">

                    <div class="quantity-selector">
                        <button type="button" onclick="changeQty(-1)">-</button>
                        <input type="number" id="qty" name="quantity" value="1" min="1" max="{{ $book->quantity }}"
                            readonly>
                        <button type="button" onclick="changeQty(1)">+</button>
                    </div>

                    <button type="submit" class="btn-buy-now">
                        <i class="fa-solid fa-cart-plus" style="margin-right: 8px"></i> Thêm vào giỏ hàng
                    </button>
                </form>

                @if(session('success'))
                    <div style="margin-top: 10px; color: green; font-weight: bold;">
                        <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
                    </div>
                @endif

                <script>
                    function changeQty(amount) {
                        const input = document.getElementById('qty');
                        let val = parseInt(input.value);
                        let max = parseInt(input.getAttribute('max'));

                        val += amount;

                        if (val < 1) val = 1;
                        if (val > max) val = max;

                        input.value = val;
                    }
                </script>

                <div class="book-desc">
                    <div class="desc-title">Giới thiệu sách</div>
                    <div class="desc-content">
                        @if($book->description)
                            {!! nl2br(e($book->description)) !!}
                        @else
                            <p>Đang cập nhật nội dung cho sách này...</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.footer')
@endsection