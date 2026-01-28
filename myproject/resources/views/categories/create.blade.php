@extends('layouts.myapp')

@section('title', 'Thêm thể loại mới - ABC Book')

@section('content')
<div class="category-form-container">
    
    {{-- Header --}}
    <div class="form-header">
        <div class="header-info">
            <h2><i class="fa-solid fa-folder-plus"></i> Thêm thể loại mới</h2>
            <p>Tạo danh mục mới để phân loại sách trong hệ thống</p>
        </div>
        <a href="{{ route('categories.index') }}" class="btn-back">
            <i class="fa-solid fa-arrow-left"></i> Quay lại
        </a>
    </div>

    {{-- Thông báo lỗi --}}
    @if ($errors->any())
        <div class="alert-error-wrapper">
            <div class="alert-error-title">⚠️ Đã có lỗi xảy ra:</div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form --}}
    <div class="form-card">
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf

            <div class="form-grid">
                {{-- Tên thể loại --}}
                <div class="form-group">
                    <label for="name"><i class="fa-solid fa-tag"></i> Tên thể loại <span class="required">*</span></label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        value="{{ old('name') }}"
                        placeholder="Ví dụ: Văn học nước ngoài, Kinh tế..."
                        class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                        required
                    >
                    @error('name')
                        <small class="error-feedback">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Slug --}}
                <div class="form-group">
                    <label for="slug"><i class="fa-solid fa-link"></i> Slug (Đường dẫn)</label>
                    <input
                        type="text"
                        name="slug"
                        id="slug"
                        value="{{ old('slug') }}"
                        placeholder="Để trống để hệ thống tự tạo"
                        class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}"
                    >
                    <small class="helper-text">Ví dụ: van-hoc-nuoc-ngoai</small>
                </div>
            </div>

            {{-- Mô tả --}}
            <div class="form-group">
                <label for="description"><i class="fa-solid fa-align-left"></i> Mô tả chi tiết</label>
                <textarea
                    name="description"
                    id="description"
                    rows="4"
                    placeholder="Nhập mô tả ngắn về thể loại này..."
                    class="form-control"
                >{{ old('description') }}</textarea>
            </div>

            {{-- Trạng thái --}}
            <div class="form-group status-switch">
                <label class="switch-container">
                    <input
                        type="checkbox"
                        name="is_active"
                        value="1"
                        {{ old('is_active', true) ? 'checked' : '' }}
                    >
                    <span class="slider"></span>
                    <span class="switch-label">Kích hoạt thể loại này ngay lập tức</span>
                </label>
            </div>

            {{-- Nút hành động --}}
            <div class="form-actions">
                <button type="reset" class="btn-reset">
                    <i class="fa-solid fa-rotate-left"></i> Nhập lại
                </button>
                <button type="submit" class="btn-submit">
                    <i class="fa-solid fa-floppy-disk"></i> Lưu thể loại
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    /* Container & Layout */
    .category-form-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        animation: slideUp 0.4s ease-out;
    }

    .form-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .header-info h2 { color: #2e7d32; margin: 0; font-size: 24px; }
    .header-info p { color: #666; margin: 5px 0 0; font-size: 14px; }

    .btn-back {
        text-decoration: none;
        color: #666;
        font-size: 14px;
        transition: 0.3s;
    }
    .btn-back:hover { color: #2e7d32; }

    /* Card Form */
    .form-card {
        background: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 20px;
    }

    /* Input Styling */
    .form-group { margin-bottom: 20px; }
    .form-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 8px;
        color: #444;
        font-size: 14px;
    }
    .required { color: #d32f2f; }

    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.3s;
        box-sizing: border-box;
    }
    .form-control:focus {
        border-color: #2e7d32;
        box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.1);
        outline: none;
    }

    .is-invalid { border-color: #d32f2f; }
    .error-feedback { color: #d32f2f; font-size: 12px; margin-top: 5px; display: block; }
    .helper-text { color: #999; font-size: 12px; margin-top: 5px; display: block; }

    /* Custom Switch (Checkbox) */
    .switch-container {
        display: flex;
        align-items: center;
        cursor: pointer;
        gap: 12px;
    }
    .switch-label { font-size: 14px; color: #555; font-weight: 500; }

    /* Actions Buttons */
    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 15px;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #eee;
    }

    .btn-submit {
        background: #2e7d32;
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.3s;
    }
    .btn-submit:hover { background: #1b5e20; transform: translateY(-2px); }

    .btn-reset {
        background: #f5f5f5;
        color: #666;
        border: 1px solid #ddd;
        padding: 12px 25px;
        border-radius: 8px;
        cursor: pointer;
    }

    /* Error Alert */
    .alert-error-wrapper {
        background: #fff5f5;
        border-left: 4px solid #d32f2f;
        padding: 15px;
        margin-bottom: 25px;
        border-radius: 4px;
    }
    .alert-error-title { color: #d32f2f; font-weight: bold; margin-bottom: 5px; }
    .alert-error-wrapper ul { margin: 0; padding-left: 20px; color: #d32f2f; font-size: 14px; }

    @keyframes slideUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection