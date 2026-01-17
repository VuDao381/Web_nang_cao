@extends('layouts.myapp')

@section('title', 'Chỉnh sửa người dùng')

@section('content')
<div class="publisher-container">

    {{-- Header --}}
    <div class="publisher-header">
        <h2>✏️ Chỉnh sửa người dùng</h2>
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
        action="{{ route('users.update', $user->id) }}"
        method="POST"
        class="publisher-form"
    >
        @csrf
        @method('PUT')

        {{-- Name --}}
        <div class="form-group">
            <label>Họ tên</label>
            <input
                type="text"
                name="name"
                value="{{ old('name', $user->name) }}"
                required
            >
        </div>

        {{-- Email --}}
        <div class="form-group">
            <label>Email</label>
            <input
                type="email"
                name="email"
                value="{{ old('email', $user->email) }}"
                required
            >
        </div>

        {{-- Password --}}
        <div class="form-group">
            <label>Mật khẩu mới (để trống nếu không đổi)</label>
            <input
                type="password"
                name="password"
                placeholder="••••••"
            >
        </div>

        {{-- Confirm password --}}
        <div class="form-group">
            <label>Nhập lại mật khẩu</label>
            <input
                type="password"
                name="password_confirmation"
            >
        </div>

        {{-- Phone --}}
        <div class="form-group">
            <label>Số điện thoại</label>
            <input
                type="text"
                name="phone"
                value="{{ old('phone', $user->phone) }}"
            >
        </div>

        {{-- Address --}}
        <div class="form-group">
            <label>Địa chỉ</label>
            <textarea
                name="address"
                rows="3"
            >{{ old('address', $user->address) }}</textarea>
        </div>

        {{-- Role --}}
        <div class="form-group">
            <label>Quyền</label>
            <select name="role">
                <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>
                    User
                </option>
                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>
                    Admin
                </option>
            </select>
        </div>

        {{-- Status --}}
        <div class="form-group">
            <label>Trạng thái</label>
            <select name="is_active">
                <option value="1" {{ old('is_active', $user->is_active) == 1 ? 'selected' : '' }}>
                    Hoạt động
                </option>
                <option value="0" {{ old('is_active', $user->is_active) == 0 ? 'selected' : '' }}>
                    Bị khóa
                </option>
            </select>
        </div>

        {{-- Actions --}}
        <div class="publisher-form-actions">
            <button type="submit" class="publisher-submit">
                💾 Cập nhật
            </button>
            <a href="{{ route('users.index') }}" class="publisher-cancel">
                Hủy
            </a>
        </div>

    </form>
</div>
@endsection
