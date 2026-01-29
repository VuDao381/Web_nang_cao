@extends('layouts.myapp')

@section('title', 'Tài khoản của bạn')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/books.css') }}">
    <style>
        .profile-container {
            max-width: 900px;
            margin: 40px auto;
            display: grid;
            grid-template-columns: 1fr;
            gap: 30px;
        }

        @media(min-width: 768px) {
            .profile-container {
                grid-template-columns: 3fr 2fr;
            }
        }

        .profile-card {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .profile-card h3 {
            margin-bottom: 20px;
            color: #2b6d2c;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 10px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
        }
    </style>
@endsection

@section('content')
    @include('partials.header')

    <div class="profile-container">

        {{-- Form Thông Tin --}}
        <div class="profile-card">
            <h3>Thông tin cá nhân</h3>

            @if (session('status') === 'profile-updated')
                <div class="alert-success">
                    <i class="fa-solid fa-check"></i> Đã cập nhật thông tin thành công!
                </div>
            @endif

            <form action="{{ route('profile.update') }}" method="POST" class="edit-book-form">
                @csrf
                @method('patch')

                <div class="form-group">
                    <label>Họ và tên</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
                    @error('name')
                        <span style="color: red; font-size: 13px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <span style="color: red; font-size: 13px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Số điện thoại</label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                        placeholder="Nhập số điện thoại">
                    @error('phone')
                        <span style="color: red; font-size: 13px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Địa chỉ</label>
                    <textarea name="address" rows="3"
                        placeholder="Nhập địa chỉ nhận hàng">{{ old('address', $user->address) }}</textarea>
                    @error('address')
                        <span style="color: red; font-size: 13px;">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn-save" style="width: 100%; margin-top: 10px;">Lưu thay đổi</button>
            </form>
        </div>

        {{-- Form Đổi Mật Khẩu --}}
        <div class="profile-card">
            <h3>Đổi mật khẩu</h3>

            @if (session('status') === 'password-updated')
                <div class="alert-success">
                    <i class="fa-solid fa-check"></i> Đổi mật khẩu thành công!
                </div>
            @endif

            <form action="{{ route('password.update') }}" method="POST" class="edit-book-form">
                @csrf
                @method('put')

                <div class="form-group">
                    <label>Mật khẩu hiện tại</label>
                    <input type="password" name="current_password" required>
                    @error('current_password', 'updatePassword')
                        <span style="color: red; font-size: 13px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Mật khẩu mới</label>
                    <input type="password" name="password" required>
                    @error('password', 'updatePassword')
                        <span style="color: red; font-size: 13px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Nhập lại mật khẩu mới</label>
                    <input type="password" name="password_confirmation" required>
                </div>

                <button type="submit" class="btn-save" style="background-color: #555; width: 100%; margin-top: 10px;">Đổi
                    mật khẩu</button>
            </form>
        </div>
    </div>

    @include('partials.footer')
@endsection