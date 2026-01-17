@extends('layouts.myapp')

@section('title', 'Đăng nhập')

@section('content')
<div class="auth-container">

    <form class="auth-form" method="POST" action="{{ route('login') }}">
        @csrf

        <h2 class="auth-title">🔐 Đăng nhập</h2>

        {{-- Error --}}
        @if ($errors->any())
            <div class="alert alert-error">
                {{ $errors->first() }}
            </div>
        @endif

        {{-- Email --}}
        <div class="form-group">
            <label>Email</label>
            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
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

        {{-- Submit --}}
        <button type="submit" class="auth-submit">
            Đăng nhập
        </button>
    </form>

</div>
@endsection
