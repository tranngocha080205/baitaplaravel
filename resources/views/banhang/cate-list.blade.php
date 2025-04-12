@extends('layoutbanhang.master')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Danh sách danh mục sản phẩm</h2>

    <a href="" class="btn btn-success mb-3">➕ Thêm Danh Mục</a>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Tên danh mục</th>
                <th>Mô tả</th>
                <th>Hình ảnh</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $cate)
                <tr>
                    <td>{{ $cate->id }}</td>
                    <td>{{ $cate->name }}</td>
                    <td>{{ $cate->description }}</td>
                    <td>
                        @if($cate->image)
                            <img src="{{ asset('source/product/' . $cate->image) }}" width="100" alt="{{ $cate->name }}">
                        @else
                            <em>Không có hình</em>
                        @endif
                    </td>
                    <td>
                        <a href="" class="btn btn-warning btn-sm">✏️ Sửa</a>

                        <form action="" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn xoá?')" class="btn btn-danger btn-sm">🗑️ Xoá</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
