@extends('admin.dashboard')

@section('title', 'Chỉnh sửa Nhà xuất bản - ABC Book')

@section('admin_content')
    <div class="edit-book-container">
        <h2>✏️ Sửa nhà xuất bản</h2>

        <form action="{{ route('publishers.update', $publisher->id) }}" method="POST" class="edit-book-form">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Tên nhà xuất bản</label>
                <input type="text" name="name" id="name" value="{{ old('name', $publisher->name) }}" required>
                @error('name')
                    <small class="error-text">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="address">Địa chỉ</label>
                <input type="text" name="address" id="address" value="{{ old('address', $publisher->address) }}">
            </div>

            <div class="form-group">
                <label for="phone">Điện thoại</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone', $publisher->phone) }}">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $publisher->email) }}">
                @error('email')
                    <small class="error-text">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-save">Cập nhật</button>
                <a href="{{ route('publishers.index') }}" class="btn-cancel">Hủy</a>
            </div>
        </form>
    </div>
@endsection