@extends('admin.dashboard')

@section('title', 'Sửa người dùng')

@section('admin_content')
    <div class="edit-book-container">
        <h2>✏️ Sửa người dùng</h2>

        {{-- Error --}}
        @if ($errors->any())
            <div class="alert alert-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="edit-book-form">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Tên</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="form-group">
                <label>Mật khẩu mới (nếu đổi)</label>
                <input type="password" name="password">
            </div>

            <div class="form-group">
                <label>Xác nhận mật khẩu</label>
                <input type="password" name="password_confirmation">
            </div>

            <div class="form-group">
                <label>Vai trò</label>
                <select name="role">
                    <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>
                        User
                    </option>
                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>
                        Admin
                    </option>
                </select>
            </div>

            <div class="form-group">
                <label>Số điện thoại</label>
                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}">
            </div>

            <div class="form-group">
                <label>Địa chỉ</label>
                <textarea name="address">{{ old('address', $user->address) }}</textarea>
            </div>

            <div class="form-group checkbox-group">
                <label>
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $user->is_active) ? 'checked' : '' }}>
                    Kích hoạt
                </label>
            </div>

            <div class="form-actions">
                <button class="btn-save">Cập nhật</button>
                <a href="{{ route('admin.users.index') }}" class="btn-cancel">Hủy</a>
            </div>
        </form>
    </div>
@endsection