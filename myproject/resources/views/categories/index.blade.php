@extends('layouts.myapp')

@section('title', 'Quản lý thể loại - ABC Book')

@section('content')
<div class="category-container">

    {{-- Header --}}
    <div class="category-header">
        <div class="header-title">
            <h2><i class="fa-solid fa-folder-tree"></i> Danh sách thể loại</h2>
            <p>Quản lý các danh mục sách hiện có trong hệ thống</p>
        </div>

        <a href="{{ route('categories.create') }}" class="category-add-btn">
            <i class="fa-solid fa-plus"></i> Thêm thể loại
        </a>
    </div>

    {{-- Thông báo --}}
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
        </div>
    @endif

    {{-- Table --}}
    <div class="category-table-wrapper">
        <table class="category-table">
            <thead>
                <tr>
                    <th width="80">ID</th>
                    <th>Tên thể loại</th>
                    <th>Slug (Đường dẫn)</th>
                    <th width="150">Trạng thái</th>
                    <th width="180">Hành động</th>
                </tr>
            </thead>

            <tbody>
                @forelse($categories as $category)
                    <tr>
                        <td class="text-bold">#{{ $category->id }}</td>

                        <td><strong>{{ $category->name }}</strong></td>

                        <td><code class="slug-code">{{ $category->slug }}</code></td>

                        <td>
                            @if($category->is_active)
                                <span class="category-status-active">
                                    <i class="fa-solid fa-eye"></i> Hoạt động
                                </span>
                            @else
                                <span class="category-status-inactive">
                                    <i class="fa-solid fa-eye-slash"></i> Đang ẩn
                                </span>
                            @endif
                        </td>

                        <td>
                            <div class="category-actions">
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn-action edit" title="Sửa">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>

                                <form action="{{ route('categories.destroy', $category->id) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Bạn có chắc chắn muốn xóa thể loại này? Các sách thuộc thể loại này có thể bị ảnh hưởng.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action delete" title="Xóa">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="empty-state">
                            <i class="fa-solid fa-inbox"></i>
                            <p>Chưa có thể loại nào được tạo.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="category-pagination">
        {{ $categories->appends(request()->query())->links() }}
    </div>

</div>

<style>
    /* Tổng quan container */
    .category-container {
        padding: 10px;
        animation: fadeIn 0.5s ease-in-out;
    }

    /* Header & Title */
    .category-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }
    .header-title h2 {
        color: #2e7d32;
        margin: 0;
        font-size: 24px;
    }
    .header-title p {
        margin: 5px 0 0;
        color: #666;
        font-size: 14px;
    }

    /* Nút thêm mới */
    .category-add-btn {
        background: #2e7d32;
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        transition: 0.3s;
        box-shadow: 0 4px 10px rgba(46, 125, 50, 0.2);
    }
    .category-add-btn:hover {
        background: #1b5e20;
        transform: translateY(-2px);
    }

    /* Bảng dữ liệu */
    .category-table-wrapper {
        background: white;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        overflow: hidden;
    }
    .category-table {
        width: 100%;
        border-collapse: collapse;
    }
    .category-table th {
        background: #f8faf9;
        color: #2e7d32;
        padding: 15px;
        text-align: left;
        font-size: 13px;
        text-transform: uppercase;
        border-bottom: 2px solid #e8f5e9;
    }
    .category-table td {
        padding: 15px;
        border-bottom: 1px solid #f0f0f0;
        vertical-align: middle;
    }
    .category-table tr:hover {
        background: #fafffa;
    }

    /* Status Labels */
    .category-status-active {
        background: #e8f5e9;
        color: #2e7d32;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }
    .category-status-inactive {
        background: #ffebee;
        color: #c62828;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    /* Buttons Hành động */
    .category-actions {
        display: flex;
        gap: 10px;
    }
    .btn-action {
        width: 35px;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        text-decoration: none;
        transition: 0.2s;
        border: none;
        cursor: pointer;
    }
    .edit { background: #e3f2fd; color: #1976d2; }
    .edit:hover { background: #1976d2; color: white; }
    .delete { background: #ffebee; color: #d32f2f; }
    .delete:hover { background: #d32f2f; color: white; }

    /* Slug Style */
    .slug-code {
        background: #f4f4f4;
        padding: 2px 6px;
        border-radius: 4px;
        color: #e91e63;
        font-size: 13px;
    }

    /* Thông báo */
    .alert-success {
        background: #e8f5e9;
        border-left: 5px solid #2e7d32;
        color: #2e7d32;
        padding: 15px;
        border-radius: 4px;
        margin-bottom: 20px;
    }

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 40px !important;
        color: #999;
    }
    .empty-state i { font-size: 40px; margin-bottom: 10px; }

    /* Phân trang */
    .category-pagination {
        margin-top: 20px;
        display: flex;
        justify-content: center;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection