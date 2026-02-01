<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $bookCount = Books::count();
        $categoryCount = Category::count();
        $publisherCount = Publisher::count();

        // Tính tổng doanh thu từ các đơn hàng đã hoàn thành
        $revenue = Order::where('status', 'completed')->sum('total_price');
        $pendingOrders = Order::where('status', 'pending')->count();

        return view('admin.home', compact('bookCount', 'categoryCount', 'publisherCount', 'revenue', 'pendingOrders'));
    }
}
