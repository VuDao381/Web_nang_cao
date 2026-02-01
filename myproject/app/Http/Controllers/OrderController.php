<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('user')->latest()->paginate(20);
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::with(['user', 'items.book'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,shipping,completed,cancelled',
        ]);

        $order = Order::findOrFail($id);
        $oldStatus = $order->status;
        $order->update(['status' => $request->status]);

        // Nếu trạng thái thay đổi, gửi thông báo
        if ($oldStatus !== $request->status) {

            // 1. Gửi Email (Sử dụng try-catch để tránh lỗi nếu chưa cấu hình mail)
            try {
                \Illuminate\Support\Facades\Mail::to($order->user->email)->send(new \App\Mail\OrderStatusUpdated($order));
            } catch (\Exception $e) {
                // Log lỗi hoặc bỏ qua nếu server chưa config mail
                \Illuminate\Support\Facades\Log::error('Không thể gửi email: ' . $e->getMessage());
            }

            // 2. Tạo thông báo In-App
            \App\Models\SystemNotification::create([
                'user_id' => $order->user_id,
                'title' => 'Cập nhật đơn hàng #' . $order->id,
                'message' => 'Trạng thái đơn hàng của bạn đã chuyển sang: ' . $request->status,
                'is_read' => false,
            ]);
        }

        return redirect()->route('orders.show', $id)->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
    }
}
