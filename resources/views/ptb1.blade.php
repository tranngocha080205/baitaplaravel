<!DOCTYPE html>
<html>
<head>
    <title>Giải Phương Trình Bậc 1</title>
</head>
<body>
    <h2>Giải phương trình bậc 1 (ax + b = 0)</h2>

    <form action="{{ url('ptb1/solve') }}" method="POST">
        @csrf
        <label>Nhập a:</label>
        <input type="number" name="hsa" required>
        <label>Nhập b:</label>
        <input type="number" name="hsb" required>
        <button type="submit">Giải</button>
    </form>

    @if ($kq)
        <h3>Kết quả: {{ $kq }}</h3>
    @endif
</body>
</html>
