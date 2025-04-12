@extends('layoutbanhang.master')

@section('content')

@if (session('success'))
    <div class="alert alert-success" style="margin: 20px 0;">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger" style="margin: 20px 0;">
        {{ session('error') }}
    </div>
@endif

<!-- Inner header -->
<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">Đặt hàng</h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb">
                <a href="{{ url('/') }}">Trang chủ</a> / <span>Đặt hàng</span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<!-- Main content -->
<div class="container">
    <div id="content">
        <form action="#" method="post" class="beta-form-checkout">
            @csrf
            <div class="row">
                <div class="col-sm-6">
                    <h4>Đặt hàng</h4>
                    <div class="space20">&nbsp;</div>

                    <div class="form-block">
                        <label for="name">Họ tên*</label>
                        <input type="text" id="name" name="name" required placeholder="Họ tên">
                    </div>

                    <div class="form-block">
                        <label>Giới tính</label>
                        <input type="radio" name="gender" value="nam" checked> Nam
                        <input type="radio" name="gender" value="nữ"> Nữ
                    </div>

                    <div class="form-block">
                        <label for="email">Email*</label>
                        <input type="email" id="email" name="email" required placeholder="example@gmail.com">
                    </div>

                    <div class="form-block">
                        <label for="address">Địa chỉ*</label>
                        <input type="text" id="address" name="address" required placeholder="Street Address">
                    </div>

                    <div class="form-block">
                        <label for="phone">Điện thoại*</label>
                        <input type="text" id="phone" name="phone" required>
                    </div>

                    <div class="form-block">
                        <label for="notes">Ghi chú</label>
                        <textarea id="notes" name="notes"></textarea>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="your-order">
                        <div class="your-order-head"><h5>Đơn hàng của bạn</h5></div>
                        <div class="your-order-body" style="padding: 0px 10px">
                            @if (isset($productCarts) && count($productCarts) > 0)
                                @foreach ($productCarts as $item)
                                    <div class="your-order-item">
                                        <div class="media">
                                            <img width="25%" src="{{ asset('assets/dest/images/products/' . $item['item']['image']) }}" alt="{{ $item['item']['name'] }}" class="pull-left">
                                            <div class="media-body">
                                                <p class="font-large">{{ $item['item']['name'] }}</p>
                                                <span class="color-gray your-order-info">Đơn giá: {{ number_format($item['item']['price']) }} VNĐ</span><br>
                                                <span class="color-gray your-order-info">Số lượng: {{ $item['qty'] }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="your-order-item">
                                    <div class="pull-left"><p class="your-order-f18">Tổng tiền:</p></div>
                                    <div class="pull-right"><h5 class="color-black">{{ number_format($totalPrice) }} VNĐ</h5></div>
                                    <div class="clearfix"></div>
                                </div>
                            @else
                                <p>Không có sản phẩm trong giỏ hàng.</p>
                            @endif
                        </div>

                        <div class="your-order-head"><h5>Hình thức thanh toán</h5></div>
                        <div class="your-order-body">
                            <ul class="payment_methods methods">
                                <li class="payment_method_bacs">
                                    <input type="radio" name="payment_method" value="COD" checked> Thanh toán khi nhận hàng
                                    <div class="payment_box">
                                        Bạn sẽ thanh toán khi nhận hàng từ nhân viên giao hàng.
                                    </div>
                                </li>
                                <li class="payment_method_cheque">
                                    <input type="radio" name="payment_method" value="ATM"> Chuyển khoản
                                    <div class="payment_box" style="display: none">
                                        Chuyển khoản vào tài khoản:
                                        <br>- Số tài khoản: 123 456 789
                                        <br>- Chủ TK: Nguyễn A
                                        <br>- Ngân hàng ACB - Chi nhánh TPHCM
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="beta-btn primary">
                                Đặt hàng <i class="fa fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const atmRadio = document.querySelector('input[value="ATM"]');
        const codRadio = document.querySelector('input[value="COD"]');
        const atmBox = atmRadio.nextElementSibling;
        const codBox = codRadio.nextElementSibling;

        function togglePaymentBoxes() {
            if (atmRadio.checked) {
                atmBox.style.display = 'block';
                codBox.style.display = 'none';
            } else {
                atmBox.style.display = 'none';
                codBox.style.display = 'block';
            }
        }

        atmRadio.addEventListener('change', togglePaymentBoxes);
        codRadio.addEventListener('change', togglePaymentBoxes);
        togglePaymentBoxes(); // Gọi lúc đầu
    });
</script>
@endpush
