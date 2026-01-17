@extends('layouts.myapp')

@section('title', 'Dashboard')

@section('content')
<div class="dashboard-container">

    {{-- HEADER --}}
    <div class="dashboard-header">
        <h2>📊 Bảng điều khiển</h2>
        <p>Xin chào, <strong>{{ auth()->user()->name }}</strong></p>
    </div>

    {{-- STATISTICS --}}
    <div class="dashboard-stats">
        <div class="stat-card">
            <h3>📚 Sách</h3>
            <p class="stat-number">{{ $bookCount ?? 0 }}</p>
        </div>

        <div class="stat-card">
            <h3>📂 Thể loại</h3>
            <p class="stat-number">{{ $categoryCount ?? 0 }}</p>
        </div>

        <div class="stat-card">
            <h3>🏢 Nhà xuất bản</h3>
            <p class="stat-number">{{ $publisherCount ?? 0 }}</p>
        </div>

        <div class="stat-card">
            <h3>👤 Người dùng</h3>
            <p class="stat-number">{{ $userCount ?? 0 }}</p>
        </div>
    </div>

    {{-- QUICK ACTIONS --}}
    <div class="dashboard-actions">
        <a href="{{ route('books.create') }}" class="action-card">
            ➕ Thêm sách
        </a>

        <a href="{{ route('categories.create') }}" class="action-card">
            ➕ Thêm thể loại
        </a>

        <a href="{{ route('publishers.create') }}" class="action-card">
            ➕ Thêm NXB
        </a>

        <a href="{{ route('users.index') }}" class="action-card">
            👥 Quản lý người dùng
        </a>
    </div>

</div>
@endsection
