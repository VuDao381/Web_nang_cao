@extends('layouts.myapp')

@section('title', 'Thêm nhà xuất bản')

@section('content')
<div class="edit-book-container">
    <h2>➕ Thêm nhà xuất bản</h2>

    <form
        action="{{ route('publishers.store') }}"
        method="POST"
        class="edit-book-form"
    >
        @csrf

        <div class="form-group">
            <label for="name">Tên nhà xuất bản</label>
            <input
                type="text"
                name="name"
                id="name"
                value="{{ old('name') }}"
                required
            >
            @error('name')
                <small class="error-text">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="address">Địa chỉ</label>
            <input
                type="text"
                name="address"
                id="address"
                value="{{ old('address') }}"
            >
        </div>

        <div class="form-group">
            <label for="phone">Điện thoại</label>
            <input
                type="text"
                name="phone"
                id="phone"
                value="{{ old('phone') }}"
            >
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input
                type="email"
                name="email"
                id="email"
                value="{{ old('email') }}"
            >
            @error('email')
                <small class="error-text">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-save">Lưu</button>
            <a href="{{ route('publishers.index') }}" class="btn-cancel">Hủy</a>
        </div>
    </form>
</div>
@endsection
