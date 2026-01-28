@extends('layouts.myapp')

@section('title', 'Quản lý Nhà xuất bản - ABC Book')

@section('content')
<div class="category-container">

    {{-- Header --}}
    <div class="category-header">
        <div class="header-title">
            <h2><i class="fa-solid fa-print"></i> Danh sách Nhà xuất bản</h2>
            <p>Quản lý các đơn vị xuất bản đối tác trong hệ thống</p>
        </div>

        <a href="{{ route('publishers.create') }}" class="category-add-btn">
            <i class="fa-solid fa-plus"></i> Thêm nhà xuất bản
        </a>
    </div>

    {{-- Thông báo thành công --}}
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
        </div>
    @endif
    
    {{-- Thông báo lỗi (nếu có) --}}
    @if(session('error'))
        <div class="alert alert-danger">
            <i class="fa-solid fa-triangle-exclamation"></i> {{ session('error') }}
        </div>
    @endif

    {{-- Table --}}
    <div class="category-table-wrapper">
        <table class="category-table">
            <thead>
                <tr>
                    <th width="60">#</th>
                    <th>Tên nhà xuất bản</th>
                    <th>Địa chỉ</th>
                    <th>Liên hệ</th>
                    <th width="160">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($publishers as $publisher)
                    <tr>
                        <td class="text-bold">{{ $publisher->id }}</td>
                        <td>
                            <div class="publisher-name">{{ $publisher->name }}</div>
                            <small class="text-muted">{{ $publisher->email ?? 'Không có email' }}</small>
                        </td>
                        <td>{{ $publisher->address ?? '-' }}</td>
                        <td>
                            @if($publisher->phone)
                                <span class="badge-phone"><i class="fa-solid fa-phone"></i> {{ $publisher->phone }}</span>
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </td>
                        <td>
                            <div class="category-actions">
                                <a href="{{ route('publishers.edit', $publisher->id) }}" class="btn-action edit" title="Chỉnh sửa">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>

                                <form action="{{ route('publishers.destroy', $publisher->id) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Bạn có chắc chắn muốn xóa nhà xuất bản này?')">
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
                            <i class="fa-solid fa-building-circle-exclamation"></i>
                            <p>Chưa có dữ liệu nhà xuất bản.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="category-pagination">
        {{ $publishers->links('pagination::numbers-only') }}
    </div>

</div>

<style>
    /* Reuse styles from Categories to ensure consistency */
    .category-container { padding: 10px; animation: fadeIn 0.5s ease; }
    
    .category-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
    .header-title h2 { color: #2e7d32; margin: 0; font-size: 24px; }
    .header-title p { color: #666; font-size: 14px; margin-top: 5px; }

    .category-add-btn { 
        background: #2e7d32; color: white; padding: 10px 20px; border-radius: 8px; 
        text-decoration: none; font-weight: 600; transition: 0.3s;
        box-shadow: 0 4px 10px rgba(46, 125, 50, 0.2);
    }
    .category-add-btn:hover { background: #1b5e20; transform: translateY(-2px); }

    .category-table-wrapper { background: white; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); overflow: hidden; }
    .category-table { width: 100%; border-collapse: collapse; }
    .category-table th { background: #f8faf9; color: #2e7d32; padding: 15px; text-align: left; border-bottom: 2px solid #e8f5e9; font-size: 13px; text-transform: uppercase; }
    .category-table td { padding: 15px; border-bottom: 1px solid #f0f0f0; vertical-align: middle; }
    
    .publisher-name { font-weight: bold; color: #333; }
    .badge-phone { background: #e3f2fd; color: #1976d2; padding: 4px 8px; border-radius: 4px; font-size: 12px; }

    .category-actions { display: flex; gap: 8px; }
    .btn-action { width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; border-radius: 6px; text-decoration: none; transition: 0.2s; border: none; cursor: pointer; }
    .edit { background: #e3f2fd; color: #1976d2; }
    .edit:hover { background: #1976d2; color: white; }
    .delete { background: #ffebee; color: #d32f2f; }
    .delete:hover { background: #d32f2f; color: white; }

    .alert { padding: 15px; border-radius: 8px; margin-bottom: 20px; border-left: 5px solid; }
    .alert-success { background: #e8f5e9; color: #2e7d32; border-left-color: #2e7d32; }
    .alert-danger { background: #ffebee; color: #c62828; border-left-color: #c62828; }

    .empty-state { text-align: center; padding: 50px !important; color: #999; }
    .empty-state i { font-size: 40px; margin-bottom: 10px; }

    .category-pagination { margin-top: 20px; display: flex; justify-content: center; }

    @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
</style>
@endsection