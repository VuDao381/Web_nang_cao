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
    public function index()
    {
        //
        $books = Books::all();
        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::all();
        $publishers = Publisher::all();

        return view('books.create', compact('categories', 'publishers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
        'title' => 'required|string|max:255',
        'author' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'quantity' => 'required|integer|min:0',
        'published_date' => 'required|date',
        'image' => 'required|url',
        'category_id' => 'required|exists:categories,id',
        'publisher_id' => 'required|exists:publishers,id',
    ]);

    Books::create($request->only([
        'title',
        'author',
        'price',
        'quantity',
        'published_date',
        'description',
        'image',
        'category_id',
        'publisher_id',
    ]));

    return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
