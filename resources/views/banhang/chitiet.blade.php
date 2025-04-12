@extends('layoutbanhang.master') <!-- Sử dụng layout chung của ứng dụng -->
@section('csschitiet')
    <link rel="stylesheet" href="{{ asset('source/assets/dest/css/custom.css') }}">
<link rel="stylesheet" href="{{ asset('source/assets/dest/css/font-awesome.min.css') }}">
		<link rel="stylesheet" href="{{ asset('source/assets/dest/vendors/colorbox/example3/colorbox.css') }}">
		<link rel="stylesheet" href="{{ asset('source/assets/dest/rs-plugin/css/settings.css') }}">
		<link rel="stylesheet" href="{{ asset('source/assets/dest/rs-plugin/css/responsive.css') }}">
		<link rel="stylesheet" title="style" href="{{ asset('source/assets/dest/css/style.css') }}">
		<link rel="stylesheet" href="{{ asset('source/assets/dest/css/animate.css') }}">
		<link rel="stylesheet" title="style" href="{{ asset('source/assets/dest/css/huong-style.css') }}">
@endsection
@extends('layoutbanhang.master')

@section('csschitiet')
    <!-- Sử dụng asset() để đảm bảo đường dẫn đúng -->
    <link rel="stylesheet" href="{{ asset('source/assets/dest/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('source/assets/dest/vendors/colorbox/example3/colorbox.css') }}">
    <link rel="stylesheet" href="{{ asset('source/assets/dest/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('source/assets/dest/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('source/assets/dest/css/huong-style.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-5">
            <!-- Hình ảnh sản phẩm -->
            <img src="{{ asset('source/image/product/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid">
        </div>
        <div class="col-md-7">
            <!-- Thông tin sản phẩm -->
            <h2>{{ $product->name }}</h2>
            
            <!-- Giá sản phẩm -->
            <p><strong>Giá:</strong>
                @if($product->promotion_price)
                    <span class="text-danger">{{ number_format($product->promotion_price) }} đồng</span>
                    <del class="text-muted">{{ number_format($product->unit_price) }} đồng</del>
                @else
                    <span>{{ number_format($product->unit_price) }} đồng</span>
                @endif
            </p>

            <!-- Mô tả sản phẩm -->
            <p><strong>Mô tả:</strong> {{ $product->description }}</p>

            <!-- Thêm vào giỏ hàng -->
            <form action="{{ route('banhang.addtocart', $product->id) }}" method="GET">
                @csrf
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
