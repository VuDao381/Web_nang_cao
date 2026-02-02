@extends('admin.dashboard')

@section('title', 'Thêm thể loại mới - ABC Book')

@section('admin_content')
    <div class="edit-book-container">
        <h2>➕ Thêm thể loại</h2>

        {{-- THÔNG BÁO LỖI CHUNG --}}
        @if ($errors->any())
            <div class="alert-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>⚠️ {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.categories.store') }}" method="POST" class="edit-book-form">
            @csrf

            {{-- Name --}}
            <div class="form-group">
                <label for="name">Tên thể loại</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="{{ $errors->has('name') ? 'input-error' : '' }}" required>
                @error('name')
                    <small class="error-text">{{ $message }}</small>
                @enderror
            </div>

            {{-- Slug --}}
            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" name="slug" id="slug" value="{{ old('slug') }}" placeholder="Tự động nếu để trống"
                    class="{{ $errors->has('slug') ? 'input-error' : '' }}">
                @error('slug')
                    <small class="error-text">{{ $message }}</small>
                @enderror
            </div>

            {{-- Description --}}
            <div class="form-group">
                <label for="description">Mô tả</label>
                <textarea name="description" id="description">{{ old('description') }}</textarea>
            </div>

            {{-- Status --}}
            <div class="form-group checkbox-group">
                <label>
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                    Kích hoạt
                </label>
            </div>

            {{-- Actions --}}
            <div class="form-actions">
                <button type="submit" class="btn-save">Lưu</button>
                <a href="{{ route('admin.categories.index') }}" class="btn-cancel">Hủy</a>
            </div>
        </form>
    </div>
@endsection