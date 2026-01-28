@extends('layouts.myapp')

@section('title', 'Chỉnh sửa Nhà xuất bản - ABC Book')

@section('content')
<div class="category-form-container">
    
    {{-- Header --}}
    <div class="form-header">
        <div class="header-info">
            <h2><i class="fa-solid fa-pen-to-square"></i> Chỉnh sửa Nhà xuất bản</h2>
            <p>Cập nhật lại thông tin định danh hoặc liên hệ của đối tác</p>
        </div>
        <a href="{{ route('publishers.index') }}" class="btn-back">
            <i class="fa-solid fa-arrow-left"></i> Quay lại danh sách
        </a>
    </div>

    {{-- Thông báo lỗi từ Controller --}}
    @if(session('error'))
        <div class="alert alert-danger">
            <i class="fa-solid fa-circle-xmark"></i> {{ session('error') }}
        </div>
    @endif

    {{-- Form --}}
    <div class="form-card">
        <form action="{{ route('publishers.update', $publisher->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Tên Nhà xuất bản --}}
            <div class="form-group">
                <label for="name"><i class="fa-solid fa-building"></i> Tên nhà xuất bản <span class="required">*</span></label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name', $publisher->name) }}"
                    placeholder="Nhập tên chính thức của NXB..."
                    class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                    required
                >
                @error('name')
                    <small class="error-feedback">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-grid">
                {{-- Điện thoại --}}
                <div class="form-group">
                    <label for="phone"><i class="fa-solid fa-phone"></i> Số điện thoại</label>
                    <input
                        type="text"
                        name="phone"
                        id="phone"
                        value="{{ old('phone', $publisher->phone) }}"
                        placeholder="Số điện thoại liên hệ"
                        class="form-control"
                    >
                </div>

                {{-- Email --}}
                <div class="form-group">
                    <label for="email"><i class="fa-solid fa-envelope"></i> Email</label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        value="{{ old('email', $publisher->email) }}"
                        placeholder="địa_chỉ_email@domain.com"
                        class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                    >
                    @error('email')
                        <small class="error-feedback">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- Địa chỉ --}}
            <div class="form-group">
                <label for="address"><i class="fa-solid fa-location-dot"></i> Địa chỉ trụ sở</label>
                <input
                    type="text"
                    name="address"
                    id="address"
                    value="{{ old('address', $publisher->address) }}"
                    placeholder="Số nhà, tên đường, quận/huyện, thành phố..."
                    class="form-control"
                >
            </div>

            {{-- Nút hành động --}}
            <div class="form-actions">
                <a href="{{ route('publishers.index') }}" class="btn-reset" style="text-decoration: none; text-align: center; line-height: 1.5;">
                    <i class="fa-solid fa-xmark"></i> Hủy bỏ
                </a>
                <button type="submit" class="btn-submit">
                    <i class="fa-solid fa-arrows-rotate"></i> Cập nhật ngay
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Tận dụng lại CSS từ trang Create --}}
<style>
    .category-form-container { max-width: 850px; margin: 0 auto; padding: 20px; animation: slideIn 0.4s ease-out; }
    .form-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
    .header-info h2 { color: #2e7d32; margin: 0; font-size: 24px; }
    .header-info p { color: #666; margin-top: 5px; font-size: 14px; }
    .btn-back { text-decoration: none; color: #666; font-size: 14px; transition: 0.2s; }
    .btn-back:hover { color: #2e7d32; }
    .form-card { background: #fff; padding: 35px; border-radius: 12px; box-shadow: 0 8px 25px rgba(0,0,0,0.06); }
    .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 25px; }
    .form-group { margin-bottom: 22px; }
    .form-group label { display: block; font-weight: 600; margin-bottom: 8px; color: #444; font-size: 14px; }
    .required { color: #d32f2f; }
    .form-control { width: 100%; padding: 12px 15px; border: 1px solid #e0e0e0; border-radius: 8px; font-size: 14px; transition: 0.3s; box-sizing: border-box; }
    .form-control:focus { border-color: #2e7d32; box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.1); outline: none; }
    .is-invalid { border-color: #d32f2f; background-color: #fff8f8; }
    .error-feedback { color: #d32f2f; font-size: 12px; margin-top: 5px; display: block; }
    .form-actions { display: flex; justify-content: flex-end; gap: 15px; margin-top: 30px; padding-top: 25px; border-top: 1px solid #f0f0f0; }
    .btn-submit { background: #2e7d32; color: white; border: none; padding: 12px 35px; border-radius: 8px; font-weight: 600; cursor: pointer; transition: 0.3s; box-shadow: 0 4px 12px rgba(46, 125, 50, 0.2); }
    .btn-submit:hover { background: #1b5e20; transform: translateY(-2px); }
    .btn-reset { background: #f8f9fa; color: #666; border: 1px solid #ddd; padding: 12px 25px; border-radius: 8px; cursor: pointer; }
    .alert-danger { background: #ffebee; color: #c62828; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #ffcdd2; }
    @keyframes slideIn { from { opacity: 0; transform: translateY(15px); } to { opacity: 1; transform: translateY(0); } }
</style>
@endsection