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
        <button type="submit">Add Book</button>
    </form>
@endsection