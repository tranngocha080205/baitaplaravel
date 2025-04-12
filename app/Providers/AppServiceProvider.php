<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use App\Models\Cart;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Chia sẻ dữ liệu giỏ hàng cho header và trang checkout
        View::composer(['layoutbanhang.header', 'banhang.checkout'], function ($view) {
            if (Session::has('cart')) {
                $oldCart = Session::get('cart'); // Lấy dữ liệu từ session
                $cart = new Cart($oldCart); // Tạo đối tượng Cart

                // Gửi dữ liệu đến view
                $view->with([
                    'cart'         => $oldCart,
                    'productCarts' => $cart->items,
                    'totalPrice'   => $cart->totalPrice,
                    'totalQty'     => $cart->totalQty,
                ]);
            } else {
                // Trường hợp giỏ hàng trống
                $view->with([
                    'cart'         => null,
                    'productCarts' => null,
                    'totalPrice'   => 0,
                    'totalQty'     => 0,
                ]);
            }
        });
    }
}
