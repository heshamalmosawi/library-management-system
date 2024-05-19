<!DOCTYPE html>
<html>
<head>
    <title>{{ $book->title }}</title>
    <link rel="stylesheet" href="{{ asset('css/showbook.css') }}"> 

</head>
<body>
<!-- @include('header') -->


    <div class="book-details">
        <div  class="book-cover">
        <img src="{{ $book->bookcover_url }}" alt="{{ $book->title }} book cover image" class="bookcover">
        </div>
            <div class="book-info">
            <h1>{{ $book->title }}</h1>
            <p><strong>Author:</strong> {{ $book->author }}</p>
            <p><strong>Category:</strong> {{ $book->category }}</p>
            <p><strong>Publisher:</strong> {{ $book->publisher }}</p>
            </div>
            <div class="book-meta">
            <p><strong>Publish Date:</strong> {{ $book->publish_date }}</p>
            <p><strong>ISBN:</strong> {{ $book->ISBN }}</p>
            <p><strong>Number of Pages:</strong> {{ $book->numOfPages }}</p>
            <p><strong>Available Copies:</strong> {{ $book->available_copies }}</p>
            <p><strong>Total Copies:</strong> {{ $book->total_copies }}</p>
            <p><strong>Location:</strong> {{ $book->location }}</p>
            </div>

        <div class="description">
            <strong>Description:</strong>
            <p>{{ $book->abstract }}</p>
        </div>
    </div>
</body>
</html>