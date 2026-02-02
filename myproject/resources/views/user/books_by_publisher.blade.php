@extends('layouts.myapp')

@section('title', 'Sách của NXB: ' . $publisher->name)

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

        .content-full {
            flex: 1;
        }

        .books-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }

        .book-card {
            border: 1px solid #eee;
            box-shadow: none;
            transition: 0.2s;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
        }

        .book-card:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .book-card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .book-info {
            padding: 15px;
            text-align: center;
        }

        .book-info h3 {
            font-size: 15px;
            font-weight: 600;
            margin-bottom: 8px;
            line-height: 20px;
            height: 40px;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            text-overflow: ellipsis;
            color: #333;
        }

        .price {
            color: #ff3b2f;
            font-size: 16px;
            font-weight: bold;
        }
    </style>
@endsection

@section('content')
    @include('partials.header')

    <div class="main-container">
        <main class="content-full">
            <div style="margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid #2e7d32;">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb" style="display: flex; list-style: none; padding: 0; margin: 0; gap: 10px; font-size: 14px;">
                        <li><a href="/" style="text-decoration: none; color: #666;">Trang chủ</a></li>
                        <li><span style="color: #ccc;">/</span></li>
                        <li style="color: #2e7d32; font-weight: 600;">{{ $publisher->name }}</li>
                    </ol>
                </nav>
                <div style="margin-top: 10px;">
                    <h2 style="font-size: 24px; color: #333; margin-bottom: 5px;">Sách của NXB "{{ $publisher->name }}"</h2>
                    @if($publisher->address || $publisher->email || $publisher->phone)
                        <div style="font-size: 13px; color: #666;">
                            @if($publisher->address) <span style="margin-right: 15px;"><i class="fa-solid fa-location-dot"></i> {{ $publisher->address }}</span> @endif
                            @if($publisher->phone) <span style="margin-right: 15px;"><i class="fa-solid fa-phone"></i> {{ $publisher->phone }}</span> @endif
                            @if($publisher->email) <span><i class="fa-solid fa-envelope"></i> {{ $publisher->email }}</span> @endif
                        </div>
                    @endif
                </div>
            </div>

            @if($books->count() > 0)
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
            @else
                <div class="empty-state" style="text-align: center; padding: 50px 0; color: #777;">
                    <i class="fa-solid fa-book-open" style="font-size: 48px; margin-bottom: 15px; color: #ccc;"></i>
                    <p>Chưa có sách nào của nhà xuất bản này.</p>
                </div>
            @endif
        </main>
    </div>

    @include('partials.footer')
@endsection
