@extends('admin.dashboard')

@section('title', 'Thêm người dùng')

@section('admin_content')
    <div class="edit-book-container">
        <h2>➕ Thêm người dùng</h2>

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

        <form action="{{ route('users.store') }}" method="POST" class="edit-book-form">
            @csrf

            <div class="form-group">
                <label>Tên</label>
                <input type="text" name="name" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label>Mật khẩu</label>
                <input type="password" name="password" required>
            </div>

            <div class="form-group">
                <label>Xác nhận mật khẩu</label>
                <input type="password" name="password_confirmation" required>
            </div>

            <div class="form-group">
                <label>Vai trò</label>
                <select name="role">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <div class="form-group">
                <label>Số điện thoại</label>
                <input type="text" name="phone" value="{{ old('phone') }}">
            </div>

            <div class="form-group">
                <label>Địa chỉ</label>
                <textarea name="address">{{ old('address') }}</textarea>
            </div>

            <div class="form-group checkbox-group">
                <label>
                    <input type="checkbox" name="is_active" value="1" checked>
                    Kích hoạt
                </label>
            </div>

            <div class="form-actions">
                <button class="btn-save">Lưu</button>
                <a href="{{ route('users.index') }}" class="btn-cancel">Hủy</a>
            </div>
        </form>
    </div>
@endsection