@extends('layouts.myapp')

@section('title', 'Thêm người dùng')

@section('content')
<div class="publisher-container">

    {{-- Header --}}
    <div class="publisher-header">
        <h2>➕ Thêm người dùng mới</h2>
        <a href="{{ route('users.index') }}" class="publisher-back-btn">
            ← Quay lại
        </a>
    </div>

    {{-- Validation errors --}}
    @if ($errors->any())
        <div class="alert alert-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form --}}
    <form
        action="{{ route('users.store') }}"
        method="POST"
        class="publisher-form"
    >
        @csrf

        {{-- Name --}}
        <div class="form-group">
            <label>Họ tên</label>
            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
                required
            >
        </div>

        {{-- Email --}}
        <div class="form-group">
            <label>Email</label>
            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
            >
        </div>

        {{-- Password --}}
        <div class="form-group">
            <label>Mật khẩu</label>
            <input
                type="password"
                name="password"
                required
            >
        </div>

        {{-- Confirm password --}}
        <div class="form-group">
            <label>Nhập lại mật khẩu</label>
            <input
                type="password"
                name="password_confirmation"
                required
            >
        </div>

        {{-- Phone --}}
        <div class="form-group">
            <label>Số điện thoại</label>
            <input
                type="text"
                name="phone"
                value="{{ old('phone') }}"
            >
        </div>

        {{-- Address --}}
        <div class="form-group">
            <label>Địa chỉ</label>
            <textarea
                name="address"
                rows="3"
            >{{ old('address') }}</textarea>
        </div>

        {{-- Role --}}
        <div class="form-group">
            <label>Quyền</label>
            <select name="role">
                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>
                    User
                </option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>
                    Admin
                </option>
            </select>
        </div>

        {{-- Status --}}
        <div class="form-group">
            <label>Trạng thái</label>
            <select name="is_active">
                <option value="1" {{ old('is_active', 1) == 1 ? 'selected' : '' }}>
                    Hoạt động
                </option>
                <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>
                    Bị khóa
                </option>
            </select>
        </div>

        {{-- Actions --}}
        <div class="publisher-form-actions">
            <button type="submit" class="publisher-submit">
                💾 Lưu
            </button>
            <a href="{{ route('users.index') }}" class="publisher-cancel">
                Hủy
            </a>
        </div>

    </form>
</div>
@endsection
