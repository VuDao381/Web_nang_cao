@extends('dashboard')

@section('title', 'Thêm sách mới')

@section('content')
    <div class="form-wrapper">
        <h2>Thêm sách mới</h2>

        <form action="{{ route('books.store') }}" method="POST" class="main-form">
            @csrf

            <div class="form-group">
                <label>Tiêu đề</label>
                <input type="text" name="title" required>
            </div>

            <div class="form-group">
                <label>Tác giả</label>
                <input type="text" name="author" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Giá</label>
                    <input type="number" name="price" required>
                </div>

                <div class="form-group">
                    <label>Số lượng</label>
                    <input type="number" name="quantity" required>
                </div>
            </div>

            <div class="form-group">
                <label>Năm phát hành</label>
                <input type="number" name="published_year" min="1000" max="{{ date('Y') }}">
            </div>

            <div class="form-group">
                <label>Mô tả</label>
                <textarea name="description"></textarea>
            </div>

            <div class="form-group">
                <label>Ảnh (URL)</label>
                <input type="text" name="image">
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Thể loại</label>
                    <select name="category_id" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Nhà xuất bản</label>
                    <select name="publisher_id" required>
                        @foreach($publishers as $publisher)
                            <option value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('books.index') }}" class="btn-cancel">Hủy</a>
                <button type="submit" class="btn-save">Thêm sách</button>
            </div>
        </form>
    </div>
@endsection