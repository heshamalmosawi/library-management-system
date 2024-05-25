<!DOCTYPE html>
<html>
<head>
    <title>{{ $book->title }}</title>
    <link rel="stylesheet" href="{{ asset('css/showbook.css') }}"> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/png">
   

</head>
<body>
    @include('header')


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
        @if (session('userType') == 'student')
        <div class="button-container">
            <form action="/borrow" method="GET">
                <input type="hidden" name="isbn" class="eb" value="{{ $book->ISBN }}">
                <button type="submit"id="b">Borrow</button>
            </form>
        </div>

        @elseif (session('userType') == 'staff')
        <div class="button-container">
            <form method="GET" action="{{ session('userType') == 'staff' ? route('books.edit', ['book_id' => $book->book_id]) : '#' }}">
                <button type="submit" class="eb" id="e">Edit book</button>
            </form>
            <form action="/borrow" method="GET">
                <input type="hidden" name="isbn" class="eb" value="{{ $book->ISBN }}">
                <button type="submit" id="b">Borrow</button>
            </form>
        </div>

        @endif
    </div>
    @include('footer')
</body>
</html>