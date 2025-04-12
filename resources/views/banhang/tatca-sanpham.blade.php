@extends('layouts.layoutbanhang') {{-- Sửa tên layout cho đúng --}}
@section('content')

<div class="container mt-4">
    <h2 class="mb-4">Tất cả sản phẩm</h2>
    <div class="row">
        @foreach($products as $product)
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <img src="{{ asset('images/'.$product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ number_format($product->unit_price) }} VND</p>
                        <a href="{{ route('banhang.addtocart', $product->id) }}" class="btn btn-primary mt-auto">Thêm vào giỏ</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
