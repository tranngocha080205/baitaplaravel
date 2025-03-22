<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phép Toán Cộng - Trừ - Nhân - Chia</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Phép Toán Cộng - Trừ - Nhân - Chia</h2>

        <!-- Form nhập dữ liệu -->
        <form action="{{ url('congtrunhanchia') }}" method="get">
            <div class="form-group">
                <label for="hsa">Nhập số a:</label>
                <input type="number" step="any" class="form-control" id="hsa" name="hsa" required>
            </div>

            <div class="form-group">
                <label for="hsb">Nhập số b:</label>
                <input type="number" step="any" class="form-control" id="hsb" name="hsb" required>
            </div>

            <div class="form-group">
                <label for="operation">Chọn phép toán:</label>
                <select class="form-control" name="operation" id="operation">
                    <option value="add">Cộng (+)</option>
                    <option value="subtract">Trừ (-)</option>
                    <option value="multiply">Nhân (×)</option>
                    <option value="divide">Chia (÷)</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Tính toán</button>
        </form>

        <!-- Hiển thị kết quả nếu có -->
        @if(isset($ketqua))
            <div class="alert alert-info mt-3">
                <strong>Kết quả:</strong> {{ $ketqua }}
            </div>
        @endif
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>