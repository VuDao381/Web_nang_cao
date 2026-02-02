<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;
use App\Models\Category;
use App\Models\Publisher;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $books = Books::with(['category', 'publisher'])
            ->when($keyword, function ($query) use ($keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('title', 'like', "%$keyword%")
                        ->orWhere('author', 'like', "%$keyword%")
                        ->orWhereHas('category', function ($q2) use ($keyword) {
                            $q2->where('name', 'like', "%$keyword%");
                        })
                        ->orWhereHas('publisher', function ($q3) use ($keyword) {
                            $q3->where('name', 'like', "%$keyword%");
                        });
                });
            })
            ->paginate(20)
            ->withQueryString();

        return view('admin.books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $publishers = Publisher::all();

        return view('admin.books.create', compact('categories', 'publishers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'quantity' => 'required|integer|min:0',
            'published_year' => 'nullable|digits:4|integer|min:1000|max:' . date('Y'),
            'pages' => 'nullable|integer|min:1',
            'description' => 'nullable|string',
            'image' => 'required|url',
            'category_id' => 'required|exists:categories,id',
            'publisher_id' => 'required|exists:publishers,id',
        ]);

        Books::create($request->only([
            'title',
            'author',
            'price',
            'quantity',
            'published_year',
            'pages',
            'description',
            'image',
            'category_id',
            'publisher_id',
        ]));

        return redirect()->route('books.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $books = Books::findOrFail($id);
        $categories = Category::all();
        $publishers = Publisher::all();

        return view('admin.books.edit', compact('books', 'categories', 'publishers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'quantity' => 'required|integer|min:0',
            'published_year' => 'nullable|digits:4|integer|min:1000|max:' . date('Y'),
            'pages' => 'nullable|integer|min:1',
            'description' => 'nullable|string',
            'image' => 'required|url',
            'category_id' => 'required|exists:categories,id',
            'publisher_id' => 'required|exists:publishers,id',
        ]);

        $books = Books::findOrFail($id);

        $books->update($request->only([
            'title',
            'author',
            'price',
            'quantity',
            'published_year',
            'pages',
            'description',
            'image',
            'category_id',
            'publisher_id',
        ]));

        return redirect()->route('books.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $books = Books::findOrFail($id);
        $books->delete();

        return redirect()->route('books.index');
    }

    /**
     * Hiển thị sách theo thể loại (User)
     */
    public function booksByCategory($slug)
    {
        // 1. Tìm thể loại theo slug
        $category = Category::where('slug', $slug)->firstOrFail();

        // 2. Lấy sách thuộc thể loại đó, phân trang
        $books = Books::where('category_id', $category->id)
            ->latest()
            ->paginate(15);

        // 3. Trả về view
        return view('user.books_by_category', compact('category', 'books'));
    }

    /**
     * Hiển thị sách theo nhà xuất bản (User)
     */
    public function booksByPublisher($slug)
    {
        // 1. Tìm NXB theo slug (tự tạo slug từ name để so sánh)
        $publishers = \App\Models\Publisher::all();
        $publisher = $publishers->first(function ($item) use ($slug) {
            return \Illuminate\Support\Str::slug($item->name) === $slug;
        });

        if (!$publisher) {
            abort(404);
        }

        // 2. Lấy sách
        $books = Books::where('publisher_id', $publisher->id)
            ->latest()
            ->paginate(15);

        // 3. Trả về view
        return view('user.books_by_publisher', compact('publisher', 'books'));
    }
}
