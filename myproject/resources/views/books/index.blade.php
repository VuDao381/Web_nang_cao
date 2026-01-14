@extends('layouts.myapp') 
@section('title', 'Books List')
@section('content')
    <h2>Books List</h2>
    <a href="{{ route('books.create') }}">Add New Book</a>
    <ul>
        @foreach($books as $book)
            <li>{{ $book->title }} by {{ $book->author }}</li>
        @endforeach
    </ul>
@endsection