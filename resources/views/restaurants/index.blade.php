@extends('layouts.app')

@section('title', 'Danh Sách Nhà Hàng')

@section('content')
<div class="container">
    <h2 class="text-center my-4">Danh Sách Nhà Hàng</h2>

    <!-- Hiển thị thông báo thành công -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Nút Thêm Nhà Hàng -->
    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('restaurants.create') }}" class="btn btn-primary">+ Thêm Nhà Hàng</a>
    </div>

    <!-- Kiểm tra nếu danh sách trống -->
    @if($restaurants->isEmpty())
        <div class="alert alert-warning text-center">
            <strong>Chưa có nhà hàng nào!</strong> Hãy thêm mới một nhà hàng.
        </div>
    @else
        <!-- Bảng danh sách nhà hàng -->
        <table class="table table-hover table-bordered">
            <thead class="table-dark">
                <tr class="text-center">
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Địa chỉ</th>
                    <th>Hình ảnh</th>
                    <th>Mô tả</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($restaurants as $restaurant)
                    <tr>
                        <td class="text-center">{{ $restaurant->id }}</td>
                        <td>{{ $restaurant->name }}</td>
                        <td>{{ $restaurant->address }}</td>
                        <td class="text-center">
                            @if($restaurant->img)
                                <img src="{{ asset('storage/' . $restaurant->img) }}" alt="Hình ảnh" width="80" class="rounded">
                            @else
                                <span class="text-muted">Chưa có ảnh</span>
                            @endif
                        </td>
                        <td>{{ Str::limit($restaurant->description, 50) }}</td>
                        <td class="text-center">
                            <a href="{{ route('restaurants.show', $restaurant->id) }}" class="btn btn-info btn-sm">Xem</a>
                            <a href="{{ route('restaurants.edit', $restaurant->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                            <form action="{{ route('restaurants.destroy', $restaurant->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
