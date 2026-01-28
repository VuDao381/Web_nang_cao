@extends('dashboard')

@section('title', 'Danh sách nhà xuất bản')

@section('content')
    <div class="publisher-container">

        <div class="publisher-header">
            <h2>🏢 Danh sách nhà xuất bản</h2>

        </div>

        <div class="publisher-table-wrapper">
            <table class="publisher-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên</th>
                        <th>Địa chỉ</th>
                        <th>Điện thoại</th>
                        <th>Email</th>
                        <th width="150">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($publishers as $publisher)
                        <tr>
                            <td>{{ $publisher->id }}</td>
                            <td>{{ $publisher->name }}</td>
                            <td>{{ $publisher->address ?? '-' }}</td>
                            <td>{{ $publisher->phone ?? '-' }}</td>
                            <td>{{ $publisher->email ?? '-' }}</td>
                            <td>
                                <div class="publisher-actions">
                                    <a href="{{ route('publishers.edit', $publisher->id) }}" class="publisher-edit">
                                        Sửa
                                    </a>

                                    <form action="{{ route('publishers.destroy', $publisher->id) }}" method="POST"
                                        onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="publisher-delete">
                                            Xóa
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center">
                                Không có nhà xuất bản nào
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="publisher-pagination">
            {{ $publishers->links('pagination::numbers-only') }}
        </div>

    </div>
@endsection