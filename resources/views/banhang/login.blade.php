<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BetaDesign - Đăng Nhập</title>
    <link href="http://fonts.googleapis.com/css?family=Dosis:300,400" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/dest/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dest/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dest/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dest/css/huong-style.css') }}">
</head>
<body>

    <div id="header">
        {{-- Có thể include header nếu đã có --}}
    </div> <!-- #header -->

    <div class="inner-header">
        <div class="container">
            <div class="pull-left">
                <h6 class="inner-title">Đăng nhập</h6>
            </div>
            <div class="pull-right">
                <div class="beta-breadcrumb">
                    <a href="{{ route('banhang.trangchu') }}">Trang chủ</a> / <span>Đăng nhập</span>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="container">
        <div id="content">
            <form action="{{ route('auth.postlogin') }}" method="post" class="beta-form-checkout">
                @csrf
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                        <h4 class="text-center">Đăng nhập</h4>
                        <div class="space20">&nbsp;</div>

                        {{-- Hiển thị lỗi --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- Hiển thị thông báo --}}
                        @if (session('message'))
                            <div class="alert alert-{{ session('flag') }}">
                                {{ session('message') }}
                            </div>
                        @endif

                        <div class="form-block">
                            <label for="email">Email address*</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Nhập email" required>
                        </div>

                        <div class="form-block">
                            <label for="password">Password*</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Nhập mật khẩu" required>
                        </div>

                        <div class="form-block text-center mt-3">
                            <button type="submit" class="btn btn-primary">Đăng Nhập</button>
                        </div>

                        <div class="text-center mt-3">
                        <a href="{{ route('banhang.dangky') }}">Chưa có tài khoản? Đăng ký ngay</a>
                        </div>
                    </div>
                    <div class="col-sm-3"></div>
                </div>
            </form>
        </div> <!-- #content -->
    </div> <!-- .container -->

    <div id="footer">
        {{-- Có thể include footer nếu cần --}}
    </div> <!-- #footer -->

    <script src="{{ asset('assets/dest/js/jquery.js') }}"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets/dest/js/scripts.min.js') }}"></script>
</body>
</html>
