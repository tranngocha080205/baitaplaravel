@extends('layoutbanhang.master')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">🛒 Giỏ hàng của bạn</h2>

    @if(session()->has('cart') && count(session('cart')->items) > 0)
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>Hình ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach(session('cart')->items as $id => $details)
                <tr>
                    <td>
                        <img src="{{ asset('storage/' . $details['item']->image) }}" alt="{{ $details['item']->name }}" width="60">
                    </td>
                    <td>{{ $details['item']->name }}</td>
                    <td>{{ $details['qty'] }}</td>
                    <td>{{ number_format($details['price']) }} VND</td>
                    <td>
                        <a href="{{ route('banhang.cart.reduce', $id) }}" class="btn btn-sm btn-warning me-1">
                            <i class="bi bi-dash-circle"></i> Giảm
                        </a>
                        <a href="{{ route('banhang.cart.remove', $id) }}" class="btn btn-sm btn-danger">
                            <i class="bi bi-trash"></i> Xóa
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            <h4 class="text-end">Tổng tiền: <strong>{{ number_format(session('cart')->totalPrice) }} VND</strong></h4>
        </div>

        <div class="text-end mt-3">
            <a href="{{ route('banhang.checkout') }}" class="btn btn-success">
                <i class="bi bi-credit-card"></i> Thanh toán
            </a>
        </div>
    @else
        <div class="alert alert-info">
            🛍️ Giỏ hàng của bạn đang trống.
        </div>
    @endif
</div>
@endsection
