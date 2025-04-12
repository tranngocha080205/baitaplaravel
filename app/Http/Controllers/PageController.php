<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Bill;
use App\Models\BillDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PageController extends Controller
{
    // ===================== 🧑‍💻 ĐĂNG KÝ =====================
    public function getSignin()
    {
        return view('banhang.dangky');
    }

    public function postSignin(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:customers,email',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'password' => 'required|string|min:6',
        ]);

        $customer = Customer::create([
            'email' => $request->email,
            'name' => $request->name,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'password' => bcrypt($request->password),
        ]);

        // Đăng nhập ngay sau khi đăng ký
        Auth::guard('customer')->login($customer);

        return redirect()->route('banhang.index')->with('success', 'Đăng ký thành công!');
    }

    // ===================== 🔐 ĐĂNG NHẬP =====================
    public function getLogin()
    {
        return view('banhang.login');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|max:20',
        ]);

        $credentials = $request->only('email', 'password');
        Log::info('🛂 Thử đăng nhập', ['email' => $credentials['email']]);

        if (Auth::guard('customer')->attempt($credentials)) {
            Log::info('✅ Đăng nhập thành công', ['user_id' => Auth::guard('customer')->id()]);
            return redirect()->route('banhang.index')->with(['flag' => 'alert', 'message' => 'Đăng nhập thành công']);
        }

        Log::warning('❌ Đăng nhập thất bại', ['email' => $credentials['email']]);
        return redirect()->back()->with(['flag' => 'danger', 'message' => 'Đăng nhập không thành công']);
    }

    // ===================== 🚪 ĐĂNG XUẤT =====================
    public function getLogout()
    {
        Auth::guard('customer')->logout();
        Session::forget('cart');
        return redirect()->route('banhang.index')->with('success', 'Đăng xuất thành công!');
    }

    // ===================== 🏠 TRANG CHỦ =====================
    public function getIndex(Request $request)
    {
        $search = $request->input('search');
        $query = Product::query();

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $new_products = (clone $query)->latest()->take(8)->get();
        $top_products = (clone $query)->where('promotion_price', '>', 0)->orderByDesc('created_at')->take(8)->get();
        $promotion_products = (clone $query)->where('promotion_price', '>', 0)->take(8)->get();
        $all_products = (clone $query)->paginate(12);

        if ($search && $new_products->isEmpty() && $top_products->isEmpty() && $promotion_products->isEmpty()) {
            return redirect()->route('banhang.index')->with('error', 'Không tìm thấy sản phẩm nào với từ khóa: ' . $search);
        }

        return view('banhang.index', compact('new_products', 'top_products', 'promotion_products', 'all_products', 'search'));
    }

    // ===================== 🔍 CHI TIẾT SẢN PHẨM =====================
    public function getChiTiet($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('banhang.index')->with('error', 'Sản phẩm không tồn tại!');
        }

        return view('banhang.chitiet', compact('product'));
    }

    // ===================== 🛒 GIỎ HÀNG =====================
    public function getCart()
    {
        $cart = $this->getCartFromSession();

        if (!$cart || empty($cart->items)) {
            return redirect()->route('banhang.index')->with('error', 'Giỏ hàng của bạn hiện tại không có sản phẩm nào.');
        }

        return view('banhang.cart', compact('cart'));
    }

    public function addToCart(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->back()->with('error', 'Sản phẩm không tồn tại!');
        }

        $cart = $this->getCartFromSession() ?: new Cart();
        $cart->add($product, $id);
        $this->updateCartSession($cart);

        return redirect()->back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng!');
    }

    public function reduce($id)
    {
        $cart = $this->getCartFromSession();
        if (!$cart) {
            return redirect()->route('banhang.cart')->with('error', 'Giỏ hàng trống.');
        }

        $cart->reduceByOne($id);
        $this->updateCartSession($cart);

        return redirect()->route('banhang.cart');
    }

    public function removeFromCart($id)
    {
        return $this->delCartItem($id);
    }

    public function delCartItem($id)
    {
        $cart = $this->getCartFromSession();
        if (!$cart) {
            return redirect()->route('banhang.cart')->with('error', 'Giỏ hàng trống.');
        }

        $cart->removeItem($id);
        $this->updateCartSession($cart);

        return redirect()->route('banhang.cart')->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng!');
    }

    // ===================== 💳 THANH TOÁN =====================
    public function getCheckout()
    {
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('banhang.login')->with('error', 'Bạn cần đăng nhập để thanh toán!');
        }
        return view('banhang.checkout');
    }

    public function postCheckout(Request $request)
    {
        if (!Auth::guard('customer')->check()) {
            return redirect()->back()->with('error', 'Bạn cần đăng nhập để đặt hàng.');
        }

        $cart = Session::get('cart');
        if (!$cart) {
            return redirect()->back()->with('error', 'Giỏ hàng trống.');
        }

        // Kiểm tra thông tin thanh toán
        $request->validate([
            'payment_method' => 'required|string',
            'notes' => 'nullable|string|max:255'
        ]);

        $bill = Bill::create([
            'id_customer' => Auth::guard('customer')->id(),
            'date_order' => now()->format('Y-m-d'),
            'total' => $cart->totalPrice,
            'payment' => $request->input('payment_method'),
            'note' => $request->input('notes'),
        ]);

        foreach ($cart->items as $productId => $item) {
            BillDetail::create([
                'id_bill' => $bill->id,
                'id_product' => $productId,
                'quantity' => $item['qty'],
                'unit_price' => $item['price'] / $item['qty'],
            ]);
        }

        Log::info('🧾 Đặt hàng thành công', [
            'customer_id' => Auth::guard('customer')->id(),
            'bill_id' => $bill->id
        ]);

        Session::forget('cart');
        return redirect()->route('banhang.index')->with('success', 'Đặt hàng thành công!');
    }

    // ===================== ⚙️ HỖ TRỢ =====================
    private function getCartFromSession()
    {
        return Session::has('cart') ? new Cart(Session::get('cart')) : null;
    }

    private function updateCartSession($cart)
    {
        if (!empty($cart->items)) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }
    }
}
