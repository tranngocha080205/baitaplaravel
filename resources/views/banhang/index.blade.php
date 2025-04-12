@extends('layoutbanhang.master')

@section('content')
<div class="container">
    <div id="content" class="space-top-none">

        {{-- CHÈN MENU --}}
        @include('banhang.menu')

        <div class="main-content">
            <div class="space60">&nbsp;</div>
            <div class="row">
                <div class="col-sm-12">

                    <!-- Form tìm kiếm -->
                    <form action="{{ route('banhang.index') }}" method="GET" class="form-inline">
                        <input type="text" name="search" class="form-control" placeholder="Tìm kiếm sản phẩm..." value="{{ request()->input('search') }}">
                        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                    </form>

                    <!-- Thông báo lỗi -->
                    @if(session('error'))
                        <div class="alert alert-danger mt-3">{{ session('error') }}</div>
                    @endif

                    <!-- Thông báo thành công -->
                    @if(session('success'))
                        <div class="alert alert-success mt-3">{{ session('success') }}</div>
                    @endif

                    <!-- Sản phẩm mới -->
                    @if($new_products->count() > 0)
                    <div class="beta-products-list">
                        <h4>Sản phẩm mới</h4>
                        <div class="beta-products-details">
                            <p class="pull-left">{{ $new_products->count() }} sản phẩm được tìm thấy</p>
                            <div class="clearfix"></div>
                        </div>
                        <div class="row">
                            @foreach($new_products as $new_product)
                            <div class="col-sm-3">
                                <div class="single-item">
                                    @if($new_product->promotion_price != 0)
                                        <div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
                                    @endif
                                    <div class="single-item-header">
                                        <a href="{{ route('banhang.chitiet', $new_product->id) }}">
                                            <img src="{{ asset('source/image/product/' . $new_product->image) }}" alt="{{ $new_product->name }}" height="250px">
                                        </a>
                                    </div>
                                    <div class="single-item-body">
                                        <p class="single-item-title">{{ $new_product->name }}</p>
                                        <p class="single-item-price">
                                            @if($new_product->promotion_price == 0)
                                                <span class="flash-sale">{{ number_format($new_product->unit_price) }} đồng</span>
                                            @else
                                                <span class="flash-del">{{ number_format($new_product->unit_price) }} đồng</span>
                                                <span class="flash-sale">{{ number_format($new_product->promotion_price) }} đồng</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="single-item-caption">
                                        <a class="add-to-cart pull-left" href="{{ route('banhang.cart.add', $new_product->id) }}">
                                            <i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng
                                        </a>
                                        <a class="beta-btn primary" href="{{ route('banhang.chitiet', $new_product->id) }}">Chi tiết <i class="fa fa-chevron-right"></i></a>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Sản phẩm đề nghị -->
                    @if($top_products->count() > 0)
                    <div class="beta-products-list">
                        <h4>Sản phẩm đề nghị</h4>
                        <div class="beta-products-details">
                            <p class="pull-left">{{ $top_products->count() }} sản phẩm được tìm thấy</p>
                            <div class="clearfix"></div>
                        </div>
                        <div class="row">
                            @foreach($top_products as $top_product)
                            <div class="col-sm-3">
                                <div class="single-item">
                                    @if($top_product->promotion_price != 0)
                                        <div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
                                    @endif
                                    <div class="single-item-header">
                                        <a href="{{ route('banhang.chitiet', $top_product->id) }}">
                                            <img src="{{ asset('source/image/product/' . $top_product->image) }}" alt="{{ $top_product->name }}" height="250px">
                                        </a>
                                    </div>
                                    <div class="single-item-body">
                                        <p class="single-item-title">{{ $top_product->name }}</p>
                                        <p class="single-item-price">
                                            @if($top_product->promotion_price == 0)
                                                <span class="flash-sale">{{ number_format($top_product->unit_price) }} đồng</span>
                                            @else
                                                <span class="flash-del">{{ number_format($top_product->unit_price) }} đồng</span>
                                                <span class="flash-sale">{{ number_format($top_product->promotion_price) }} đồng</span> 
                                            @endif
                                        </p>
                                    </div>
                                    <div class="single-item-caption">
                                        <a class="add-to-cart pull-left" href="{{ route('banhang.cart.add', $top_product->id) }}">
                                            <i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng
                                        </a>
                                        <a class="beta-btn primary" href="{{ route('banhang.chitiet', $top_product->id) }}">Chi tiết <i class="fa fa-chevron-right"></i></a>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @else 
                    <h1>Không có</h1>
                    @endif

                    <!-- Sản phẩm khuyến mại -->
                    @if($promotion_products->count() > 0)
                    <div class="beta-products-list">
                        <h4>Sản phẩm khuyến mại</h4>
                        <div class="beta-products-details">
                            <p class="pull-left">{{ $promotion_products->count() }} sản phẩm được tìm thấy</p>
                            <div class="clearfix"></div>
                        </div>
                        <div class="row">
                            @foreach($promotion_products as $promotion_product)
                            <div class="col-sm-3">
                                <div class="single-item">
                                    @if($promotion_product->promotion_price != 0)
                                        <div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
                                    @endif
                                    <div class="single-item-header">
                                        <a href="{{ route('banhang.chitiet', $promotion_product->id) }}">
                                            <img src="{{ asset('source/image/product/' . $promotion_product->image) }}" alt="{{ $promotion_product->name }}" height="250px">
                                        </a>
                                    </div>
                                    <div class="single-item-body">
                                        <p class="single-item-title">{{ $promotion_product->name }}</p>
                                        <p class="single-item-price">
                                            <span class="flash-del">{{ number_format($promotion_product->unit_price) }} đồng</span>
                                            <span class="flash-sale">{{ number_format($promotion_product->promotion_price) }} đồng</span>
                                        </p>
                                    </div>
                                    <div class="single-item-caption">
                                        <a class="add-to-cart pull-left" href="{{ route('banhang.cart.add', $promotion_product->id) }}">
                                            <i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng
                                        </a>
                                        <a class="beta-btn primary" href="{{ route('banhang.chitiet', $promotion_product->id) }}">
                                            Chi tiết <i class="fa fa-chevron-right"></i>
                                        </a>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
