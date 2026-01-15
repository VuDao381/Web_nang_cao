@extends('layouts.myapp') 

@section('title', 'Books List')

@section('content')
<div class="books-container">
    <div class="books-header">
        <h2>📚 Danh sách sách</h2>
        <a href="{{ route('books.create') }}" class="btn-add">+ Thêm sách mới</a>
    </div>

    <div class="books-grid">
        @foreach($books as $book)
            <div class="book-card">
                <img 
                    src="{{ $book->image ?? 'https://via.placeholder.com/200x280?text=No+Image' }}" 
                    alt="{{ $book->title }}"
                >

                <div class="book-info">
                    <h3>{{ $book->title }}</h3>
                    <p class="author"><b>Tác giả: {{ $book->author }}</b></p>

                    <p class="price">
                        Giá: {{ number_format($book->price, 0, ',', '.') }}đ
                    </p>

                    <p class="meta">
                        <b>Ngày phát hành:</b> {{ $book->published_date ?? 'N/A' }} <br>
                        <b>Số lượng:</b> {{ $book->quantity }}
                    </p>

                    <p class="category">
                        <b>Thể loại:</b> {{ $book->category->name ?? 'Chưa phân loại' }}
                        <br>
                        <b>Nhà xuất bản:</b> {{ $book->publisher->name ?? 'N/A' }}
                    </p>

                    <div class="actions">
                        <a href="{{ route('books.show', $book->id) }}" class="btn-view">Xem</a>
                        <a href="{{ route('books.edit', $book->id) }}" class="btn-edit">Sửa</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
