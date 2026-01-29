@extends('admin.dashboard')

@section('title', 'Sửa thể loại')

@section('admin_content')
<div class="edit-book-container">
    <h2>✏️ Sửa thể loại</h2>

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

    <form
        action="{{ route('categories.update', $category->id) }}"
        method="POST"
        class="edit-book-form"
    >
        @csrf
        @method('PUT')

        {{-- Name --}}
        <div class="form-group">
            <label for="name">Tên thể loại</label>
            <input
                type="text"
                name="name"
                id="name"
                value="{{ old('name', $category->name) }}"
                class="{{ $errors->has('name') ? 'input-error' : '' }}"
                required
            >
            @error('name')
                <small class="error-text">{{ $message }}</small>
            @enderror
        </div>

        {{-- Slug --}}
        <div class="form-group">
            <label for="slug">Slug</label>
            <input
                type="text"
                name="slug"
                id="slug"
                value="{{ old('slug', $category->slug) }}"
                placeholder="Tự động nếu để trống"
                class="{{ $errors->has('slug') ? 'input-error' : '' }}"
            >
            @error('slug')
                <small class="error-text">{{ $message }}</small>
            @enderror
        </div>

        {{-- Description --}}
        <div class="form-group">
            <label for="description">Mô tả</label>
            <textarea
                name="description"
                id="description"
            >{{ old('description', $category->description) }}</textarea>
        </div>

        {{-- Status --}}
        <div class="form-group checkbox-group">
            <label>
                <input
                    type="checkbox"
                    name="is_active"
                    value="1"
                    {{ old('is_active', $category->is_active) ? 'checked' : '' }}
                >
                Kích hoạt
            </label>
        </div>

        {{-- Actions --}}
        <div class="form-actions">
            <button type="submit" class="btn-save">Cập nhật</button>
            <a href="{{ route('categories.index') }}" class="btn-cancel">Hủy</a>
        </div>
    </form>
</div>
@endsection
