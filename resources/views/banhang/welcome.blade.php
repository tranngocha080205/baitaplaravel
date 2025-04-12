<!doctype html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
</head>
<body>

    <div class="container">
        <h1>Sản phẩm mới</h1>
        <div class="row">
            @foreach($newProducts as $product)
                <div class="col-sm-4">
                    <div class="single-item">
                        <div class="single-item-header">
                            <a href="#"><img src="{{ $product->image }}" alt=""></a>
                        </div>
                        <div class="single-item-body">
                            <p class="single-item-title">{{ $product->name }}</p>
                            <p class="single-item-price">
                                <span>{{ $product->price }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <h1>Sản phẩm đề nghị</h1>
        <div class="row">
            @foreach($recommendedProducts as $product)
                <div class="col-sm-4">
                    <div class="single-item">
                        <div class="single-item-header">
                            <a href="#"><img src="{{ $product->image }}" alt=""></a>
                        </div>
                        <div class="single-item-body">
                            <p class="single-item-title">{{ $product->name }}</p>
                            <p class="single-item-price">
                                <span>{{ $product->price }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <h1>Sản phẩm khuyến mãi</h1>
        <div class="row">
            @foreach($discountedProducts as $product)
                <div class="col-sm-4">
                    <div class="single-item">
                        <div class="single-item-header">
                            <a href="#"><img src="{{ $product->image }}" alt=""></a>
                        </div>
                        <div class="single-item-body">
                            <p class="single-item-title">{{ $product->name }}</p>
                            <p class="single-item-price">
                                <span class="flash-del">{{ $product->original_price }}</span>
                                <span class="flash-sale">{{ $product->price }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
</body>
</html>