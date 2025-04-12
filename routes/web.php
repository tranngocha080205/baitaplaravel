<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CategoryController;

/*
|-------------------------------------------------------------------------- 
| 📦 TRANG BÁN HÀNG
|-------------------------------------------------------------------------- 
*/

// 🏠 Trang chủ
Route::get('/', [PageController::class, 'getIndex'])->name('banhang.index');
Route::get('/trangchu', [PageController::class, 'getIndex'])->name('banhang.trangchu');

// 🔍 Chi tiết sản phẩm
Route::get('/chitiet/{sanpham_id}', [PageController::class, 'getChiTiet'])->name('banhang.chitiet');

// 🛒 Giỏ hàng & ✅ Thanh toán (yêu cầu đăng nhập)
Route::middleware(['auth'])->group(function () {
    // 🛒 Giỏ hàng
    Route::get('/cart', [PageController::class, 'getCart'])->name('banhang.cart.index');  // Trang giỏ hàng

    // Các route con cho giỏ hàng
    Route::prefix('cart')->name('banhang.cart.')->group(function () {
        Route::get('/add/{id}', [PageController::class, 'addToCart'])->name('add');  // Thêm sản phẩm vào giỏ
        Route::get('/reduce/{id}', [PageController::class, 'reduce'])->name('reduce');  // Giảm số lượng sản phẩm trong giỏ
        Route::get('/remove/{id}', [PageController::class, 'delCartItem'])->name('remove');  // Xóa sản phẩm khỏi giỏ
    });

    // ✅ Thanh toán
    Route::get('/checkout', [PageController::class, 'getCheckout'])->name('banhang.checkout');  // Trang thanh toán
    Route::post('/checkout', [PageController::class, 'postCheckout'])->name('banhang.checkout.process');  // Xử lý thanh toán

    // 🧾 Đặt hàng thành công
    Route::get('/dathang', [PageController::class, 'getDatHang'])->name('banhang.getdathang');
});

/*
|-------------------------------------------------------------------------- 
| 🍽️ QUẢN LÝ NHÀ HÀNG (CRUD)
|-------------------------------------------------------------------------- 
*/
Route::prefix('restaurants')->name('restaurants.')->middleware('auth')->group(function () {
    Route::get('/', [RestaurantController::class, 'index'])->name('index');
    Route::get('/create', [RestaurantController::class, 'create'])->name('create');
    Route::post('/store', [RestaurantController::class, 'store'])->name('store');
    Route::get('/{id}', [RestaurantController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [RestaurantController::class, 'edit'])->name('edit');
    Route::put('/{id}', [RestaurantController::class, 'update'])->name('update');
    Route::delete('/{id}', [RestaurantController::class, 'destroy'])->name('destroy');
});

/*
|-------------------------------------------------------------------------- 
| 🚗 QUẢN LÝ XE (CRUD)
|-------------------------------------------------------------------------- 
*/
Route::prefix('cars')->name('cars.')->middleware('auth')->group(function () {
    Route::get('/', [CarController::class, 'index'])->name('index');
    Route::get('/create', [CarController::class, 'create'])->name('create');
    Route::post('/store', [CarController::class, 'store'])->name('store');
    Route::get('/{id}', [CarController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [CarController::class, 'edit'])->name('edit');
    Route::put('/{id}', [CarController::class, 'update'])->name('update');
    Route::delete('/{id}', [CarController::class, 'destroy'])->name('destroy');
});

/*
|-------------------------------------------------------------------------- 
| 📜 MENU NHÀ HÀNG
|-------------------------------------------------------------------------- 
*/
Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');

/*
|-------------------------------------------------------------------------- 
| 🧑‍💻 XÁC THỰC NGƯỜI DÙNG
|-------------------------------------------------------------------------- 
*/
Route::prefix('auth')->group(function () {
    // 🧑‍💻 Đăng ký
    Route::get('/signin', [PageController::class, 'getSignin'])->name('auth.signin');
    Route::post('/signin', [PageController::class, 'postSignin'])->name('auth.postsignin');  // Đăng ký (POST)

    // 🔐 Đăng nhập
    Route::get('/dangnhap', [PageController::class, 'getLogin'])->name('auth.login');
    Route::post('/dangnhap', [PageController::class, 'postLogin'])->name('auth.postlogin'); // Đăng nhập (POST)
    
    // 🚪 Đăng xuất
    Route::get('/dangxuat', [PageController::class, 'getLogout'])->name('auth.logout');
});

/*
|-------------------------------------------------------------------------- 
| 🗂️ QUẢN LÝ DANH MỤC SẢN PHẨM
|-------------------------------------------------------------------------- 
*/
Route::prefix('banhang/category')->name('category.')->middleware('auth')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::get('/create', [CategoryController::class, 'create'])->name('create');
    Route::post('/', [CategoryController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('edit');
    Route::put('/{id}', [CategoryController::class, 'update'])->name('update');
    Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('destroy');
});

/*
|-------------------------------------------------------------------------- 
| ❌ ROUTE DỰ PHÒNG (404 NOT FOUND)
|-------------------------------------------------------------------------- 
*/
Route::fallback(function () {
    return view('errors.404'); // Trang lỗi 404
});
