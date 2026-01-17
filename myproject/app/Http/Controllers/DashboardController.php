<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Hiển thị trang Dashboard
     */
    public function index()
    {
        return view('dashboard', [
            'bookCount'      => Books::count(),
            'categoryCount'  => Category::count(),
            'publisherCount' => Publisher::count(),
            'userCount'      => User::count(),
        ]);
    }
}
