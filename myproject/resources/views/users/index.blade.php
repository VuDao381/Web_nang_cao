@extends('layouts.myapp')

@section('title', 'Quản lý người dùng')

@section('content')
<div class="publisher-container">

    {{-- Header --}}
    <div class="publisher-header">
        <h2>👤 Danh sách người dùng</h2>
        <a href="{{ route('users.create') }}" class="publisher-add-btn">
            ➕ Thêm người dùng
        </a>
    </div>

    {{-- Alert --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif

    {{-- Table --}}
    <div class="publisher-table-wrapper">
        <table class="publisher-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Quyền</th>
                    <th>Trạng thái</th>
                    <th width="180">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $index => $user)
                    <tr>
                        <td>{{ $users->firstItem() + $index }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>

                        {{-- Role --}}
                        <td>
                            @if($user->role === 'admin')
                                <strong>Admin</strong>
                            @else
                                User
                            @endif
                        </td>

                        {{-- Status --}}
                        <td>
                            @if($user->is_active)
                                <span class="publisher-status-active">Hoạt động</span>
                            @else
                                <span class="publisher-status-inactive">Bị khóa</span>
                            @endif
                        </td>

                        {{-- Actions --}}
                        <td>
                            <div class="publisher-actions">

                                {{-- Toggle status --}}
                                <form
                                    action="{{ route('users.toggleStatus', $user->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Bạn chắc chắn muốn đổi trạng thái?')"
                                >
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="publisher-edit">
                                        {{ $user->is_active ? 'Khóa' : 'Mở' }}
                                    </button>
                                </form>

                                {{-- Edit --}}
                                <a
                                    href="{{ route('users.edit', $user->id) }}"
                                    class="publisher-edit"
                                >
                                    Sửa
                                </a>

                                {{-- Delete --}}
                                <form
                                    action="{{ route('users.destroy', $user->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Xóa người dùng này?')"
                                >
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
                        <td colspan="6" style="text-align:center;padding:20px;">
                            Chưa có người dùng nào
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="publisher-pagination">
        {{ $users->links() }}
    </div>

</div>
@endsection
