<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>show book by category</title>
</head>
<body>
<!-- @include('header') -->
<h1>Books in {{ $category }} Category</h1>
<ul>
@foreach($books as $book)
    <div class="singlebook" name="book_{{$book->book_id}}">
        <a href="{{ route('book.show', $book->ISBN) }}">
            <img src="{{$book->bookcover_url}}" alt="{{$book->title}} book cover image" class="bookcover">
            <p>{{ $book->title }}</p>
            <p>By: {{ $book->author }}</p>
            <p>category: {{$book->category}}</p>
        </a>
    </div>
@endforeach
</ul>
</body>
</html>
