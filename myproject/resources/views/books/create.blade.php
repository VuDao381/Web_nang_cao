@extends('layouts.myapp')
@section('title', 'Add New Book')
@section('content')
    <h2>Add New Book</h2>
    <form action="{{ route('books.store') }}" method="POST">
        @csrf
        <div>
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>
        </div>
        <div>
            <label for="author">Author:</label>
            <input type="text" id="author" name="author" required>
        </div>
        <div>
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" required>
        </div>
        <div>
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" required>
        </div>
        <div>
            <label for="published_date">Published Date:</label>
            <input type="date" id="published_date" name="published_date" required>
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>
        </div>
        <div>
            <label for="image">Image URL:</label>
            <input type="text" id="image" name="image" required>    
        </div>
        <div>
            <label for="category">Category:</label>
            <select id="category" name="category_id" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="publisher">Publisher:</label>
            <select id="publisher" name="publisher_id" required>
                @foreach($publishers as $publisher)
                    <option value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
        <button type="submit">Add Book</button>
    </form>
@endsection