<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/books.css') }}"> 
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/png">
    <title>Search Book</title>
</head>
<body>
  @include('header')
        <h1 style="text-align: center;">Search Results</h1>
    
        <div id="allbooks">


            @foreach($books as $book)
            <div class="singlebook" name="book_{{$book->book_id}}">
                <a href="{{ route('book.show', $book->ISBN) }}">
                    <img src="{{$book->bookcover_url}}" alt="{{$book->title}} book cover image" class="bookcover">
                    <p>{{ $book->title }}</p>
                </a>
            </div>
            @endforeach
   @include('footer')
</body>
</html>