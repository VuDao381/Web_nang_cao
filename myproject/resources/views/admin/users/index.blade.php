@extends('admin.dashboard')

@section('title', 'Quản lý người dùng')

@section('admin_content')
    <div class="publisher-container">

        <div class="publisher-header">
            <h2>👥 Quản lý người dùng</h2>

        </div>

        {{-- Success --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="publisher-table-wrapper">
            <table class="publisher-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Vai trò</th>
                        <th>Trạng thái</th>
                        <th width="160">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                {{ $user->role === 'admin' ? 'Admin' : 'User' }}
                            </td>
                            <td>
                                @if($user->is_active)
                                    <span class="publisher-status-active">Hoạt động</span>
                                @else
                                    <span class="publisher-status-inactive">Bị khóa</span>
                                @endif
                            </td>
                            <td class="publisher-actions">
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="publisher-edit">
                                    ✏️ Sửa
                                </a>

                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                    onsubmit="return confirm('Xóa người dùng này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="publisher-delete">🗑 Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">Chưa có người dùng</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="publisher-pagination">
            {{ $users->links() }}
        </div>
    </div>
@endsection