<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Books;

class CartController extends Controller
{
    // Xem giỏ hàng
    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        $cart = Cart::with('items.book')->where('user_id', $user->id)->first();

        return view('user.cart', compact('cart'));
    }

    // Thêm vào giỏ hàng
    public function addToCart(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $user = Auth::user();

        // 1. Tìm hoặc tạo giỏ hàng cho user
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);

        // 2. Kiểm tra sách đã có trong giỏ chưa
        $item = CartItem::where('cart_id', $cart->id)
            ->where('book_id', $request->book_id)
            ->first();

        $book = Books::find($request->book_id);

        if ($item) {
            // Update số lượng
            $item->quantity += $request->quantity;
            $item->save();
        } else {
            // Tạo mới
            CartItem::create([
                'cart_id' => $cart->id,
                'book_id' => $book->id,
                'quantity' => $request->quantity,
                'price' => $book->price // Lưu giá tại thời điểm mua
            ]);
        }

        if ($request->has('buy_now') && $request->buy_now == 1) {
            return redirect()->route('cart.index');
        }

        return redirect()->back()->with('success', 'Đã thêm vào giỏ hàng!');
    }

    // Cập nhật số lượng
    public function update(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:cart_items,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $item = CartItem::findOrFail($request->item_id);

        // Kiểm tra quyền sở hữu (đảm bảo user chỉ update item trong cart của mình)
        if ($item->cart->user_id !== Auth::id()) {
            abort(403);
        }

        $item->quantity = $request->quantity;
        $item->save();

        return redirect()->back()->with('success', 'Cập nhật giỏ hàng thành công!');
    }

    // Xóa item
    public function remove($id)
    {
        $item = CartItem::findOrFail($id);

        if ($item->cart->user_id !== Auth::id()) {
            abort(403);
        }

        $item->delete();

        return redirect()->back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng!');
    }

    // Checkout
    public function checkout(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        $cart = Cart::with('items.book')->where('user_id', $user->id)->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->back()->with('error', 'Giỏ hàng của bạn đang trống!');
        }

        // Tính tổng tiền
        $totalPrice = 0;
        foreach ($cart->items as $item) {
            $totalPrice += $item->quantity * $item->price;
        }

        // Validate Phone and Address
        if (empty($user->address) || empty($user->phone)) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Vui lòng cập nhật đầy đủ Địa chỉ và Số điện thoại trong phần Tài khoản trước khi đặt hàng!'
                ]);
            }
            return redirect()->route('profile.edit')->with('error', 'Vui lòng cập nhật đầy đủ Địa chỉ và Số điện thoại trước khi đặt hàng!');
        }

        // 1. Tạo đơn hàng
        // Lưu ý: Nếu user chưa có địa chỉ/sđt thì có thể để trống hoặc lấy mặc định. 
        // Ở đây lấy từ thông tin user (nếu có)
        $order = \App\Models\Order::create([
            'user_id' => $user->id,
            'total_price' => $totalPrice,
            'status' => 'pending', // Chờ xử lý
            'address' => $user->address ?? 'Chưa cập nhật địa chỉ',
            'phone' => $user->phone ?? 'Chưa cập nhật SĐT',
        ]);

        // 2. Chuyển items từ Cart sang OrderItem
        foreach ($cart->items as $item) {
            \App\Models\OrderItem::create([
                'order_id' => $order->id,
                'book_id' => $item->book_id,
                'quantity' => $item->quantity,
                'price' => $item->price,
            ]);
        }

        // --- Gửi thông báo cho Admin ---
        $admins = \App\Models\User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            \App\Models\SystemNotification::create([
                'user_id' => $admin->id,
                'title' => 'Có đơn hàng mới #' . $order->id,
                'message' => 'Người dùng ' . $user->name . ' vừa đặt đơn hàng trị giá ' . number_format($totalPrice) . 'đ',
                'is_read' => false,
            ]);
        }

        // 3. Xóa giỏ hàng
        $cart->items()->delete();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Đặt hàng thành công! Đơn hàng đang được xử lý.'
            ]);
        }

        return redirect()->route('home')->with('success', 'Đặt hàng thành công! Đơn hàng đang được xử lý.');
    }
}
