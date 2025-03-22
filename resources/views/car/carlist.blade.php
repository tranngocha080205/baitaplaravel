<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Xe</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h3 class="text-center text-uppercase fw-bold text-danger shadow-lg p-3 mb-3 bg-light rounded">
          DANH SÁCH XE
        </h3>      
        <a href="{{ route('cars.create') }}" class="btn btn-success mb-3">
            <i class="fas fa-plus"></i> Add New
        </a>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Produced_on</th>
                    <th>Manufactory</th>
                    <th>Function</th>
                </tr>
            </thead>
            <tbody>
                @isset($cars)
                @foreach($cars as $car)
                <tr>
                    <td>{{ $car->id }}</td>
                    <td>{{ $car->make }}</td>
                    <td>{{ $car->model }}</td>
                    <td>{{ $car->produced_on }}</td>
                    <td>{{ $car->mf->mf_name }}</td>
                    <td>
                        <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Update
                        </a>
                        <form action="{{ route('cars.destroy', $car->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>                    
                    </td>
                </tr>
                @endforeach
                @endisset
            </tbody>
        </table>
    </div>
</body>
</html>
