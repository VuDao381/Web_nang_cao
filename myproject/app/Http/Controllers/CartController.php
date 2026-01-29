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
}
