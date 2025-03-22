<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\MenuController; // ✅ Thêm controller menu

// 🌟 Trang chủ
Route::get('/', function () {
    return view('welcome');
});

// 📌 Nhóm tuyến đường cho **Nhà hàng (Restaurant)**
Route::prefix('restaurants')->group(function () {
    Route::get('/', [RestaurantController::class, 'index'])->name('restaurants.index'); // Danh sách nhà hàng
    Route::get('/create', [RestaurantController::class, 'create'])->name('restaurants.create'); // Form thêm mới
    Route::post('/store', [RestaurantController::class, 'store'])->name('restaurants.store'); // Xử lý thêm mới
    Route::get('/{id}/edit', [RestaurantController::class, 'edit'])->name('restaurants.edit'); // Form chỉnh sửa
    Route::put('/{id}', [RestaurantController::class, 'update'])->name('restaurants.update'); // Cập nhật nhà hàng
    Route::get('/{id}', [RestaurantController::class, 'show'])->name('restaurants.show'); // Xem chi tiết nhà hàng
    Route::delete('/{id}', [RestaurantController::class, 'destroy'])->name('restaurants.destroy'); // Xóa nhà hàng
});

// 📌 Nhóm tuyến đường cho **Quản lý Xe (Car)**
Route::prefix('cars')->group(function () {
    Route::get('/', [CarController::class, 'index'])->name('cars.index'); // Danh sách xe
    Route::get('/create', [CarController::class, 'create'])->name('cars.create'); // Form thêm xe
    Route::post('/store', [CarController::class, 'store'])->name('cars.store'); // Xử lý thêm xe
    Route::get('/{id}/edit', [CarController::class, 'edit'])->name('cars.edit'); // Form chỉnh sửa xe
    Route::put('/{id}', [CarController::class, 'update'])->name('cars.update'); // Cập nhật xe
    Route::delete('/{id}', [CarController::class, 'destroy'])->name('cars.destroy'); // Xóa xe
    Route::get('/{id}', [CarController::class, 'show'])->name('cars.show'); // Xem chi tiết xe
});

// ✅ Thêm route menu
Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
