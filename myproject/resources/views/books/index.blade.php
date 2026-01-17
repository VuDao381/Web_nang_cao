@extends('layouts.myapp')

@section('title', 'Books List')

@section('content')
<div class="books-container">

    {{-- Header --}}
    <div class="books-header">
        <h2>📚 Danh sách sách</h2>
        <a href="{{ route('books.create') }}" class="btn-add">
            + Thêm sách mới
        </a>
    </div>

    {{-- Danh sách sách --}}
    <div class="books-grid">
        @forelse($books as $book)
            <div class="book-card">

                <img
                    src="{{ $book->image ?: 'https://via.placeholder.com/200x280?text=No+Image' }}"
                    alt="{{ $book->title }}"
                >

                <div class="book-info">
                    <h3>{{ $book->title }}</h3>

                    <p><b>Tác giả:</b> {{ $book->author }}</p>

                    <p>
                        <b>Giá:</b>
                        {{ number_format($book->price, 0, ',', '.') }}đ
                    </p>

                    <p>
                        <b>Năm phát hành:</b> {{ $book->published_year ?? 'N/A' }} <br>
                        <b>Số trang:</b> {{ $book->pages ?? 'N/A' }} <br>
                        <b>Số lượng:</b> {{ $book->quantity }}
                    </p>

                    <p>
                        <b>Thể loại:</b>
                        {{ optional($book->category)->name ?? 'Chưa phân loại' }} <br>

                        <b>NXB:</b>
                        {{ optional($book->publisher)->name ?? 'N/A' }}
                    </p>

                    <div class="actions">
                        <a
                            href="{{ route('books.edit', $book->id) }}"
                            class="btn-edit"
                        >
                            Sửa
                        </a>

                        <form
                            action="{{ route('books.destroy', $book->id) }}"
                            method="POST"
                            onsubmit="return confirm('Bạn có chắc chắn muốn xóa sách này không?')"
                        >
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn-delete">
                                Xóa
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p style="text-align:center; width:100%; margin-top:20px">
                📭 Không có sách nào
            </p>
        @endforelse
    </div>

    {{-- Phân trang --}}
    <div class="pagination-wrapper">
        {{ $books->onEachSide(1)->links('pagination::numbers-only') }}
    </div>
</div>
@endsection
