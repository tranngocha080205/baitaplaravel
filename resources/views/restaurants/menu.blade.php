<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thực Đơn</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="menu-container">
        <h1 class="title">Thực Đơn</h1>
        @foreach($menu as $category => $items)
            <h2 class="menu-title">{{ $category }}</h2>
            <div class="menu-section">
                @foreach($items as $item)
                    <div class="menu-item">
                        <img src="{{ asset('images/' . $item['image']) }}" alt="{{ $item['name'] }}">
                        <div class="menu-details">
                            <h3>{{ $item['name'] }}</h3>
                            <p>{{ $item['desc'] }}</p>
                            <span class="price">{{ $item['price'] }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</body>
</html>
