<!-- HEADER -->
<div id="header">
    <!-- HEADER TOP -->
    <div class="header-top">
        <div class="container">
            <div class="pull-left auto-width-left">
                <ul class="top-menu menu-beta l-inline">
                    <li><a href="#"><i class="fa fa-home"></i> 90-92 Lê Thị Riêng, Bến Thành, Quận 1</a></li>
                    <li><a href="tel:01632967751"><i class="fa fa-phone"></i> 0163 296 7751</a></li>
                </ul>
            </div>
            <div class="pull-right auto-width-right">
                <ul class="top-details menu-beta l-inline">
                    @if(Auth::guard('customer')->check())
                        <li><a href="#"><i class="fa fa-user"></i> Xin chào, {{ Auth::guard('customer')->user()->full_name }}</a></li>
                        <li><a href="{{ Route('getlogout') }}"><i class="fa fa-sign-out"></i> Đăng xuất</a></li>
                    @else
                        <a href="{{ route('getsignin') }}">Đăng ký</a>
                        <li><a href="{{ route('getlogin') }}"><i class="fa fa-sign-in"></i> Đăng nhập</a></li>
                    @endif
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <!-- HEADER BODY -->
    <div class="header-body">
        <div class="container beta-relative">
            <div class="pull-left">
                <a href="{{ route('banhang.index') }}" id="logo">
                    <img src="{{ asset('assets/dest/images/logo-cake.png') }}" width="200px" alt="Laravel Shop Logo">
                </a>
            </div>

            <div class="pull-right beta-components space-left ov">
                <!-- SEARCH -->
                <div class="beta-comp">
                    <form role="search" method="get" action="{{ route('banhang.index') }}">
                        <input type="text" name="search" placeholder="Tìm kiếm sản phẩm..." value="{{ request('search') }}" />
                        <button type="submit" class="fa fa-search"></button>
                    </form>
                </div>

                <!-- CART -->
                <div class="beta-comp">
                    <div class="cart">
                        <div class="beta-select">
                            <i class="fa fa-shopping-cart"></i> Giỏ hàng:
                            <span>
                                @if(Session::has('cart') && is_object(Session('cart')))
                                    {{ Session('cart')->totalQty }}
                                @else
                                    Trống
                                @endif
                            </span>
                            <i class="fa fa-chevron-down"></i>
                        </div>

                        <div class="beta-dropdown cart-body">
                            @if(Session::has('cart') && is_object(Session('cart')))
                                <ul>
                                    @foreach(Session('cart')->items as $item)
                                        <li class="clearfix">
                                            <div class="media">
                                                <a class="pull-left" href="#">
                                                    <img src="{{ asset('storage/' . $item['item']->image) }}" width="50" alt="{{ $item['item']->name }}">
                                                </a>
                                                <div class="media-body">
                                                    {{ $item['item']->name }} <br>
                                                    SL: {{ $item['qty'] }} <br>
                                                    Giá: {{ number_format($item['item']->price, 0, ',', '.') }} VND
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-center">Giỏ hàng của bạn hiện đang trống!</p>
                            @endif

                            <div class="cart-caption">
                                <a href="{{ route('banhang.getdathang') }}" class="beta-btn primary">Đặt hàng <i class="fa fa-chevron-right"></i></a>
                                <a href="{{ route('banhang.cart.index') }}" class="beta-btn primary">Xem giỏ hàng <i class="fa fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>
        </div>
    </div>

    <!-- HEADER MENU -->
    <div class="header-bottom" style="background-color: #0277b8;">
        <div class="container">
            <nav class="main-menu">
                <ul class="l-inline ov">
                    <li><a href="{{ route('banhang.index') }}">Trang chủ</a></li>
                    <li><a href="#">Sản phẩm</a>
                        <ul class="sub-menu">
                            @isset($productTypes)
                                @foreach($productTypes as $type)
                                    <li><a href="{{ route('banhang.loaisanpham', $type->id) }}">{{ $type->name }}</a></li>
                                @endforeach
                            @else
                                <li><a href="#">Sản phẩm 1</a></li>
                                <li><a href="#">Sản phẩm 2</a></li>
                                <li><a href="#">Sản phẩm 3</a></li>
                            @endisset
                        </ul>
                    </li>
                    <li><a href="#">Giới thiệu</a></li>
                    <li><a href="#">Liên hệ</a></li>
                </ul>
                <div class="clearfix"></div>
            </nav>
        </div>
    </div>
</div>
