<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;
use App\Models\Category;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $books = Books::when($keyword, function ($q) use ($keyword) {
            $q->where('title', 'like', "%$keyword%")
                ->orWhere('author', 'like', "%$keyword%");
        })->latest()->paginate(20);

        $bestsellers = Books::withSum('orderItems', 'quantity')
            ->orderByDesc('order_items_sum_quantity')
            ->take(5)
            ->get();

        if ($bestsellers->sum('order_items_sum_quantity') == 0) {
            $bestsellers = Books::inRandomOrder()->take(5)->get();
        }

        $categories = Category::all();

        return view('user.welcome', compact(
            'books',
            'categories',
            'bestsellers'
        ));
    }
}
