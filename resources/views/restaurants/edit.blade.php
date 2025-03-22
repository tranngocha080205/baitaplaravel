@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Chỉnh sửa Nhà hàng</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(isset($restaurant))
        <form action="{{ route('restaurants.update', $restaurant->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Tên Nhà hàng:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $restaurant->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Địa chỉ:</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $restaurant->address) }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Mô tả:</label>
                <textarea class="form-control" id="description" name="description">{{ old('description', $restaurant->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="img" class="form-label">Ảnh Nhà hàng:</label>
                <input type="file" class="form-control" id="img" name="img">
                @if($restaurant->img && Storage::disk('public')->exists($restaurant->img))
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $restaurant->img) }}" alt="Hình ảnh" class="img-thumbnail" width="200">
                    </div>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('restaurants.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    @else
        <div class="alert alert-warning">Không tìm thấy nhà hàng để chỉnh sửa.</div>
        <a href="{{ route('restaurants.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
    @endif
</div>
@endsection
