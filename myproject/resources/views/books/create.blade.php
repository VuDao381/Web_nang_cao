@extends('layouts.myapp')

@section('title', 'Thêm sách mới - ABC Book')

@section('content')
<div class="form-container" style="background: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); max-width: 900px; margin: 0 auto;">
    
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; border-bottom: 2px solid #e8f5e9; padding-bottom: 15px;">
        <h2 style="color: #2e7d32; margin: 0; display: flex; align-items: center; gap: 10px;">
            <i class="fa-solid fa-folder-plus"></i> Thêm sách mới vào hệ thống
        </h2>
        <a href="{{ route('books.index') }}" style="color: #666; text-decoration: none; font-size: 14px;">
            <i class="fa-solid fa-arrow-left"></i> Quay lại danh sách
        </a>
    </div>

    <form action="{{ route('books.store') }}" method="POST">
        @csrf
        
        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #444;">Tiêu đề sách:</label>
            <input type="text" name="title" class="form-control" placeholder="Ví dụ: Đắc Nhân Tâm" required 
                   style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box;">
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
            <div>
                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #444;">Tác giả:</label>
                <input type="text" name="author" class="form-control" required 
                       style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box;">
            </div>
            <div>
                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #444;">Giá bán ($):</label>
                <input type="number" name="price" class="form-control" required 
                       style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box;">
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
            <div>
                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #444;">Số lượng kho:</label>
                <input type="number" name="quantity" class="form-control" required 
                       style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box;">
            </div>
            <div>
                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #444;">Ngày xuất bản:</label>
                <input type="date" name="published_date" class="form-control" required 
                       style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box;">
            </div>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #444;">Mô tả nội dung:</label>
            <textarea name="description" rows="4" required 
                      style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box; font-family: sans-serif;"></textarea>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #444;">URL Hình ảnh (Image Link):</label>
            <input type="text" name="image" class="form-control" placeholder="https://example.com/image.jpg" required 
                   style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box;">
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 30px;">
            <div>
                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #444;">Thể loại:</label>
                <select name="category_id" required 
                        style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box; background: white;">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #444;">Nhà xuất bản:</label>
                <select name="publisher_id" required 
                        style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box; background: white;">
                    @foreach($publishers as $publisher)
                        <option value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div style="text-align: right;">
            <button type="reset" style="padding: 12px 25px; border: 1px solid #ddd; border-radius: 8px; background: #fff; cursor: pointer; margin-right: 10px;">Làm mới</button>
            <button type="submit" style="padding: 12px 35px; border: none; border-radius: 8px; background: #2e7d32; color: white; font-weight: bold; cursor: pointer; transition: 0.3s;">
                <i class="fa-solid fa-save"></i> Lưu sách
            </button>
        </div>
    </form>
</div>

<style>
    .form-control:focus {
        outline: none;
        border-color: #2e7d32 !important;
        box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.1);
    }
    button[type="submit"]:hover {
        background: #1b5e20 !important;
        box-shadow: 0 4px 12px rgba(46, 125, 50, 0.2);
    }
</style>
@endsection