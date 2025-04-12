<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminLogin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // ✅ Nếu chưa đăng nhập → chuyển đến trang đăng nhập
        if (!Auth::check()) {
            return redirect()->route('auth.login')->with('error', 'Vui lòng đăng nhập trước!');
        }

        // ✅ Nếu người dùng không có quyền admin → về trang chủ
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('banhang.index')->with('error', 'Bạn không có quyền truy cập khu vực quản trị!');
        }

        // ✅ Nếu là admin → cho tiếp tục truy cập
        return $next($request);
    }
}
