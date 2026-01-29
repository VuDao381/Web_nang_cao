@extends('layouts.myapp')

@section('title', config('app.name', 'ABC Book'))

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/books.css') }}">
    <style>
        body {
            background-color: #f9f9f9;
        }

        .main-container {
            display: flex;
            max-width: 1200px;
            margin: 20px auto;
            gap: 30px;
            padding: 0 15px;
        }

        .sidebar-left {
            width: 250px;
            flex-shrink: 0;
            background: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            align-self: flex-start;
        }

        .content-right {
            flex: 1;
        }

        .sidebar-title {
            color: #555;
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 20px;
            text-transform: capitalize;
        }

        .bestseller-item {
            display: flex;
            gap: 12px;
            margin-bottom: 20px;
            align-items: center;
        }

        .bestseller-item img {
            width: 60px;
            height: 80px;
            object-fit: cover;
            border-radius: 4px;
        }

        .bestseller-info h4 {
            font-size: 14px;
            color: #333;
            margin-bottom: 5px;
            line-height: 1.3;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .bestseller-price {
            color: #ff3b2f;
            font-weight: bold;
            font-size: 13px;
        }

        /* Customizing Grid for Welcome Page */
        .books-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }

        .book-card {
            border: 1px solid #eee;
            box-shadow: none;
            transition: 0.2s;
        }

        .book-card:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .book-card img {
            height: 250px;
        }

        .book-info {
            padding: 12px;
            text-align: center;
        }

        .book-info h3 {
            font-size: 15px;
            font-weight: 600;
            margin-bottom: 8px;
            line-height: 20px;
            /* Explicit line height */
            height: 40px;
            /* 2 lines * 20px */
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            text-overflow: ellipsis;
        }

        .book-info p {
            display: none;
            /* Hide author/other details as requested "chỉ cần hiển thị tên và giá tiền" */
        }

        .price {
            color: #ff3b2f;
            font-size: 15px;
        }

        /* Sticky Sidebar */
        .sidebar-left {
            position: sticky;
            top: 20px;
        }
    </style>
@endsection

@section('content')
    @include('partials.header')

    <div class="main-container">
        <!-- Sidebar -->
        <aside class="sidebar-left">
            <div class="sidebar-title">Sách Mới Bán Chạy</div>

            @foreach($books->take(5) as $book)
                <div class="bestseller-item">
                    <a href="{{ route('book.detail', ['slug' => Str::slug($book->title)]) }}">
                        <img src="{{ $book->image ?: 'https://via.placeholder.com/60x80' }}" alt="{{ $book->title }}">
                    </a>
                    <div class="bestseller-info">
                        <h4><a href="{{ route('book.detail', ['slug' => Str::slug($book->title)]) }}"
                                style="text-decoration: none; color: inherit;">{{ $book->title }}</a></h4>
                        <div class="bestseller-price">{{ number_format($book->price, 0, ',', '.') }}đ</div>
                    </div>
                </div>
            @endforeach

        </aside>

        <!-- Book List -->
        <main class="content-right">
            <div class="books-grid">
                @foreach($books as $book)
                    <div class="book-card">
                        <a href="{{ route('book.detail', ['slug' => Str::slug($book->title)]) }}"
                            style="text-decoration: none; color: inherit; display: block;">
                            <img src="{{ $book->image ?: 'https://via.placeholder.com/200x280' }}" alt="{{ $book->title }}">
                            <div class="book-info">
                                <h3>{{ $book->title }}</h3>
                                <div class="price">{{ number_format($book->price, 0, ',', '.') }}đ</div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="pagination-wrapper" style="margin-top: 40px;">
                {{ $books->onEachSide(1)->links('pagination::numbers-only') }}
            </div>
        </main>
    </div>

    @include('partials.footer')
@endsection