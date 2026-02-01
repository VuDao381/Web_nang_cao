@extends('admin.dashboard')

@section('title', 'Quản lý thể loại - ABC Book')

@section('admin_content')
    <div class="category-container">

        {{-- Header --}}
        <div class="category-header">
            <h2>📂 Danh sách thể loại</h2>


        </div>

        {{-- Thông báo --}}
        @if(session('success'))
            <div style="margin-bottom:15px; color:#16a34a; font-weight:600;">
                {{ session('success') }}
            </div>
        @endif

        {{-- Table --}}
        <div class="category-table-wrapper">
            <table class="category-table">
                <thead>
                    <tr>
                        <th width="60">ID</th>
                        <th>Tên thể loại</th>
                        <th>Slug</th>
                        <th width="120">Trạng thái</th>
                        <th width="160">Hành động</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>

                            <td>{{ $category->name }}</td>

                            <td>{{ $category->slug }}</td>

                            <td>
                                @if($category->is_active)
                                    <span class="category-status-active">
                                        Hoạt động
                                    </span>
                                @else
                                    <span class="category-status-inactive">
                                        Ẩn
                                    </span>
                                @endif
                            </td>

                            <td>
                                <div class="category-actions">
                                    <a href="{{ route('categories.edit', $category->id) }}" class="category-edit">
                                        ✏ Sửa
                                    </a>

                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                        onsubmit="return confirm('Bạn có chắc chắn muốn xóa thể loại này không?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="category-delete">
                                            🗑 Xóa
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align:center; padding:20px;">
                                📭 Chưa có thể loại nào
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="category-pagination">
            {{ $categories->links('pagination::numbers-only') }}
        </div>

    </div>
@endsection