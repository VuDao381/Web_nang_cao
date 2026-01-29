@extends('admin.dashboard')

@section('title', 'Sửa sách')

@section('admin_content')
    <div class="form-wrapper">
        <h2>✏️ Sửa sách</h2>

        <form action="{{ route('books.update', $books->id) }}" method="POST" class="main-form">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Tiêu đề</label>
                <input type="text" name="title" value="{{ $books->title }}" required>
            </div>

            <div class="form-group">
                <label>Tác giả</label>
                <input type="text" name="author" value="{{ $books->author }}" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Giá</label>
                    <input type="number" name="price" value="{{ $books->price }}" required>
                </div>

                <div class="form-group">
                    <label>Số lượng</label>
                    <input type="number" name="quantity" value="{{ $books->quantity }}" required>
                </div>
            </div>

            {{-- ✅ Năm phát hành --}}
            <div class="form-row">
                <div class="form-group">
                    <label>Năm phát hành</label>
                    <input type="number" name="published_year" min="1000" max="{{ date('Y') }}"
                        value="{{ $books->published_year }}">
                </div>

                {{-- ✅ Số trang --}}
                <div class="form-group">
                    <label>Số trang</label>
                    <input type="number" name="pages" min="1" value="{{ $books->pages }}">
                </div>
            </div>

            <div class="form-group">
                <label>Mô tả</label>
                <textarea name="description">{{ $books->description }}</textarea>
            </div>

            <div class="form-group">
                <label>Ảnh (URL)</label>
                <input type="text" name="image" value="{{ $books->image }}">
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Thể loại</label>
                    <select name="category_id" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $books->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Nhà xuất bản</label>
                    <select name="publisher_id" required>
                        @foreach($publishers as $publisher)
                            <option value="{{ $publisher->id }}" {{ $books->publisher_id == $publisher->id ? 'selected' : '' }}>
                                {{ $publisher->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('books.index') }}" class="btn-cancel">Hủy</a>
                <button type="submit" class="btn-save">Lưu</button>
            </div>
        </form>
    </div>
@endsection